<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $bookings = Booking::all();
        }
        elseif ($user->office_id == 10) {
            $bookings = Booking::where('office_id', 10)->get();
        }
        elseif ($user->office_id == 540 || optional($user->office)->name === 'SGOD') {
            $bookings = Booking::whereBetween('office_id', [11, 16])->get();
        }
        else {
            $bookings = collect();
        }

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $req)
    {
        $data = $req->validate([
            'customer_type' => 'required|in:Citizen,Business,Government',
            'office_id'     => 'required|exists:offices,id',
            'service_id'    => 'required|exists:services,id',
            'sub_service_id'=> [
                'nullable',
                Rule::exists('sub_services', 'id')->where(fn ($query) => $query->where('service_id', $req->input('service_id'))),
            ],
            'scheduled_at'  => 'nullable|date',
            'guest_name'    => 'nullable|string|max:120',
            'guest_contact' => 'nullable|string|max:120',
            'employee_no'   => 'nullable|digits:7',   // 👈 new
            'purpose'       => 'nullable|string|max:255',
        ]);

        $requiresSubService = DB::table('sub_services')
            ->where('service_id', $data['service_id'])
            ->exists();

        if ($requiresSubService && empty($data['sub_service_id'])) {
            return response()->json([
                'message' => 'Please select a sub-service.',
                'errors'  => ['sub_service_id' => ['A sub-service is required for this service.']]
            ], 422);
        }

        if (!empty($data['sub_service_id'])) {
            $subServiceName = DB::table('sub_services')->where('id', $data['sub_service_id'])->value('name');

            if ($subServiceName === 'COE Request') {
                if (empty($data['employee_no'])) {
                    return response()->json([
                        'message' => 'Employee ID is required for a COE Request.',
                        'errors'  => ['employee_no' => ['Employee ID is required.']]
                    ], 422);
                }
                if (empty($data['purpose'])) {
                    return response()->json([
                        'message' => 'Purpose is required for a COE Request.',
                        'errors'  => ['purpose' => ['Purpose is required.']]
                    ], 422);
                }
            }
        }

        if (empty($data['employee_no'])) {
            $data['employee_no'] = '1000000';
        }

        // If employee_no is provided, bind booking to that user and mirror their name to guest_name
        if (!empty($data['employee_no'])) {
            $user = User::where('employee_no', $data['employee_no'])->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Employee ID not found.',
                    'errors'  => ['employee_no' => ['Unknown employee id.']]
                ], 422);
            }

            $data['user_id']   = $user->id;
            $data['guest_name'] = $user->name; // 👈 your requirement
        } else {
            // fallback: if authenticated employee books without employee_no
            $data['user_id'] = auth()->check() ? auth()->id() : null;
        }

        // Generate a unique 6-digit booking code
        $data['booking_code'] = $this->generateUnique6DigitCode();

        $booking = Booking::create($data);

        return response()->json([
            'booking_code' => $booking->booking_code,
            'booking_id'   => $booking->id,
        ], 201);
    }

    private function generateUnique6DigitCode(): string
    {
        for ($i = 0; $i < 5; $i++) {
            $code = (string) random_int(100000, 999999);
            if (!DB::table('bookings')->where('booking_code', $code)->exists()) return $code;
        }
        do { $code = (string) random_int(100000, 999999); }
        while (DB::table('bookings')->where('booking_code', $code)->exists());
        return $code;
    }

    public function showByCode(string $code)
    {
        abort_unless(preg_match('/^\d{6}$/', $code), 404);
        $booking = Booking::with(['office:id,name','service:id,name','subService:id,name,service_id','user:id,name,employee_no'])
            ->where('booking_code', $code)->firstOrFail();

        return response()->json($booking);
    }
}
