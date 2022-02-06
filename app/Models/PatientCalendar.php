<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCalendar extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to patient
    public function patient()
    {
        return $this->belongsTo('App\Models\PatientProfile');
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
