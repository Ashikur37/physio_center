<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\AppoinmentPayment;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PatientProfile;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AppointmentNote;
use App\Models\AppointmentSlot;
use App\Models\AppointmentTherapy;
use App\Models\Expense;
use App\Models\LeaveApplication;
use App\Models\LeaveNote;
use App\Models\PatientCalendar;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Slot;
use App\Models\Task;
use App\Models\TaskNote;
use App\Models\TaskStatus;
use App\Models\TherapyGroup;
use Carbon\Carbon;

class AdminHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $appointment = Appointment::where('status', '=', 0)->count();

        $totalRegisteredUsers = User::where('role', 'patient')->count();


        $today = Appointment::whereDay('appoint_at', '=', date('d'))
            ->whereMonth('appoint_at', '=', date('m'))
            ->whereYear('appoint_at', '=', date('Y'))
            ->count();

        $income = AppoinmentPayment::sum('amount');

        $new = User::where('role', '=', 'patient')
            ->whereDay('created_at', '=', date('d'))
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->count();
        $appointments = Appointment::pluck('id')->toArray();
        $therapyCounts = AppointmentTherapy::whereIn('appointment_id', $appointments)->sum('total');
        $totalRequisition = DB::table('requisitions')->count();
        $totalTask = Task::count();
        $totalCompleteTask = Task::where('status', 2)->count();
        $expense = Expense::sum('amount');
        $todayIncome = AppoinmentPayment::whereDay('created_at', '=', date('d'))
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->sum('amount');
        $todayExpense = Expense::whereDay('created_at', '=', date('d'))
            ->whereMonth('created_at', '=', date('m'))
            ->whereYear('created_at', '=', date('Y'))
            ->sum('amount');
        $pendingAppointment = Appointment::where('status', 0)->count();
        $waiverAppointment = Appointment::where('is_waiver', 1)->count();

        return view('admin.home', compact('appointment', 'today', 'income', 'new', 'totalRegisteredUsers', 'totalRequisition', 'therapyCounts', 'appointments', 'totalTask', 'totalCompleteTask', 'expense', 'todayIncome', 'todayExpense', 'pendingAppointment', 'waiverAppointment'));
    }

    public function calendar()
    {
        if (request()->has('date')) {
            $date = Carbon::parse(request()->date);
        } else {
            $date = Carbon::now();
        }
        $patients = PatientProfile::latest()->get();
        return view('admin.calendar', compact('date', 'patients'));
    }
    public function calendarSet(Request $request)
    {
        PatientCalendar::updateOrCreate([
            'date' => $request->date,
            'slot' => $request->slot
        ], [
            'patient_id' => $request->patient_id,
            'user_id' => Auth::id()
        ]);
        return back();
    }
    public function addPatient()
    {
        return view('admin.patient.add_patient');
    }

    public function loadSlot(Request $request)
    {
        $appointmentSlots = AppointmentSlot::where('doctor_id', '=', $request->doctor)->where('date', $request->date)->pluck('slot_id')->toArray();
        $slots = Slot::all();
        return view('admin.appointment.slot', compact('appointmentSlots', 'slots'));
    }


    public function print(Appointment $appointment)
    {

        $patient = PatientProfile::where('patient_id', $appointment->patient_id)->first();
        $therapies = [];

        foreach ($appointment->therapies as $therapy) {
            $therapyGroup = TherapyGroup::where('therapy_id', $therapy->therapy_id)->first();

            if ($therapyGroup) {
                if (isset($therapies[$therapyGroup->group->name])) {
                    array_push($therapies[$therapyGroup->group->name], $therapy);
                } else {
                    $therapies[$therapyGroup->group->name] = [$therapy];
                }
            }
        }

        return view('compounder.appointment.print', compact('appointment', 'patient', 'therapies'));
    }
    public function createPatient(Request $request)
    {

        // patient data validated
        $validateData = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'email',
            'phone' => 'required',
            'age' => 'required',
            'blood' => 'required',
            'gender' => 'required',
            'nid' => 'required',
            'patient_id' => 'required'
        ], [
            'name.required' => 'Name is required.',
            'password.required' => 'Password is required.',
            'email.required' => 'Email is required.',
            'phone.required' => 'Phone is required.',
            'age.required' => 'Age is required.',
            'blood.required' => 'Bloog group is required.',
            'gender.required' => 'Gender is required.',
            'nid.required' => 'NID is required.',
        ]);

        // patient data array for user table
        $patient_login = [
            "name" => request('name'),
            "email" => request('email'),
            "role" => 'patient',
            "phone" => request('phone'),
            "password" => bcrypt(request('password')),
        ];

        // insert user table
        $id = User::create($patient_login)->id;

        $patient_profile = [
            "patient_id" => $id,
            "phone" => request('phone'),
            "age" => request('age'),
            "address" => 'Default',
            "nid" => request('nid'),
            "gender" => request('gender'),
            "blood" => request('blood')
        ];

        // insert patient profile table
        $id = PatientProfile::create($patient_profile)->id;

        // return with success
        return redirect("/admin/patient/list")->with('success', 'Patient Added Successfully');
    }

    // appointment from for admin section
    public function appointmentAdd()
    {

        $patients = DB::table('patient_profile')
            ->join('users', 'patient_profile.patient_id', '=', 'users.id')
            ->where('users.role', '=', 'patient')
            ->where('patient_profile.status', '!=', 3)
            ->select('patient_profile.*', 'users.name')
            ->get();
        $services = Service::select('id', 'name')->where('status', 1)->get();

        $doctors = DB::table('doctors')
            ->join('specialist_list', 'specialist_list.id', '=', 'doctors.specialist_id')
            ->join('users', 'doctors.User_id', '=', 'users.id')
            ->select(
                'users.id as userId',
                'doctors.name as dname',
                'doctors.id as did',
                'doctors.specialist_id as sid',
                'specialist_list.name as sname'
            )->get();

        return view('admin.appointment.add_new_appointment', compact('services', 'patients', 'doctors'));
    }

    public function appointmentStatus(Appointment $appointment, $status)
    {
        $appointment->status = $status;
        $appointment->save();

        return redirect('/admin/appointment/list')->with('success', 'Appointment Status Updated Successfully');
    }


    // store appointment from for admin section
    public function appointmentAddStore()
    {

        $service = Service::where('name', request('service_id'))->first();
        if (!$service) {
            $service = Service::create([
                'name' => request('service_id'),
                'desc' => 'det',
                'status' => 1
            ]);
        }
        $appointment = new Appointment;
        $appointment->patient_id = request('patient_id');
        $appointment->service_id = $service->id;
        $appointment->doctor_id = request('doctor_id');
        $appointment->details = request('details');
        $appointment->status = 1;
        if (request('is_waiver')) {
            $appointment->is_waiver = 1;
        }
        $appointment->appoint_at = date("Y-m-d H:i:s", strtotime(request('appoint_date') . ' ' . request('12:00')));
        $appointment->save();

        AppointmentSlot::create([
            'appointment_id' => $appointment->id,
            'slot_id' => request('slot_id'),
            'date' => request('appoint_date'),
            'doctor_id' => request('doctor_id')
        ]);
        // return with success
        return redirect('/admin/appointment/list');
    }
    public function noteStore(Request $request, Appointment $appointment)
    {
        AppointmentNote::create([
            'appointment_id' => $appointment->id,
            'note' => $request->note,
            'user_id' => Auth::user()->id,
            'type' => 1
        ]);
        return back();
    }
    //noteTask
    public function noteTask(Request $request, Task $task)
    {
        TaskNote::create([
            'task_id' => $task->id,
            'note' => $request->note,
            'user_id' => Auth::user()->id,
        ]);

        return back();
    }
    public function noteLeave(Request $request, LeaveApplication $leaveApplication)
    {
        LeaveNote::create([
            'leave_application_id' => $leaveApplication->id,
            'note' => $request->note,
            'user_id' => Auth::user()->id,
        ]);

        return back();
    }
    //noteLeave
    public function noteStatus(Task $task)
    {
        $task->status = request()->status;
        $task->save();
        TaskStatus::create([
            'task_id' => $task->id,
            'status' => request()->status,
            'user_id' => Auth::user()->id,
        ]);
        return back();
    }
    public function patientList()
    {
        $patients = PatientProfile::latest()->get();
        return view('admin.patient.list_patient', ["patients" => $patients]);
    }

    public function appointmentList()
    {
        $appointments = Appointment::latest()->get();
        if (request()->pending) {
            $appointments = Appointment::where('status', 0)->latest()->get();
        }
        if (request()->waiver) {
            $appointments = Appointment::where('is_waiver', 1)->latest()->get();
        }
        return view('admin.appointment.appoint_list', ["appointments" => $appointments]);
    }

    public function appointmentEdit($id)
    {

        $doctor = DB::table('doctors')
            ->join('specialist_list', 'specialist_list.id', '=', 'doctors.specialist_id')
            ->join('users', 'doctors.User_id', '=', 'users.id')
            ->select(
                'users.id as userId',
                'doctors.name as dname',
                'doctors.id as did',
                'doctors.specialist_id as sid',
                'specialist_list.name as sname'
            )->get();
        $slots = Slot::all();
        $appointments = DB::table('appointments')
            ->join('users', 'appointments.patient_id', '=', 'users.id')
            ->join('service', 'appointments.service_id', '=', 'service.id')
            ->where('users.role', '=', 'patient')
            ->where('appointments.id', '=', $id)
            ->select('appointments.*', 'service.name as service_name', 'users.name as user_name', 'users.phone')
            ->get();
        $appointmentSlots = AppointmentSlot::where('doctor_id', '=', $appointments[0]->doctor_id)->where('date', \Carbon\Carbon::parse($appointments[0]->appoint_at)->format('Y-m-d'))->pluck('slot_id')->toArray();
        $slot_id = AppointmentSlot::where('appointment_id', $id)->first() ? AppointmentSlot::where('appointment_id', $id)->first()->slot_id : null;
        return view('admin.appointment.appoint_assign_form', ["appointments" => $appointments, "doctor" => $doctor, "slots" => $slots, 'appointmentSlots' => $appointmentSlots, "slot_id" => $slot_id]);
    }

    public function appointmentShow($id)
    {
        $appointment = Appointment::find($id);
        return view('admin.appointment.show', ["appointment" => $appointment]);
    }

    public function appointmentAssign()
    {
        // update appointment
        $appointment = Appointment::find(request('appointment_id'));
        $appointment->doctor_id = request('doctor_id');
        $appointment->status = 1;
        $appointment->appoint_at = date("Y-m-d H:i:s", strtotime(request('appoint_date') . ' ' . request('12:00')));
        $appointment->save();

        $as = AppointmentSlot::where('appointment_id', request('appointment_id'))->first();
        if ($as) {
            $as->delete();
        }
        AppointmentSlot::create([
            'appointment_id' => $appointment->id,
            'slot_id' => request('slot_id'),
            'date' => request('appoint_date'),
            'doctor_id' => request('doctor_id')
        ]);

        // redirect to appointment list
        return redirect('admin/appointment/list');
    }


    public function patientAddRFID($id)
    {

        $filter = [
            'id' => $id,
            'role' => 'patient',
        ];

        $patient = User::where($filter)->get();
        // dd($patient);

        return view('admin.patient.form_rfid', ["patient" => $patient]);
    }
    public function patientShow($id)
    {
        $patient = PatientProfile::where('patient_id', $id)->first();
        return view('admin.patient.show', ["patient" => $patient]);
    }
    //patientShow

    public function patientUpdateRFID(Request $request)
    {

        // patient rfid validated
        $validateData = $request->validate([
            'rfid' => 'required',
        ], [
            'rfid.required' => 'RFID is required.',
        ]);

        // update rfid on user table
        $user = User::find(request('user_id'));
        $user->rfid = request('rfid');
        $user->save();

        // update rfid on patient profile table
        $patient = PatientProfile::where('patient_id', request('user_id'))
            ->update(['rfid' => request('rfid')]);

        // return with success
        return redirect("/admin/patient/list")->with('success', 'Patient RFID Added Successfully');
    }

    // load patient update form
    public function patientEdit($id, $uid)
    {
        $patient = DB::table('patient_profile')
            ->join('users', 'patient_profile.patient_id', '=', 'users.id')
            ->where('users.role', '=', 'patient')
            ->where('patient_profile.id', '=', $id)
            ->select('patient_profile.*', 'users.name', 'users.email')
            ->get();
        return view('admin.patient.patient_edit_form', compact('id', 'uid', 'patient'));
    }

    // updated patient data
    public function patientEditStore()
    {
        // patient row id
        $id = request()->post('id');

        // create patient data object for patient table
        $data_doctor = array();

        // array for updated data
        $data = array();

        // update employee data of user table
        if (
            request()->post('password') ||
            request()->post('email') ||
            request()->post('phone') ||
            request()->post('name')
        ) {

            // patient/user id
            $user_id = request()->post('patient_id');

            // create patient data object for user table
            $user_data = array();

            if (request()->post('name')) {
                $user_data['name'] = request()->post('name');
            }
            if (request()->post('password')) {
                $user_data['password'] = bcrypt(request()->post('password'));
            }
            if (request()->post('email')) {
                $user_data['email'] = request()->post('email');
            }
            if (request()->post('phone')) {
                $user_data['phone'] = request()->post('phone');
            }

            $user_result = User::where('id', '=', $user_id)->update($user_data);
        }

        if (request()->post('phone')) {
            $data['phone'] = request()->post('phone');
        }

        if (request()->post('age')) {
            $data['age'] = request()->post('age');
        }

        if (request()->post('address')) {
            $data['address'] = request()->post('address');
        }

        if (request()->post('nid')) {
            $data['nid'] = request()->post('nid');
        }

        if (request()->post('gender')) {
            $data['gender'] = request()->post('gender');
        }

        if (request()->post('blood')) {
            $data['blood'] = request()->post('blood');
        }

        $result = PatientProfile::where('id', '=', $id)->update($data);

        return redirect('admin/patient/list');
    }

    // change patient status
    public function patientChangeStatus($id)
    {
        $data = PatientProfile::find($id);
        $data->status = ($data->status == 1) ? 0 : 1;
        $data->save();
        return redirect('admin/patient/list');
    }

    // soft delete patient data
    public function patientDelete($id)
    {
        $data = PatientProfile::find($id);
        $data->status = 3;
        $data->save();
        return redirect('admin/patient/list');
    }
}
