<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'tracking_no','title','sender_name','date_filed',
        'from_office_id','to_office_id','for_user_id','latest_status',
    ];

    protected $casts = ['date_filed' => 'datetime'];

    public function fromOffice(){ return $this->belongsTo(Office::class, 'from_office_id'); }
    public function toOffice(){ return $this->belongsTo(Office::class, 'to_office_id'); }
    public function forUser(){ return $this->belongsTo(User::class, 'for_user_id'); }

    public function updates(){  // timeline
        return $this->hasMany(DocumentTracking::class)->orderBy('occurred_at');
    }
}
