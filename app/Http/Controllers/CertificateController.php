<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Certificate;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;


class CertificateController extends Controller
{

    public function index()
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'ca', 'validator'])) {
            $certificates = Certificate::with(['office', 'service'])
                ->whereDate('issued_at', Carbon::today())
                ->whereNull('printed_at')
                ->orderByDesc('issued_at')
                ->get();

            $officeName = "CA Today";
        } else {
            return redirect()->route('dashboard')
                ->with('error', 'You are not authorized to access Certificates.');
        }

        return view('ca.index', compact('certificates', 'officeName'));
    }


    public function week()
    {
        $user = auth()->user();

        if ($user->hasAnyRole(['admin', 'ca', 'validator'])) {
            $certificates = Certificate::with(['office','service'])
                ->whereBetween('issued_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfDay()])
                ->orderByDesc('issued_at')
                ->get();
            $officeName = "Certificates this Year";
        } else {
            return redirect()->route('dashboard')
                ->with('error', 'You are not authorized to access Certificates.');
        }
        return view('ca.week', compact('certificates', 'officeName'));
    }


    public function show(Certificate $certificate)
    {
        return view('ca.show', compact('certificate'));
    }

    
    public function print(Certificate $certificate)
    {
        $certificate->update(['printed_at' => now()]);
        return back()->with('printed', true);
    }


    public function printFresh(Certificate $certificate)
    {
        // Mark as printed (optional if you track it here)
        if (is_null($certificate->printed_at)) {
            $certificate->printed_at = now();
            $certificate->save();
        }

        $caSettings = AppSetting::caSettings();

        return view('ca.print-fresh', compact('certificate', 'caSettings'));
    }

    public function printEsign(Certificate $certificate)
    {
        // Same logic but use a different view for e-signature
        if (is_null($certificate->printed_at)) {
            $certificate->printed_at = now();
            $certificate->save();
        }

        $caSettings = AppSetting::caSettings();

        return view('ca.print-esign', compact('certificate', 'caSettings'));
    }


    public function printPreview(Certificate $certificate)
    {
        $certificate->printed_at = now();
        $certificate->save();
        $caSettings = AppSetting::caSettings();

        return view('ca.print-fresh', compact('certificate', 'caSettings'));
    }

    public function toggleObOt(Request $request, \App\Models\Certificate $certificate): JsonResponse
    {
        $user = auth()->user();

        if (! ($user && $user->hasAnyRole(['admin', 'ca']))) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        // validate incoming value (optional). If not provided, toggle.
        $value = $request->input('value'); // expected 'OB' or 'OT'
        if ($value && ! in_array($value, ['OB','OT'])) {
            return response()->json(['status'=>'error','message'=>'Invalid value'], 422);
        }

        if ($value) {
            $certificate->ob_ot = $value;
        } else {
            $certificate->ob_ot = ($certificate->ob_ot === 'OB') ? 'OT' : 'OB';
        }

        $certificate->save();

        return response()->json(['status' => 'success', 'value' => $certificate->ob_ot]);
    }



    // POST /api/certificates/issue
    public function issue(Request $req)
    {
        $this->middleware('role:validator|admin');
        $data = $req->validate([
            'booking_code' => 'required|exists:bookings,booking_code',
        ]);

        $booking = Booking::with('survey')->where('booking_code', $data['booking_code'])->firstOrFail();

        // business rule: only when survey exists & requested_coa == true
        if (!$booking->survey || !$booking->survey->requested_coa) {
            return response()->json(['message' => 'COA not requested or survey missing'], 422);
        }

        $cert = Certificate::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'certificate_number' => 'COA-'.now()->format('Ymd').'-'.strtoupper(Str::random(6)),
                'issued_at' => now(),
            ]
        );

        return response()->json($cert);
    }
}
