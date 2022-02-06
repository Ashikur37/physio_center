<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentTest;
use App\Models\AppointmentTherapy;
use App\Models\User;
use App\Models\Therapy;
use App\Models\Doctor;
use App\Models\Group;
use App\Models\PatientProfile;
use App\Models\Refer;
use App\Models\TherapyAssign;
use App\Models\PrescriptionDetails;
use App\Models\Payment;
use App\Models\Test;

class DoctorAppointmentController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bloods = [1 => 'A+', 2 => 'A-', 3 => 'B+', 4 => 'B-', 5 => 'AB+', 6 => 'AB-', 7 => 'O+', 8 => 'O-'];
        $doctor_id = Doctor::where('user_id', $this->user_id)->first()->id;
        $refers = Refer::where('refer_doctor_id', $doctor_id)->pluck('appointment_id')->toArray();

        $appointments = DB::table('appointments')
            ->join('users', 'appointments.patient_id', '=', 'users.id')
            ->join('patient_profile', 'patient_profile.patient_id', '=', 'users.id')
            ->where(function ($query) use ($refers) {
                $query->whereIn('appointments.id', $refers)
                    ->orWhere('appointments.doctor_id', $this->user_id);
            })
            ->where('appointments.therapy_id', '=', 0)
            ->select('users.name as user_name', 'patient_profile.patient_id as p_id', 'patient_profile.age', 'patient_profile.blood', 'patient_profile.gender', 'appointments.details', 'appointments.appoint_at', 'appointments.id', 'appointments.refer_doctor_id')
            ->orderBy('appointments.created_at', 'desc')
            ->get();
        return view('doctor.appointment.index', ['appointments' => $appointments, 'bloods' => $bloods]);
    }

    public function show(Appointment $appointment)
    {
        return view('doctor.appointment.show', compact('appointment'));
    }



    public function therapyForm($id, $patient_id)
    {
        $groups = Group::all();
        $therapies = Therapy::where('status', 1)->get();
        $appointmentTherapies = AppointmentTherapy::where('appointment_id', $id)->get();
        $exists = [];
        foreach ($appointmentTherapies as $item) {

            $exists[$item->therapy_id] = $item->total;
        }


        $patient_id = $patient_id;
        return view(
            'doctor.appointment.therapy_form',
            ['appointment_id' => $id, 'patient_id' => $patient_id, 'therapies' => $therapies, 'groups' => $groups, 'exists' => $exists]
        );
    }

    public function therapyStore()
    {
        // data array for therapy assign table
        $data = [
            'appointment_id' => request('appointment_id'),
            'doctor_assign_id' => $this->user_id,
            'patient_id' => request('patient_id'),
            'therapy_id' => request('therapy_id')
        ];

        // store data to the therapy assign table
        $result = TherapyAssign::create($data);

        // get therapy price
        $price = Therapy::select('price')->where('id', request('therapy_id'))->get();

        // data for appointment table
        $data = ['therapy_id' => request('therapy_id'), 'amount' => $price[0]->price];

        // update appointment table
        $result = Appointment::where('id', request('appointment_id'))->update($data);

        // data for payment table
        $data = [
            'user_id' => request('patient_id'),
            'patient_id' => request('patient_id'),
            'amount' => $price[0]->price,
            'due_have' => $price[0]->price,
            'type' => 3
        ];

        // add payment table
        $result = Payment::create($data);

        return redirect('doctor/appointment/list');
    }

    public function referForm($id, $patient_id)
    {
        $patient_id = $patient_id;
        $doctors = Doctor::where('status', 1)->get();
        return view(
            'doctor.appointment.refer_form',
            ['appointment_id' => $id, 'patient_id' => $patient_id, 'doctors' => $doctors]
        );
    }

    public function prescription($id, $patient_id)
    {
        $profile = PatientProfile::where('patient_id', $patient_id)->first();
        $tests = Test::all();
        $patient_id = $patient_id;
        return view(
            'doctor.appointment.prescription_form',
            ['appointment_id' => $id, 'patient_id' => $patient_id, 'tests' => $tests, 'profile' => $profile]
        );
    }
    public function store(Request $request)
    {
        $image_tmp = request('image');

        $data = [
            'doctor_id' => $this->user_id,
            'patient_id' => request('patient_id'),
            'appointment_id' => request('appointment_id'),
            'details' => request('details'),
            'medicine_name' => json_encode(request('medicine_name')),
            'meal' => json_encode(request('meal')),
            'medicine_liquid' => json_encode(request('medicine_liquid')),
            'medicine_solid' => json_encode(request('medicine_solid')),
        ];
        $profile = PatientProfile::where('patient_id', request('patient_id'))->first();
        $profile->update([
            "bp" => request('bp') ? request('bp') : 0,
        ]);
        // upload prescription
        if ($image_tmp !== null) {
            $imageName = request('appointment_id') . '-' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }
        if ($request->tests) {
            foreach ($request->tests as $test) {
                AppointmentTest::updateOrCreate([
                    'appointment_id' => $request->appointment_id,
                    'test_id' => $test,
                ], []);
            }
        }


        // store prescription
        $result = PrescriptionDetails::create($data);

        return redirect('doctor/appointment/list');
    }

    public function referStore()
    {
        $data = [
            'patient_id' => request('patient_id'),
            'appointment_id' => request('appointment_id'),
            'refer_doctor_id' => request('refer_doctor_id')
        ];

        $result = Refer::create($data);

        return redirect('doctor/appointment/list');
    }

    // load therapy for a specific doctor
    public function therapyList()
    {
        $bloods = [1 => 'A+', 2 => 'A-', 3 => 'B+', 4 => 'B-', 5 => 'AB+', 6 => 'AB-', 7 => 'O+', 8 => 'O-'];
        $appointments = DB::table('appointments')
            ->join('users', 'appointments.patient_id', '=', 'users.id')
            ->join('patient_profile', 'patient_profile.patient_id', '=', 'users.id')
            ->where('appointments.doctor_id', '=', $this->user_id)
            ->where('appointments.therapy_id', '!=', 0)
            ->select('users.name as user_name', 'patient_profile.patient_id as p_id', 'patient_profile.age', 'patient_profile.blood', 'patient_profile.gender', 'appointments.details', 'appointments.appoint_at', 'appointments.id', 'appointments.refer_doctor_id')
            ->get();

        //dd($appointments);
        return view('doctor.therapy.therapy_list', ['appointments' => $appointments, 'bloods' => $bloods]);
    }


    public function therapyUpdate($appointment_id, $patient_id)
    {
        $therapy = DB::table('therapy_assign')
            ->join('appointments', 'appointments.id', '=', 'therapy_assign.appointment_id')
            ->join('therapy', 'therapy.id', '=', 'therapy_assign.therapy_id')
            ->where('therapy_assign.doctor_assign_id', '=', $this->user_id)
            ->where('therapy_assign.appointment_id', '=', $appointment_id)
            ->where('therapy_assign.patient_id', '=', $patient_id)
            ->where('therapy_assign.status', '=', 1)
            ->select(
                'therapy.id as therapy_id',
                'therapy.therapy_name',
                'therapy.doses as no_doses',
                'therapy.duration as duration',
                'appointments.details',
                'appointments.status as appointment_status',
                'therapy_assign.id as assign_id',
                'therapy_assign.doese_complete',
                'therapy_assign.doese_history',
            )
            ->get();
        //$history = (array) json_decode($therapy[0]->doese_history);

        return view(
            'doctor.therapy.therapy_update_form',
            ['patient_id' => $patient_id, 'appointment_id' => $appointment_id, 'therapy' => $therapy]
        );
    }

    public function therapyUpdateStore()
    {

        $prev_doses_history = (array) json_decode(request('doses_history'));

        if ($prev_doses_history == null) {
            $history = [
                ['does' => 1, 'date' => date('Y-m-d'), 'note' => request('note')]
            ];
            $update_doses_history = json_encode($history);
        } else {

            $size = 1 + sizeof($prev_doses_history);
            $prev_doses_history[$size] = [
                'does' => $size,
                'date' => date('Y-m-d'),
                'note' => request('note')
            ];
            $update_doses_history = json_encode($prev_doses_history);
        }

        $data = [
            'doese_complete' => request('doses_complete') + request('doses_given'),
            'doese_history' => $update_doses_history,
            'status' => request('status')
        ];

        $where = [
            'id' => request('assign_id'),
            'appointment_id' => request('appointment_id'),
            'patient_id' => request('patient_id'),
            'doctor_assign_id' => $this->user_id,
            'therapy_id' => request('therapy_id'),
        ];

        $result = TherapyAssign::where($where)->update($data);

        return redirect("doctor/therapy/list");
    }

    public function searchPatientForm()
    {

        $users = array();
        $query = array('type' => 0, 'value' => '');

        if (request()->get('type') != null && request()->get('data') != null) {

            // assign query values for database query
            $type = request()->get('type');
            $user =  request()->get('data');

            // set query value for frontend
            $query = array('type' => $type, 'value' => $user);

            // query for fetch user
            $patients = DB::table('users');

            if ($type == 1) {
                $patients = $patients->where('rfid', 'like',  '%' . $user . '%');
            } elseif ($type == 2) {
                $patients = $patients->where('phone', 'like',  '%' . $user . '%');
            } elseif ($type == 3) {
                $patients = $patients->where('id', 'like',  '%' . $user . '%');
            }
            $patients = $patients->where('role', '=', 'patient');

            $patients = $patients->select('users.id', 'users.name', 'users.rfid', 'users.phone');
            $users = $patients->get();

            //$patients = $patients->join('appointments', 'appointments.patient_id', '=', 'users.id');
            //$patients = $patients->join('patient_profile', 'patient_profile.patient_id', '=', 'users.id');
            //$patients = $patients->where('appointments.doctor_id', '=', $this->user_id);
            //$patients = $patients->where('appointments.therapy_id', '!=', 0);
            //$patients = $patients->select('users.name as user_name', 'patient_profile.patient_id as p_id', 'patient_profile.age', 'patient_profile.blood', 'patient_profile.gender', 'appointments.details', 'appointments.appoint_at', 'appointments.id','appointments.refer_doctor_id');
            //$patients = $patients->get();
        }

        return view("doctor/patient/search_form", compact('users', 'query'));
    }

    // display patient details view
    public function patientHistory($id)
    {
        // get patient information
        $user = DB::table('users')
            ->join('patient_profile', 'patient_profile.patient_id', '=', 'users.id', 'left')
            ->where('users.id', '=', $id)
            ->where('users.role', '=', 'patient')
            ->select('users.name', 'users.rfid', 'patient_profile.*')
            ->get();

        // get appointment(prescription) information
        $prescription = DB::table('appointments')
            ->join('service', 'service.id', '=', 'appointments.service_id', 'left')
            ->join('prescription_details', 'prescription_details.appointment_id', '=', 'appointments.id', 'left')
            ->where('appointments.patient_id', '=', $id)
            ->select('service.name as service_name', 'appointments.*')
            ->get();

        // get appointment(therapy) information
        $histories = DB::table('appointments')
            ->join('service', 'service.id', '=', 'appointments.service_id', 'left')
            ->join('therapy', 'therapy.id', '=', 'appointments.therapy_id', 'left')
            ->where('appointments.patient_id', '=', $id)
            ->where('appointments.therapy_id', '!=', 0)
            ->select('service.name as service_name', 'therapy.therapy_name', 'appointments.*')
            ->get();

        //dd($prescription);

        // load patient history details
        return view("doctor/patient/patient_history_details", compact('id', 'user', 'prescription', 'histories'));
    }

    public function patientAppViewHistory($appointment_id)
    {
        $therapy = DB::table('appointments')
            ->join('therapy_assign', 'appointments.id', '=', 'therapy_assign.appointment_id')
            ->join('therapy', 'therapy.id', '=', 'appointments.therapy_id')
            ->where('appointments.id', '=', $appointment_id)
            ->select(
                'therapy.id as therapy_id',
                'therapy.therapy_name',
                'therapy.doses as no_doses',
                'therapy.duration as duration',
                'appointments.details',
                'appointments.status as appointment_status',
                'therapy_assign.doese_complete',
                'therapy_assign.doese_history',
            )
            ->get();

        return view('doctor.patient.patient_app_view_history', ['appointment_id' => $appointment_id, 'therapy' => $therapy]);
    }

    public function storeAnotherTherapy(Request $request)
    {
        $appointment = Appointment::find($request->appointment_id);
        $charge = 0;
        AppointmentTherapy::whereNotIn('therapy_id', $request->therapies)->where('appointment_id', $request->appointment_id)->delete();
        for ($i = 0; $i < count($request->therapies); $i++) {
            if (!$request->quantities[$request->therapies[$i]]) {
                continue;
            }
            //appointment_id	therapy_id	total	given status
            $appointmentTherapy = AppointmentTherapy::where('appointment_id', $request->appointment_id)->where('therapy_id', $request->therapies[$i])->first();
            if ($appointmentTherapy) {
                $appointmentTherapy->total = $request->quantities[$request->therapies[$i]];
                $appointmentTherapy->save();
            } else {
                $appointmentTherapy = AppointmentTherapy::create([
                    'appointment_id' => $request->appointment_id,
                    'therapy_id' => $request->therapies[$i],
                    'total' => $request->quantities[$request->therapies[$i]],
                    'given' => 0,
                ]);
            }
            $therapy = Therapy::find($request->therapies[$i]);
            $charge += $request->quantities[$request->therapies[$i]] * $therapy->price;
        }


        $doctor = Doctor::where('user_id', $appointment->doctor_id)->first();
        $appointment->update([
            'amount' => $appointment->is_waiver ? 0 : ($charge + $doctor->visit),
        ]);
        return redirect()->route('doctor.appointment.show', $request->appointment_id);


        // data array for therapy assign table
        // $data = [
        //     'appointment_id' => request('appointment_id'),
        //     'doctor_assign_id' => auth()->user()->id,
        //     'patient_id' => request('patient_id'),
        //     'therapy_id' => request('therapy_id')
        // ];

        // // store data to the therapy assign table
        // $result = TherapyAssign::create($data)->id;

        // // find the therapy price
        // $therapy = Therapy::find(request()->post('therapy_id'));
        // // find appointment information
        // $appointment = Appointment::find(request()->post('appointment_id'));

        // // update therapy id with another therapy with comma separator
        // if ($appointment->therapy_id == 0) {
        //     $appointment->therapy_id = request()->post('therapy_id');
        // } else {
        //     $appointment->therapy_id = $appointment->therapy_id . ',' . request()->post('therapy_id');
        // }

        // // update previous assign id with new one
        // // if (is_null($appointment->assign_id)) {
        // //     $appointment->assign_id = $result;
        // // } else {
        // //     $appointment->assign_id = $appointment->assign_id . ',' . $result;
        // // }

        // // update previous amount with new one
        // $appointment->amount = $appointment->amount + $therapy->price;
        // // update appointment table
        // $appointment->save();

        // // data for payment table
        // $data = [
        //     'user_id'    => request('patient_id'),
        //     'patient_id' => request('patient_id'),
        //     'amount'     => $therapy->price,
        //     'due_have'   => $therapy->price,
        //     'type'       => 3
        // ];

        // // add payment table
        // $result = Payment::create($data);

        // return redirect('doctor/therapy/list');
    }

    public function patientAppUpdateHistory($app_id)
    {
        dd($app_id);
    }

    public function searchPatientTherapyUpdate($appointment_id, $patient_id)
    {
        $therapy = DB::table('therapy_assign')
            ->join('appointments', 'appointments.id', '=', 'therapy_assign.appointment_id')
            ->join('therapy', 'therapy.id', '=', 'therapy_assign.therapy_id')
            ->where('therapy_assign.doctor_assign_id', '=', $this->user_id)
            ->where('therapy_assign.appointment_id', '=', $appointment_id)
            ->where('therapy_assign.patient_id', '=', $patient_id)
            ->where('therapy_assign.status', '=', 1)
            ->select(
                'therapy.id as therapy_id',
                'therapy.therapy_name',
                'therapy.doses as no_doses',
                'therapy.duration as duration',
                'appointments.details',
                'appointments.status as appointment_status',
                'therapy_assign.id as assign_id',
                'therapy_assign.doese_complete',
                'therapy_assign.doese_history',
            )
            ->get();
        //$history = (array) json_decode($therapy[0]->doese_history);

        return view(
            'doctor.patient.search_patient_therapy_update_form',
            ['patient_id' => $patient_id, 'appointment_id' => $appointment_id, 'therapy' => $therapy]
        );
    }

    public function searchPatientStoreTherapyUpdate()
    {

        $prev_doses_history = (array) json_decode(request('doses_history'));

        if ($prev_doses_history == null) {
            $history = [
                ['does' => 1, 'date' => date('Y-m-d'), 'note' => request('note')]
            ];
            $update_doses_history = json_encode($history);
        } else {

            $size = 1 + sizeof($prev_doses_history);
            $prev_doses_history[$size] = [
                'does' => $size,
                'date' => date('Y-m-d'),
                'note' => request('note')
            ];
            $update_doses_history = json_encode($prev_doses_history);
        }

        $data = [
            'doese_complete' => request('doses_complete') + request('doses_given'),
            'doese_history' => $update_doses_history,
            'status' => request('status')
        ];

        $where = [
            'id' => request('assign_id'),
            'appointment_id' => request('appointment_id'),
            'patient_id' => request('patient_id'),
            'therapy_id' => request('therapy_id'),
        ];

        $result = TherapyAssign::where($where)->update($data);

        return redirect("doctor/patient/history/" . request('patient_id'));
    }

    public function searchPatientTherapyAddForm($id, $patient_id)
    {
        $therapy = Therapy::where('status', 1)->get();
        $patient_id = $patient_id;
        return view(
            'doctor.patient.therapy_add_form',
            ['appointment_id' => $id, 'patient_id' => $patient_id, 'therapy' => $therapy]
        );
    }

    public function searchPatientStoreTherapy()
    {
        // data array for therapy assign table
        $data = [
            'appointment_id'    => request('appointment_id'),
            'doctor_assign_id'  => request('doctor_assign_id'),
            'patient_id'        => request('patient_id'),
            'therapy_id'        => request('therapy_id')
        ];

        // store data to the therapy assign table
        $result = TherapyAssign::create($data)->id;

        // find the therapy price
        $therapy = Therapy::find(request()->post('therapy_id'));
        // find appointment information
        $appointment = Appointment::find(request()->post('appointment_id'));

        // update therapy id with another therapy with comma separator
        if ($appointment->therapy_id == 0) {
            $appointment->therapy_id = request()->post('therapy_id');
        } else {
            $appointment->therapy_id = $appointment->therapy_id . ',' . request()->post('therapy_id');
        }

        // update previous assign id with new one
        if (is_null($appointment->assign_id)) {
            $appointment->assign_id = $result;
        } else {
            $appointment->assign_id = $appointment->assign_id . ',' . $result;
        }

        // update previous amount with new one
        $appointment->amount = $appointment->amount + $therapy->price;
        // update appointment table
        $appointment->save();

        // data for payment table
        $data = [
            'user_id'    => request('patient_id'),
            'patient_id' => request('patient_id'),
            'amount'     => $therapy->price,
            'due_have'   => $therapy->price,
            'type'       => 3
        ];

        // add payment table
        $result = Payment::create($data);

        return redirect('doctor/patient/history/' . request('patient_id'));
    }
}
