<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = [];
    //has many therapy
    public function therapies()
    {
        return $this->belongsToMany('App\Models\Therapy', 'App\Models\TherapyGroup');
    }
}
