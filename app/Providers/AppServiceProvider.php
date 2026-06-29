<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Validate / hide / unhide bookings
        Gate::define('manage-transactions', fn($user) => $user->hasAnyRole(['admin', 'ca']));

        // Print COA and toggle OB/OT
        Gate::define('manage-certificates', fn($user) => $user->hasAnyRole(['admin', 'ca']));

        // Create / edit / delete offices and services
        Gate::define('manage-offices-services', fn($user) => $user->hasRole('admin'));

        // Survey Responses module
        Gate::define('view-surveys', fn($user) => $user->hasRole('admin'));

        // User Management module
        Gate::define('manage-users', fn($user) => $user->hasRole('admin'));

        // Settings module
        Gate::define('manage-settings', fn($user) => $user->hasRole('admin'));
    }
}
