<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTherapy extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to therapy
    public function therapy()
    {
        return $this->belongsTo('App\Models\Therapy');
    }
    public function individuals()
    {
        return $this->hasMany('App\Models\AppointmentTherapyIndividual');
    }
}
