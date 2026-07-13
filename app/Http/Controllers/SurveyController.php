<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Booking;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class SurveyController extends Controller
{
    // GET /api/surveys/start/{booking_code}
    public function start(string $booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->firstOrFail();

        if (!$booking->is_validated || $booking->is_survey) {
            return response()->json(['message' => 'Booking is either not validated or survey already completed.'], 403);
        }

        $survey = Survey::firstOrCreate(['booking_id' => $booking->id]);

        $questions = SurveyQuestion::where('active', true)->orderBy('order')->get(['id','question','order']);

        return response()->json([
            'survey_id' => $survey->id,
            'questions' => $questions,
        ]);
    }

    // POST /api/surveys/submit
    public function submit(Request $req)
    {
        $data = $req->validate([
            'booking_code'   => 'required|exists:bookings,booking_code',
            'requested_coa'  => 'required|boolean',
            'answers'        => 'required|array',                      // [{question_id, answer}, ...]
            'answers.*.question_id' => 'required|exists:survey_questions,id',
            'answers.*.answer'      => 'required|string|max:255',
            'age'            => 'required|integer|min:1|max:120',
            'gender'         => 'required|string|max:20',
            'contact'        => 'required|string|max:20',
            'cc_aware'        => 'required|string|max:20',
            'cc_see'        => 'required|string|max:20',
            'cc_used'        => 'required|string|max:20',
            'remarks'        => 'nullable|string|max:500',
        ]);

        $booking = Booking::where('booking_code', $data['booking_code'])->firstOrFail();

        if (!$booking->is_validated) {
            return response()->json(['message' => 'Booking not validated'], 403);
        }

        $survey = Survey::firstOrCreate(['booking_id' => $booking->id]);
        $survey->requested_coa = $data['requested_coa'];
        $survey->age = $data['age'];
        $survey->gender = $data['gender'];
        $survey->contact = $data['contact'];
        $survey->cc_aware = $data['cc_aware'];
        $survey->cc_see = $data['cc_see'];
        $survey->cc_used = $data['cc_used'];
        $survey->remarks = $data['remarks'] ?? null;
        $survey->employee_no = $booking->user->employee_no;
        $survey->office_id = $booking->office_id;
        $survey->service_id = $booking->service_id;
        $survey->sub_service_id = $booking->sub_service_id;
        $survey->customer_type = $booking->customer_type;
        $survey->save();

        // Upsert responses
        foreach ($data['answers'] as $a) {
            SurveyResponse::updateOrCreate(
                ['survey_id' => $survey->id, 'survey_question_id' => $a['question_id']],
                ['answer' => $a['answer']]
            );
        }

        if ($data['requested_coa']) {
            $user = optional($booking->user);
            $office = optional($booking->office);
            $service = optional($booking->service);
            $subService = optional($booking->subService);

            $datePrefix = now()->format('ymd');
            $countToday = \App\Models\Certificate::whereDate('issued_at', now()->toDateString())->count();
            $series = $countToday + 1;
            $certNumber = "CA-{$datePrefix}-{$series}";

            \App\Models\Certificate::create([
                'office_id' => $booking->office_id,
                'service_id' => $booking->service_id,
                'sub_service_id' => $booking->sub_service_id,
                'booking_id' => $booking->id,
                'guest_name' => $user->name,
                'certificate_number' => $certNumber,
                'purpose' => trim(($service->name ?? 'Service') . ($subService->name ? ' - ' . $subService->name : '') . ' at ' . ($office->name ?? 'Office')),
                'issued_at' => now(),
            ]);
        }

        $booking->is_survey = 1;
        $booking->save();

        return response()->json(['message' => 'Survey saved']);
    }
}
