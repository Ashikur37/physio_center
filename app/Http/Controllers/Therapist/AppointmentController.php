<?php

namespace App\Http\Controllers\Therapist;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentTherapy;
use App\Models\AppointmentTherapyIndividual;
use App\Models\AppointmentTherapyIndividualMachine;
use App\Models\User;
use App\Models\Therapy;
use App\Models\Doctor;
use App\Models\Refer;
use App\Models\TherapyAssign;
use App\Models\PrescriptionDetails;
use App\Models\Payment;


class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('therapist.appointment.index', compact('appointments'));
    }
    public function show(Appointment $appointment)
    {
        $therapies = $appointment->therapies;
        $therapyAmount = 0;
        foreach ($therapies as $therapy) {
            $therapyAmount += $therapy->therapy->price * $therapy->given;
        }
        return view('therapist.appointment.show', compact('appointment', 'therapyAmount'));
    }
    public function history(AppointmentTherapy $appointmentTherapy)
    {
        return view('therapist.appointment.history', compact('appointmentTherapy'));
    }
    public function give(AppointmentTherapy $appointmentTherapy)
    {
        return view('therapist.appointment.give', compact('appointmentTherapy'));
    }
    public function giveTherapy(Request $request, AppointmentTherapy $appointmentTherapy)
    {
        $appointmentTherapy->update([
            'given' => $appointmentTherapy->given + 1,
        ]);
        $a =  AppointmentTherapyIndividual::create([
            'appointment_therapy_id' => $appointmentTherapy->id,
            'user_id' => Auth::user()->id,
            'note' => $request->note,

        ]);
        if ($request->machines) {
            foreach ($request->machines as $machine) {
                AppointmentTherapyIndividualMachine::create([
                    'appointment_therapy_individual_id' => $a->id,
                    'machine_id' => $machine,
                ]);
            }
        }

        return redirect()->route('therapist.appointment.show', $appointmentTherapy->appointment_id);
    }
    public function discount(Request $request, Appointment $appointment)
    {
        $appointment->update([
            'discount' => $request->discount,
        ]);
        return back()->with('success', 'Discount updated successfully');
    }
}
