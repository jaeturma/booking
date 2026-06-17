<?php

// app/Models/Booking.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model {
    use SoftDeletes;

    protected $fillable = [
        'user_id','guest_name','guest_contact',
        'office_id','service_id','sub_service_id','booking_code',
        'customer_type','is_validated','scheduled_at',
    ];

    protected $casts = [
        'is_validated' => 'boolean',
        'is_survey' => 'boolean',
        'scheduled_at' => 'datetime',
        'is_hidden' => 'bool',
    ];

    public function scopeVisibleTo($query, \App\Models\User $user)
    {
        if ($user->hasRole('admin')) {
            return $query; // admins see everything (including hidden)
        }

        // validators/employees must belong to office, and never see hidden
        return $query->where('office_id', $user->office_id)
                    ->where('is_hidden', false);
    }

    public function user(){ return $this->belongsTo(User::class); }
    public function office(){ return $this->belongsTo(Office::class); }
    public function service(){ return $this->belongsTo(Service::class); }
    public function subService(){ return $this->belongsTo(SubService::class); }
    public function validation(){ return $this->hasOne(BookingValidation::class); }
    public function survey(){ return $this->hasOne(Survey::class); }
    public function certificate(){ return $this->hasOne(Certificate::class); }
}
