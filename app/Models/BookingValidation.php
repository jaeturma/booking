<?php

// app/Models/BookingValidation.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookingValidation extends Model {
    protected $fillable = ['booking_id','validated_by','validated_at'];
    protected $casts = ['validated_at' => 'datetime'];
    public function booking(){ return $this->belongsTo(Booking::class); }
    public function validator(){ return $this->belongsTo(User::class,'validated_by'); }
}
