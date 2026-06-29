<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(
    basePath: dirname(__DIR__)    // ✅ DO NOT use base_path() here
)
->withRouting(
    web: __DIR__.'/../routes/web.php',
    api: __DIR__.'/../routes/api.php',
    commands: __DIR__.'/../routes/console.php',
    health: '/up',
)
->withMiddleware(function (Middleware $middleware) {
    // Spatie (v6+) middleware aliases (singular "Middleware" namespace)
    $middleware->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        'admin.panel' => \App\Http\Middleware\AdminPanelAccess::class,
    ]);
})
->withExceptions(function (Exceptions $exceptions) {
    //
})
->create();
