<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';


    // fetch appointment by patient id
    static function appointmentListById($patient_id)
    {
        $data = DB::table('appointments')
            ->join('service', 'appointments.service_id', '=', 'service.id')
            ->where('appointments.patient_id', '=', $patient_id)
            ->select('service.name', 'service.desc', 'appointments.id', 'appointments.service_id', 'appointments.details', 'appointments.appoint_at', 'appointments.status', 'appointments.created_at')
            ->latest()->get();
        return $data;
    }
    //belongstomanythrough
    public function therapies()
    {
        return $this->hasMany('App\Models\AppointmentTherapy');
    }

    //belongs to service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    //belongs to user
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    //belongs to doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    //has many appoinmentpayment
    public function payments()
    {
        return $this->hasMany(AppoinmentPayment::class, 'appointment_id');
    }
    //has one appointmentslot
    public function slot()
    {
        return $this->hasOne(AppointmentSlot::class, 'appointment_id');
    }
    //has many notes
    public function notes()
    {
        return $this->hasMany(AppointmentNote::class, 'appointment_id');
    }
    //has one prescription details
    public function prescription()
    {
        return $this->hasOne(PrescriptionDetails::class, 'appointment_id');
    }
    //belongs to many tests
    public function tests()
    {
        return $this->belongsToMany('App\Models\Test', 'App\Models\AppointmentTest');
    }
}
