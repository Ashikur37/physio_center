<?php

namespace App\Http\Controllers\Therapist;

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


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $appointment = Appointment::where('status', '=', 0)->count();

        $today = Appointment::whereDay('appoint_at', '=', date('d'))
            ->whereMonth('appoint_at', '=', date('m'))
            ->whereYear('appoint_at', '=', date('Y'))
            ->count();

        $income = Payment::where('type', '=', 4)
            ->whereDay('created_at', '=', date('d'))
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->sum('amount');

        $new = User::where('role', '=', 'patient')
            ->whereDay('created_at', '=', date('d'))
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->count();

        $appointments = Appointment::all();
        $therapyCounts = AppointmentTherapy::sum('total');
        $therapyCompletedCounts = AppointmentTherapy::sum('given');

        return view('therapist.home', compact('appointment', 'today', 'income', 'appointments', 'new', 'therapyCounts', 'therapyCompletedCounts'));
    }
}
