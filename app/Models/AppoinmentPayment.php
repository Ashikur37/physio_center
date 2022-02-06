<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoinmentPayment extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to mobile agent
    public function mobileAgent()
    {
        return $this->belongsTo(MobileAgent::class);
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //belongs to appointment
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
