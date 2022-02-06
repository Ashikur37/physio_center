<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to leaveType
    public function leaveType()
    {
        return $this->belongsTo('App\Models\LeaveType');
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    //has many leavenotes
    public function notes()
    {
        return $this->hasMany('App\Models\LeaveNote');
    }
}
