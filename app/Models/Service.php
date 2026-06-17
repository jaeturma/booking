<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model {

    use HasFactory;

    protected $fillable = ['name', 'office_id'];

    public function office()
    { 
        return $this->belongsTo(Office::class); 
    }

    public function bookings()
    { 
        return $this->hasMany(Booking::class); 
    }

    public function subServices()
    {
        return $this->hasMany(SubService::class);
    }
}
