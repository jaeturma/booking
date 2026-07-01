<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoeCertificate extends Model
{
    protected $fillable = [
        'booking_id',
        'certificate_number',
        'employee_name',
        'position',
        'district',
        'school_office',
        'purpose',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'printed_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
