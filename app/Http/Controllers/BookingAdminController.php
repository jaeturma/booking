<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingValidation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingAdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin → all bookings
            $bookings = Booking::all();
        } elseif ($user->office_id == 10) {
            // Admin office user → only office 10
            $bookings = Booking::where('office_id', 10)->get();
        } elseif ($user->office_id == 540 || optional($user->office)->name === 'SGOD') {
            // SGOD → offices 11–16
            $bookings = Booking::whereBetween('office_id', [11, 16])->get();
        } else {
            // Regular users → only their own office
            $bookings = Booking::where('office_id', $user->office_id)->get();
        }

        return view('bookings.index', compact('bookings'));
    }


    public function all()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            // Admin → see all bookings
            $bookings = Booking::with(['user', 'service', 'office'])
                            ->latest()
                            ->get();
            $officeName = "All Offices";
        } elseif ($user->office_id == 10) {
            // Admin Office user → see only today's bookings
            $bookings = Booking::with(['user', 'service', 'office'])
                            ->whereDate('created_at', Carbon::today())
                            ->orderBy('created_at', 'desc')
                            ->get();
            $officeName = "Admin Office (Today)";
        } else {
            // Not allowed
            return redirect()->route('dashboard')
                ->with('error', 'You are not authorized to view All Bookings.');
        }

        return view('bookings.all', compact('bookings', 'officeName'));
    }


    public function validateBooking(Request $request, Booking $booking)
    {
        $user = $request->user();

        if (!$user->hasAnyRole(['validator','admin'])) {
            return $this->respond($request, 403, 'Unauthorized.');
        }
        if (!$user->hasRole('admin')) {
            // non-admins: office-bound + cannot validate hidden records
            if (!$user->office_id) return $this->respond($request, 403, 'You must be assigned to an office.');
            if ($booking->office_id !== $user->office_id) return $this->respond($request, 403, 'This booking belongs to another office.');
            if ($booking->is_hidden) return $this->respond($request, 403, 'This booking is hidden.');
        }
        if ($booking->is_validated) {
            return $this->respond($request, 409, 'Booking already validated.');
        }

        $booking->update(['is_validated' => true]);

        BookingValidation::create([
            'booking_id'   => $booking->id,
            'validated_by' => $user->id,
            'validated_at' => now(),
        ]);

        return $this->respond($request, 200, "Booking {$booking->booking_code} validated.", ['ok' => true]);
    }

    public function hide(Request $request, Booking $booking)
    {
        $this->authorizeAdmin($request);
        $booking->update(['is_hidden' => true]);
        return $this->respond($request, 200, 'Hidden', ['hidden' => true]);
    }

    public function unhide(Request $request, Booking $booking)
    {
        $this->authorizeAdmin($request);
        $booking->update(['is_hidden' => false]);
        return $this->respond($request, 200, 'Visible', ['hidden' => false]);
    }

    private function authorizeAdmin(Request $request): void
    {
        if (!$request->user()->hasRole('admin')) {
            abort(403, 'Admins only.');
        }
    }

    private function respond(Request $request, int $status, string $message, array $extra = [])
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message] + $extra, $status);
        }
        return back()->with($status >= 400 ? 'error' : 'success', $message);
    }
}
