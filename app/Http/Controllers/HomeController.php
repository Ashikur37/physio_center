<?php

namespace App\Http\Controllers;

use App\Models\AppoinmentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\AppointmentTherapy;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\PatientProfile;
use App\Models\Payment;
use App\Models\Refer;
use App\Models\Therapy;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $user_id;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;
            return $next($request);
        });
    }
    public function history(AppointmentTherapy $appointmentTherapy)
    {
        return view('patient.appointment.history', compact('appointmentTherapy'));
    }
    /**
     * Show the patient dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role_manage = [];

        if (isset(Auth()->user()->role_manage)) {
            $role_manage = json_decode(Auth()->user()->role_manage);
        }

        // dd($role_manage);
        return view('home', compact('role_manage'));
    }

    public function patientindex()
    {
        $role_manage = [];

        if (isset(Auth()->user()->role_manage)) {
            $role_manage = json_decode(Auth()->user()->role_manage);
        }

        $appointments = Appointment::where('patient_id', $this->user_id)->pluck('id')->toArray();
        $therapyCounts = AppointmentTherapy::whereIn('appointment_id', $appointments)->sum('total');
        $therapyCompletedCounts = AppointmentTherapy::whereIn('appointment_id', $appointments)->sum('given');

        $totalBills = Appointment::where('patient_id', $this->user_id)->sum('amount');
        $totalDiscount = Appointment::where('patient_id', $this->user_id)->sum('discount');
        $totalGiven = Appointment::where('patient_id', $this->user_id)->sum('given');


        // dd($role_manage);
        return view('patient.home', compact('role_manage', 'appointments', 'therapyCounts', 'therapyCompletedCounts', 'totalBills', 'totalDiscount', 'totalGiven'));
    }
    public function doctorindex()
    {
        $role_manage = [];

        if (isset(Auth()->user()->role_manage)) {
            $role_manage = json_decode(Auth()->user()->role_manage);
        }
        $appointments = Appointment::where('doctor_id', $this->user_id)->pluck('id')->toArray();
        $refer = Refer::where('refer_doctor_id', $this->user_id)->count();
        $therapyCounts = AppointmentTherapy::whereIn('appointment_id', $appointments)->sum('total');
        $therapyCompletedCounts = AppointmentTherapy::whereIn('appointment_id', $appointments)->sum('given');
        $doctor = Doctor::where('user_id', $this->user_id)->first();
        $totalPatient = Appointment::where('doctor_id', $this->user_id)->distinct('patient_id')->count('patient_id');
        // dd($role_manage);
        return view('doctor.home', compact('totalPatient', 'doctor', 'role_manage', 'refer', 'appointments', 'therapyCounts', 'therapyCompletedCounts'));
    }

    /**
     * Show the appointment create page.
     *
     * @author Muhammad Hasan
     * @param
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appointment()
    {
        $services = Service::select('id', 'name')->where('status', 1)->get();
        return view('patient.appointment.add', ["services" => $services]);
    }

    //
    public function showAppointment(Appointment $appointment)
    {
        return view('patient.appointment.show', ["appointment" => $appointment]);
    }


    /**
     * Show appointment list page.
     *
     * @author Muhammad Hasan
     * @param
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appointmentList()
    {
        $appointments = Appointment::appointmentListById($this->user_id);
        return view('patient.appointment.list', ["appointments" => $appointments]);
    }

    public function prescription($appointment)
    {
        $lists = DB::table('appointments')
            ->join('prescription_details', 'appointments.id', '=', 'prescription_details.appointment_id')
            ->where('appointments.id', '=', $appointment)
            ->select('appointments.*', 'prescription_details.*')
            ->get();

        $therapy = DB::table('appointments')
            ->join('service', 'service.id', '=', 'appointments.service_id')
            ->join('doctors', 'doctors.user_id', '=', 'appointments.doctor_id')
            ->where('appointments.id', '=', $appointment)
            ->where('appointments.therapy_id', '!=', 0)
            ->select('appointments.*', 'service.name as service_name', 'doctors.name as doctor_name')
            ->get();

        return view('patient.appointment.presription_details', ['lists' => $lists, 'therapy' => $therapy]);
    }


    /**
     * Show appointment edit form.
     *
     * @author Muhammad Hasan
     * @param int id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appointmentEdit($id)
    {
        $services = Service::select('id', 'name')->where('status', 1)->get();
        $appointment = Appointment::select('id', 'service_id', 'details', 'appoint_at')->where(['id' => $id])->get();

        // prepare output
        $output = [
            "services" => $services,
            "appointment" => $appointment
        ];
        // dd($output);
        return view('patient.appointment.edit', $output);
    }

    /**
     * update appointment data.
     *
     * @author Muhammad Hasan
     * @param int id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appointmentUpdate()
    {
        try {
            $id = request('id');

            $update = [
                "service_id" => request('service_id'),
                "details" => request('details'),
                "appoint_at" => date("Y-m-d H:i:s", strtotime(request('appoint_date') . ' ' . request('appoint_time')))
            ];

            $affected = DB::table("appointments")
                ->where('id', $id)
                ->update($update);

            // return with success
            return redirect("/patient/appointment/list")->with('success', 'Appointment update successfully');
        } catch (\Exception $e) {
            // return with error
            return redirect('/patient/appointment/list')->with('error', $e->getMessage());
        }
    }

    /**
     * store a new appointment
     *
     * @author Muhammad Hasan
     * @param
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        try {
            // service_id
            $service = Service::where('name', request('service_id'))->first();
            if (!$service) {
                $service = Service::create([
                    'name' => request('service_id'),
                    'desc' => 'det',
                    'status' => 1
                ]);
            }
            $appointment = new Appointment;
            $appointment->patient_id = Auth::user()->id;
            $appointment->service_id = $service->id;
            $appointment->details = request('details');
            $appointment->appoint_at = date("Y-m-d H:i:s", strtotime(request('appoint_date') . ' ' . request('appoint_time')));
            $appointment->save();
            // return with success
            return redirect('/patient/appointment')->with('success', 'Data store successfully');
        } catch (\Exception $e) {
            // return with error
            return redirect('/patient/appointment')->with('error', $e->getMessage());
        }
    }

    /**
     * load patient profile page.
     *
     * @author Muhammad Hasan
     * @param
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $data = DB::table('patient_profile')
            ->join('users', 'patient_profile.patient_id', '=', 'users.id')
            ->where('patient_profile.patient_id', '=', $this->user_id)
            ->select('users.name as userName', 'patient_profile.*')
            ->get();
        // dd($data);
        return view('patient.profile.profile_details', ['data' => $data]);
    }

    /**
     * update patient profile information.
     *
     * @author Muhammad Hasan
     * @param
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profileUpdate(Request $request)
    {

        $validateData = $request->validate([
            'phone' => 'required',
            'age' => 'required',
            'blood' => 'required',
            'gender' => 'required',
            'nid' => 'required',
            'patient_id' => 'required'
        ], [
            'phone.required' => 'Phone is required.',
            'age.required' => 'Age is required.',
            'blood.required' => 'Bloog group is required.',
            'gender.required' => 'Gender is required.',
            'nid.required' => 'NID is required.',
        ]);
        //upload image
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
            $user = User::find(auth()->user()->id);
            $user->image = $imageName;
            $user->save();
        }
        $result = PatientProfile::updateProfile($validateData, $this->user_id);

        return redirect('patient/profile');
    }

    public function paymentHistory()
    {
        $appointments = Appointment::appointmentListById($this->user_id);
        $ids = $appointments->pluck('id')->toArray();
        $payments = AppoinmentPayment::whereIn('appointment_id', $ids)->get();

        return view('patient.appointment.payment_history', compact("payments"));
    }

    public function appointmentTherapy($appointment)
    {
        $therapy = DB::table('therapy_assign')
            ->join('therapy', 'therapy.id', '=', 'therapy_assign.therapy_id')
            ->where('therapy_assign.appointment_id', '=', $appointment)
            ->select('therapy.*', 'therapy_assign.*')
            ->get();
        return view('patient.appointment.therapy_details_view', compact("therapy"));
    }
}
