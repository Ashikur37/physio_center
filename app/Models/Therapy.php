<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'therapy';

    protected $guarded = [];
    public function machines()
    {
        return $this->belongsToMany(Machine::class, 'therapy_machines', 'therapy_id', 'machine_id');
    }
}
