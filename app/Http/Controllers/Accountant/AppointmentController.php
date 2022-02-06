<?php

namespace App\Http\Controllers\Accountant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AppoinmentPayment;
use App\Models\AppoinmentPaymentHistory;
use App\Models\Appointment;
use App\Models\AppointmentTherapy;
use App\Models\User;
use App\Models\Therapy;
use App\Models\Doctor;
use App\Models\Expense;
use App\Models\MobileAgent;
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
        return view('accountant.appointment.index', compact('appointments'));
    }
    public function show(Appointment $appointment)
    {
        return view('accountant.appointment.show', compact('appointment'));
    }
    public function pay(Appointment $appointment)
    {
        $mobileAgents = MobileAgent::all();
        return view('accountant.appointment.pay', compact('appointment', 'mobileAgents'));
    }
    // /printPayment
    public function printPayment(AppoinmentPayment $appoinmentPayment)
    {

        return view('accountant.appointment.print_payment', compact('appoinmentPayment'));
    }

    public function editPayment(AppoinmentPayment $appoinmentPayment)
    {
        $mobileAgents = MobileAgent::all();
        return view('accountant.appointment.edit_payment', compact('appoinmentPayment', 'mobileAgents'));
    }

    public function paymentHistory(AppoinmentPayment $appoinmentPayment)
    {
        $histories = AppoinmentPaymentHistory::where('appoinment_payment_id', $appoinmentPayment->id)->get();
        $appointment = Appointment::find($appoinmentPayment->appointment_id);
        return view('accountant.appointment.payment_history', compact('appoinmentPayment', 'histories', 'appointment'));
    }
    public function updatePayment(Request $request, AppoinmentPayment $appoinmentPayment)
    {
        $appointment = Appointment::find($appoinmentPayment->appointment_id);
        $appointment->given = $appointment->given + $request->amount - $appoinmentPayment->amount;
        $appointment->save();
        AppoinmentPaymentHistory::create([
            'user_id' => auth()->user()->id,

            'appoinment_payment_id' => $appoinmentPayment->id,
            'mobile_agent_id' => $appoinmentPayment->mobile_agent_id,

            'amount' => $appoinmentPayment->amount,
            'is_cash' => $appoinmentPayment->is_cash,
            //sender_type	sender_number	trans_id
            'sender_type' => $appoinmentPayment->type,
            'sender_number' => $appoinmentPayment->number,
            'trans_id' => $appoinmentPayment->trans_id,
            'note' => $request->note
        ]);
        $appoinmentPayment->update([
            'user_id' => auth()->user()->id,
            'mobile_agent_id' => $request->mobile_agent_id,

            'amount' => $request->amount,
            'is_cash' => $request->is_cash,
            //sender_type	sender_number	trans_id
            'sender_type' => $request->type,
            'sender_number' => $request->number,
            'trans_id' => $request->trans_id

        ]);


        return redirect()->route('appointment.pay', $appoinmentPayment->appointment_id);
    }
    public function expenseReport()
    {
        $start = request('start');
        $end = request('end');



        $expenses = Expense::when($start, function ($query) use ($start) {
            return $query->whereDate('created_at', '>=', $start);
        })->when($end, function ($query) use ($end) {
            return $query->whereDate('created_at', '<=', $end);
        })->select(DB::raw('DATE_FORMAT(created_at, "%D %M %Y") as date,sum(amount) as total,sum(paid) as total_paid'))->groupBy('date')->get();

        return view('accountant.appointment.expense_report', compact('expenses', 'start', 'end'));
    }
    public function appointmentPayReport()
    {
        $start = request('start');
        $end = request('end');



        $expenses = AppoinmentPayment::when($start, function ($query) use ($start) {
            return $query->whereDate('created_at', '>=', $start);
        })->when($end, function ($query) use ($end) {
            return $query->whereDate('created_at', '<=', $end);
        })->select(DB::raw('DATE_FORMAT(created_at, "%D %M %Y") as date,sum(amount) as total,count(*) as app'))->groupBy('date')->get();

        return view('accountant.appointment.appointment_report', compact('expenses', 'start', 'end'));
    }
    public function paid(Request $request, Appointment $appointment)
    {
        $appointment->given = $appointment->given + $request->amount;
        $appointment->save();
        if ($request->is_cash == 0) {
            $mobileAgent = MobileAgent::find($request->mobile_agent_id);
            $mobileAgent->balance = $mobileAgent->balance + $request->amount;
            $mobileAgent->save();
        }
        AppoinmentPayment::create(
            [
                'appointment_id' => $appointment->id,
                'user_id' => auth()->user()->id,
                'mobile_agent_id' => $request->mobile_agent_id,

                'amount' => $request->amount,
                'is_cash' => $request->is_cash,
                //sender_type	sender_number	trans_id
                'sender_type' => $request->type,
                'sender_number' => $request->number,
                'trans_id' => $request->trans_id

            ]
        );
        return redirect()->route('accountant.appointment.show', $appointment->id);
    }
    public function history(AppointmentTherapy $appointmentTherapy)
    {
        return view('accountant.appointment.history', compact('appointmentTherapy'));
    }
    public function give(AppointmentTherapy $appointmentTherapy)
    {
        return view('compounder.appointment.give', compact('appointmentTherapy'));
    }
    public function discount(Request $request, Appointment $appointment)
    {
        $appointment->update([
            'discount' => $request->discount,
        ]);
        return back()->with('success', 'Discount updated successfully');
    }
}
