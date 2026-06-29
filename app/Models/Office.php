<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'main', 'district', 'group', 'show_order'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function services()
    { 
        return $this->hasMany(Service::class); 
    }

    public function bookings()
    { 
        return $this->hasMany(Booking::class); 
    }
}