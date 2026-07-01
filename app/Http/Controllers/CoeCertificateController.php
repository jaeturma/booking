<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Booking;
use App\Models\CoeCertificate;
use Illuminate\Support\Str;

class CoeCertificateController extends Controller
{
    public function printFresh(Booking $booking)
    {
        $this->authorize('manage-transactions');

        $certificate = $this->resolveCertificate($booking);
        $caSettings = AppSetting::caSettings();

        return view('coe.print-fresh', compact('certificate', 'caSettings'));
    }

    public function printEsign(Booking $booking)
    {
        $this->authorize('manage-transactions');

        $certificate = $this->resolveCertificate($booking);
        $caSettings = AppSetting::caSettings();

        return view('coe.print-esign', compact('certificate', 'caSettings'));
    }

    private function resolveCertificate(Booking $booking): CoeCertificate
    {
        $booking->loadMissing('user.office', 'user.position');

        $certificate = CoeCertificate::firstOrCreate(
            ['booking_id' => $booking->id],
            [
                'certificate_number' => 'COE-'.now()->format('Ymd').'-'.strtoupper(Str::random(6)),
                'employee_name' => $booking->user->name ?? $booking->guest_name,
                'position' => optional($booking->user?->position)->name,
                'district' => optional($booking->user?->office)->district,
                'school_office' => optional($booking->user?->office)->name,
                'purpose' => $booking->purpose,
                'issued_at' => now(),
            ]
        );

        if (is_null($certificate->printed_at)) {
            $certificate->printed_at = now();
            $certificate->save();
        }

        return $certificate;
    }
}
