<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BookingAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Admins and administration role: always allowed
        if ($user->hasAnyRole(['admin', 'administration'])) {
            return $next($request);
        }

        // SGOD office: allowed with a session flag for controller-level filtering
        if ($user->office && $user->office->name === 'SGOD') {
            session(['booking_can_view_range' => [11, 16]]);
            return $next($request);
        }

        // ❌ Everyone else
        return redirect()->route('dashboard')
            ->with('error', 'You are not authorized to access Bookings.');
    }
}
