<?php

use Illuminate\Support\Facades\Route;
use App\Models\Office;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;

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
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\CoeRequestController;
use App\Http\Controllers\CoeCertificateController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Offices/sections/services payload shared by the kiosk and mobile views
if (!function_exists('kioskOfficesPayload')) {
    function kioskOfficesPayload(): array
    {
        $offices = Office::with('services.subServices:id,service_id,name')
            ->whereNotNull('show_order')
            ->orderBy('show_order')
            ->get(['id', 'name', 'main', 'show_order', 'icon']);

        return $offices->map(function ($o) {
            // `main` holds the parent office of a section (Admin, CID, Finance, SGOD);
            // '1' (or empty) marks a direct-service office shown at top level.
            $main = trim((string) $o->main);
            return [
                'id'       => $o->id,
                'name'     => $o->name,
                'icon'     => $o->icon,
                'group'    => ($main !== '' && $main !== '1') ? $main : null,
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
    }
}

// Public kiosk page
Route::get('/kiosk', function () {
    return view('kiosk', ['kioskData' => kioskOfficesPayload()]);
})->name('kiosk');

// Mobile view
Route::get('/mobile', function () {
    return view('mobile', ['kioskData' => kioskOfficesPayload()]);
})->name('mobile');

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
    Route::prefix('admin')->name('admin.')->middleware(['admin.panel'])->group(function () {

        Route::get('/dashboard', function () {
            $user = auth()->user();
            if ($user->hasAnyRole(['superadmin', 'admin', 'ca'])) {
                return view('admin.dashboard', [
                    'isValidator'    => false,
                    'userCount'      => User::count(),
                    'officeCount'    => Office::count(),
                    'serviceCount'   => Service::count(),
                    'pendingCount'   => Booking::where('is_validated', 0)->count(),
                    'validatedToday' => Booking::where('is_validated', 1)
                                           ->whereDate('created_at', today())->count(),
                ]);
            }
            // validator role — show their office's bookings for today only
            $officeId = $user->office_id;
            return view('admin.dashboard', [
                'isValidator'    => true,
                'officeName'     => optional($user->office)->name ?? 'Your Office',
                'pendingToday'   => Booking::where('office_id', $officeId)
                                        ->where('is_validated', 0)
                                        ->whereDate('created_at', today())->count(),
                'validatedToday' => Booking::where('office_id', $officeId)
                                        ->where('is_validated', 1)
                                        ->whereDate('created_at', today())->count(),
                'totalToday'     => Booking::where('office_id', $officeId)
                                        ->whereDate('created_at', today())->count(),
            ]);
        })->name('dashboard');

        // Shared routes — accessible to all admin-panel roles
        Route::get('/offices/data',      [OfficeController::class,     'getData'])->name('offices.data');
        Route::get('/transactions',      [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/data', [TransactionController::class, 'getData'])->name('transactions.data');
        Route::get('/coe-requests',      [CoeRequestController::class, 'index'])->name('coe-requests.index');
        Route::get('/coe-requests/data', [CoeRequestController::class, 'getData'])->name('coe-requests.data');
        Route::get('/coe-requests/{booking}/print-fresh', [CoeCertificateController::class, 'printFresh'])->name('coe-requests.print-fresh');
        Route::get('/coe-requests/{booking}/print-esign', [CoeCertificateController::class, 'printEsign'])->name('coe-requests.print-esign');
        Route::get('/support',           [SupportController::class,    'index'])->name('support.index');
        Route::resource('offices',  OfficeController::class);
        Route::resource('services', ServiceController::class);

        // ITO / Superadmin only
        Route::middleware('role:superadmin')->group(function () {
            Route::get('/users/data',     [UserController::class, 'getData'])->name('users.data');
            Route::get('/users/template', [UserController::class, 'downloadTemplate'])->name('users.template');
            Route::post('/users/import',  [UserController::class, 'importCsv'])->name('users.import');
            Route::get('/surveys/data',               [SurveyController::class, 'getData'])->name('surveys.data');
            Route::get('/surveys/{survey}/responses', [SurveyController::class, 'responses'])->name('surveys.responses');
            Route::get('/surveys',                    [SurveyController::class, 'index'])->name('surveys.index');
            Route::resource('users',       UserController::class);
            Route::resource('roles',       RoleController::class);
            Route::resource('permissions', PermissionController::class);
            Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
            Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
        });
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
        Route::get('/bookings/data', [BookingAdminController::class, 'getIndexData'])->name('bookings.data');
    });


    /*
    |--------------------------------------------------------------------------
    | Certificates Routes
    |--------------------------------------------------------------------------
    */
Route::prefix('ca')
    ->name('certificates.')
    ->middleware(['auth', 'role:superadmin|admin|ca|validator'])
    ->group(function () {
        Route::get('/', [CertificateController::class, 'index'])->name('index');
        Route::get('/week', [CertificateController::class, 'week'])->name('week');

        // Admin Office + ITO/Superadmin + CA role — print and toggle actions
        Route::middleware('role:superadmin|admin|ca')->group(function () {
            Route::patch('/{certificate}/toggle-ob-ot', [App\Http\Controllers\CertificateController::class, 'toggleObOt'])
                ->name('toggle-ob-ot');
            Route::get('/{certificate}/print-preview', [CertificateController::class, 'printPreview'])->name('print-preview');
            Route::get('/{certificate}/print-fresh',   [CertificateController::class, 'printFresh'])->name('print-fresh');
            Route::get('/{certificate}/print-esign',   [CertificateController::class, 'printEsign'])->name('print-esign');
        });

        Route::get('/{certificate}', [CertificateController::class, 'show'])->name('show');
    });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
