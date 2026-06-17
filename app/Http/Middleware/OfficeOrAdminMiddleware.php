<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OfficeOrAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && method_exists($user, 'hasRole') && $user->hasAnyRole(['admin', 'administration'])) {
            return $next($request);
        }

        return redirect()->route('dashboard')
            ->with('error', 'You are not authorized to access Certificates.');
    }
}
