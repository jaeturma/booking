<?php

use Illuminate\Support\Facades\Route;
use App\Models\Office;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BookingAdminController;
use App\Http\Controllers\CertificateController;
use App\Http\Middleware\OfficeOrAdminMiddleware;
use App\Http\Middleware\BookingAccessMiddleware;


// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Public kiosk page
Route::get('/kiosk', function () {
    $offices = Office::with('services.subServices:id,service_id,name')
        ->whereNotNull('show_order')
        ->orderBy('show_order')
        ->get(['id', 'name', 'show_order', 'icon']);

    $kioskData = $offices->map(function ($o) {
        return [
            'id'       => $o->id,
            'name'     => $o->name,
            'icon'     => $o->icon,
            'services' => $o->services->map(fn($s) => [
                'id'           => $s->id,
                'name'         => $s->name,
                'sub_services' => $s->subServices->map(fn($sub) => [
                    'id'   => $sub->id,
                    'name' => $sub->name,
                ])->values()->all(),
            ])->values()->all(),
        ];
    })->values()->all();

    return view('kiosk', ['kioskData' => $kioskData]);
})->name('kiosk');

// Mobile view
Route::view('/mobile', 'mobile')->name('mobile');

// Public document lookup
Route::get('/docs/{tracking_no}', [DocumentController::class, 'show'])
    ->where('tracking_no', '^\d{7}$'); // accepts 7 digits

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Redirect role handler
    Route::get('/redirect', function () {
        return '';
    })->middleware('redirect.role');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Admin CRUD resources
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('offices', OfficeController::class);
        Route::resource('services', ServiceController::class);
        Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

        // DataTables endpoint for users
        Route::get('/users/data', [UserController::class, 'getData'])
            ->name('users.data');
    });

    /*
    |--------------------------------------------------------------------------
    | Bookings Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {
        Route::get('/bookings', [BookingAdminController::class, 'index'])->name('bookings.index');
        Route::post('/bookings/{booking}/validate', [BookingAdminController::class, 'validateBooking'])->name('bookings.validate');
        Route::post('/bookings/{booking}/hide', [BookingAdminController::class, 'hide'])->name('bookings.hide');
        Route::post('/bookings/{booking}/unhide', [BookingAdminController::class, 'unhide'])->name('bookings.unhide');
        Route::get('/bookings/all', [BookingAdminController::class, 'all'])->name('bookings.all');
    });


    /*
    |--------------------------------------------------------------------------
    | Certificates Routes
    |--------------------------------------------------------------------------
    */
Route::prefix('ca')
    ->name('certificates.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('/week', [CertificateController::class, 'week'])->name('week');

        // ✅ Place toggle route before the wildcard {certificate}
        Route::patch('/{certificate}/toggle-ob-ot', [App\Http\Controllers\CertificateController::class, 'toggleObOt'])
            ->name('toggle-ob-ot');

        Route::get('/{certificate}/print-preview', [CertificateController::class, 'printPreview'])->name('print-preview');
        Route::get('/{certificate}/print-fresh', [CertificateController::class, 'printFresh'])->name('print-fresh');
        Route::get('/{certificate}/print-esign', [CertificateController::class, 'printEsign'])->name('print-esign');

        Route::get('/{certificate}', [CertificateController::class, 'show'])->name('show');
    });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
