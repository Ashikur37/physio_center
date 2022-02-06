<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentSlot extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to slot
    public function slot()
    {
        return $this->belongsTo('App\Models\Slot');
    }
}
