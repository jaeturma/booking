<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasAnyRole(['admin', 'superadmin', 'validator', 'ca']) || in_array($user->office_id, [10, 17])) {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}
