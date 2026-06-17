<?php

use App\Http\Controllers\{BookingController, BookingValidationController, SurveyController, CertificateController, EmployeeController, DocumentController};

Route::get('/docs/{tracking_no}', [DocumentController::class, 'show'])
     ->where('tracking_no', '^\d{7}$'); // was 8, now 7

Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/code/{code}', [BookingController::class, 'showByCode'])
     ->where('code', '^\d{6}$'); // 6 digits

Route::get('/employees/validate/{employee_no}', [EmployeeController::class, 'validateByNo'])
     ->where('employee_no', '^\d{7}$'); // 7 digits

Route::middleware(['auth:sanctum','role:validator|admin'])->group(function () {
    Route::post('/bookings/validate', [BookingValidationController::class, 'store']);
    Route::post('/certificates/issue', [CertificateController::class, 'issue']);
});

Route::get('/surveys/start/{booking_code}', [SurveyController::class, 'start'])
     ->where('booking_code', '^\d{6}$');

Route::post('/surveys/submit', [SurveyController::class, 'submit'])->name('api.surveys.submit');
