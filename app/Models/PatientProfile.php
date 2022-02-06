<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PatientProfile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient_profile';

    protected $guarded = [];

    static function updateProfile($data, $id)
    {
        $result = PatientProfile::updateOrCreate(['patient_id' => $id], $data);
        return $result;
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
