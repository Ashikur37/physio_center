<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTherapyIndividualMachine extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to machine
    public function machine()
    {
        return $this->belongsTo('App\Models\Machine');
    }
    
}
