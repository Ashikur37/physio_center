<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTherapyIndividual extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function machines()
    {
        return $this->hasMany('App\Models\AppointmentTherapyIndividualMachine');
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
