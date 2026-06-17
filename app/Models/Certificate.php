<?php

// app/Models/Certificate.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model {
    protected $fillable = [
        'office_id',
        'service_id',
        'sub_service_id',
        'booking_id',
        'certificate_number',
        'guest_name',
        'purpose',
        'ob_ot',
        'issued_at'];

    protected $casts = [
        'issued_at' => 'datetime',
        'printed_at' => 'datetime'
    ];

    public function booking()
    { 
        return $this->belongsTo(Booking::class); 
    }

    public function office()
    {
        return $this->belongsTo(\App\Models\Office::class);
    }

    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }

    public function subService()
    {
        return $this->belongsTo(\App\Models\SubService::class);
    }

    // Relate to User by employee_no (not by id)
    public function employee()
    {
        return $this->belongsTo(\App\Models\User::class, 'employee_no', 'employee_no');
    }
    
}
