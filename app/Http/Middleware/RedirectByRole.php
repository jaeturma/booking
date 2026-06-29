<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectByRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user) {
            // All admin-panel roles and privileged offices go to admin dashboard
            if ($user->hasAnyRole(['admin', 'superadmin', 'ca', 'validator']) || in_array($user->office_id, [10, 17])) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->office_id) {
                return redirect()->route('bookings.index');
            }

            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
