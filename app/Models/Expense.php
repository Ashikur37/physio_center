<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = [];
    //belongs to expenseType
    public function expenseType()
    {
        return $this->belongsTo('App\Models\ExpenseType');
    }
    //has many payments
    public function payments()
    {
        return $this->hasMany('App\Models\ExpensePayment');
    }
}
