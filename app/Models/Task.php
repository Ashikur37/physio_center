<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //has many notes
    public function notes()
    {
        return $this->hasMany(TaskNote::class);
    }
    public function statuses()
    {
        return $this->hasMany(TaskStatus::class);
    }
    public function assigns()
    {
        return $this->hasMany(TaskAssign::class);
    }
}
