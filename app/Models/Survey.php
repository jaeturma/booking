<?php

// app/Models/Survey.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model {
    
    protected $fillable = [
        'booking_id',
        'requested_coa',
        'age',
        'gender',
        'contact',
        'employee_no',
        'office_id',
        'service_id',
        'sub_service_id',
        'customer_type',
        'cc_aware',
        'cc_see',
        'cc_used',
        'remarks',
    ];


    protected $casts = ['age' => 'integer','requested_coa' => 'boolean'];

    public function booking()
    { 
        return $this->belongsTo(Booking::class); 
    }

    public function responses()
    { 
        return $this->hasMany(SurveyResponse::class); 
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
