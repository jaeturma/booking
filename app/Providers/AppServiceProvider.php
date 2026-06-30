<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Hide/unhide bookings (Admin Office + ITO/Superadmin)
        Gate::define('manage-transactions', fn($user) => $user->hasAnyRole(['superadmin', 'admin', 'ca']));

        // Print COA and toggle OB/OT (Admin Office + ITO/Superadmin + CA role)
        Gate::define('manage-certificates', fn($user) => $user->hasAnyRole(['superadmin', 'admin', 'ca']));

        // Create / edit / delete offices and services (ITO/Superadmin only)
        Gate::define('manage-offices-services', fn($user) => $user->hasRole('superadmin'));

        // Survey Responses module (ITO/Superadmin only)
        Gate::define('view-surveys', fn($user) => $user->hasRole('superadmin'));

        // User Management module (ITO/Superadmin only)
        Gate::define('manage-users', fn($user) => $user->hasRole('superadmin'));

        // Settings module (ITO/Superadmin only)
        Gate::define('manage-settings', fn($user) => $user->hasRole('superadmin'));
    }
}
