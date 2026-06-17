<?php

// app/Models/SurveyQuestion.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model {
    protected $fillable = ['question','order','active'];
    protected $casts = ['order'=>'integer','active'=>'boolean'];
    public function responses(){ return $this->hasMany(SurveyResponse::class); }
}
