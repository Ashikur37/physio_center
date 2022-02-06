<?php

namespace App\Http\Controllers\Accountant;

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
use App\Models\Task;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $totalRegisteredUsers = User::where('role', 'patient')->count();

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
        $appointments = Appointment::pluck('id')->toArray();
        $therapyCounts = AppointmentTherapy::whereIn('appointment_id', $appointments)->sum('total');
        $totalRequisition = DB::table('requisitions')->count();
        $totalBill = Appointment::sum('amount');
        $totalDiscount = Appointment::sum('discount');
        $totalGiven = Appointment::sum('given');


        $totalCompleteTask = Task::where('status', 2)->count();
        return view('accountant.home', compact('totalBill', 'totalDiscount', 'totalGiven', 'appointments', 'totalRegisteredUsers', 'appointment', 'today', 'income', 'new', 'therapyCounts', 'totalRequisition', 'totalCompleteTask'));
    }
}
