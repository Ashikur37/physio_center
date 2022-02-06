<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapyGroup extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to group
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }
}
