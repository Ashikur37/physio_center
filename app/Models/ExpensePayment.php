<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePayment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mobileAgent()
    {
        return $this->belongsTo(MobileAgent::class);
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
