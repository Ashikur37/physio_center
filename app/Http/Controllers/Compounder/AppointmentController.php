<?php

namespace App\Http\Controllers\Compounder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentTherapy;
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
        return view('compounder.appointment.index', compact('appointments'));
    }
    public function show(Appointment $appointment)
    {
        $appointment->update([
            "compounder_viewed" => 1
        ]);
        return view('compounder.appointment.show', compact('appointment'));
    }
    public function history(AppointmentTherapy $appointmentTherapy)
    {
        return view('compounder.appointment.history', compact('appointmentTherapy'));
    }
    public function give(AppointmentTherapy $appointmentTherapy)
    {
        return view('compounder.appointment.give', compact('appointmentTherapy'));
    }
    public function discount(Request $request, Appointment $appointment)
    {
        $discount = $request->discount;

        if ($request->type == "percentage") {
            $discount = $appointment->amount * $discount / 100;
        }
        $appointment->update([
            'discount' => $discount,
        ]);
        return back()->with('success', 'Discount updated successfully');
    }
}
