<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssign extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to user
    public function assignedBy()
    {
        return $this->belongsTo('App\Models\User', 'assigned_by');
    }
    public function assignedTo()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to');
    }
}
