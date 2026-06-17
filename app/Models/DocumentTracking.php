<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentTracking extends Model
{
    protected $fillable = ['document_id','status','details','office_id','user_id','occurred_at'];
    protected $casts = ['occurred_at' => 'datetime'];

    public function document(){ return $this->belongsTo(Document::class); }
    public function office(){ return $this->belongsTo(Office::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
