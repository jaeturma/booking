<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingValidation;
use Illuminate\Http\Request;

class BookingValidationController extends Controller
{
    // POST /api/bookings/validate
    public function store(Request $req)
    {
        $this->middleware('role:validator|admin');
        $data = $req->validate(['booking_code' => 'required|digits:6']);

        $booking = \App\Models\Booking::where('booking_code', $data['booking_code'])->firstOrFail();
        $user = $req->user();

        if (!$user->office_id || $booking->office_id !== $user->office_id) {
            return response()->json(['message' => 'This booking belongs to another office.'], 403);
        }

        if ($booking->is_validated) {
            return response()->json(['message' => 'Booking already validated'], 409);
        }

        $booking->update(['is_validated' => true]);
        \App\Models\BookingValidation::create([
            'booking_id' => $booking->id,
            'validated_by' => $user->id,
            'validated_at' => now(),
        ]);

        return response()->json(['message' => 'Booking validated']);
    }

}
