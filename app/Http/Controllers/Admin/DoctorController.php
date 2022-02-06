<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Specialist;
use App\Models\Doctor;



class DoctorController extends Controller
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
        return view('home');
    }

    public function add()
    {
        $specialist = Specialist::get();
        return view('admin.doctor.add_doctor', ['specialist' => $specialist]);
    }

    public function store(Request $request)
    {
        // patient data validated
        $validateData = $request->validate([
            'name' => 'required',
            'phone' => 'required|regex:/^(0)[0-9]{10}$/',
            'email' => 'required|unique:users',
            'password' => 'required',
            'gender' => 'required',
            'specialist' => 'required',
            'nid' => 'required',
        ], [
            'name.required' => 'Doctor Name is required.',
            'phone.required' => 'phone Name is required.',
            'email.required' => 'email Name is required.',
            'password.required' => 'password Name is required.',
            'gender.required' => 'gender Name is required.',
            'specialist.required' => 'specialist Name is required.',
            'nid.required' => 'nid Name is required.',
        ]);

        // create doctor data object for user table
        $data_user = [
            'name' => request('name'),
            'email' => request('email'),
            'role' => 'doctor',
            'phone' => request('phone'),
            'password' => bcrypt(request('password')),
        ];

        // dd($data_user);
        // insert user table
        $id = User::create($data_user)->id;

        // create doctor data object for doctor table
        $data_doctor = [
            'user_id' => $id,
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender'),
            'visit' => request('visit'),

            'specialist_id' => request('specialist'),
            'nid' => request('nid'),
            'status' => 1
        ];

        // store doctor
        $result = Doctor::create($data_doctor);

        return redirect('admin/doctor/list');
    }

    public function list()
    {
        $doctors = DB::table('doctors')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->join('specialist_list', 'doctors.specialist_id', '=', 'specialist_list.id')
            ->where('users.role', '=', 'doctor')
            ->where('doctors.status', '!=', 3)
            ->select('doctors.*', 'specialist_list.name as specialist_list', 'users.name', 'users.email')
            ->latest()
            ->get();
        return view('admin.doctor.list_doctor', ['doctors' => $doctors]);
    }

    public function paymentList()
    {
        $lists = User::select('id', 'name', 'email', 'rfid', 'phone')->where('role', 'patient')->get();
        return view('admin.therapy.payment_list', ['lists' => $lists]);
    }


    // load doctor update form
    public function edit($id, $uid)
    {
        $specialist = Specialist::get();
        $doctor = Doctor::find($id);
        return view('admin.doctor.doctor_edit_form', compact('id', 'uid', 'doctor', 'specialist'));
    }

    // updated doctor data
    public function editStore()
    {
        // row id
        $id = request()->post('id');
        $uid = request()->post('uid');

        // create doctor data object for user table
        $data_user = array();
        // create doctor data object for doctor table
        $data_doctor = array();

        if (trim(request('name'))) {
            $data_user['name'] = request('name');
        }

        if (trim(request('email'))) {
            $data_user['email'] = request('email');
        }

        if (trim(request('phone'))) {
            $data_user['phone'] = request('phone');
        }

        if (trim(request('password'))) {
            $data_user['password'] =  bcrypt(request('password'));
        }

        // update user table with user data
        $result = User::where('id', '=', $uid)->update($data_user);

        // create doctor data object for doctor table
        if (trim(request('name'))) {
            $data_doctor['name'] = request('name');
        }
        if (trim(request('email'))) {
            $data_doctor['email'] = request('email');
        }
        if (trim(request('phone'))) {
            $data_doctor['phone'] = request('phone');
        }
        if (trim(request('gender'))) {
            $data_doctor['gender'] = request('gender');
        }
        if (trim(request('visit'))) {
            $data_doctor['visit'] = request('visit');
        }
        if (trim(request('specialist_id'))) {
            $data_doctor['specialist_id'] = request('specialist_id');
        }
        if (trim(request('nid'))) {
            $data_doctor['nid'] = request('nid');
        }

        // update doctor table
        $result = Doctor::where('id', '=', $id)->update($data_doctor);

        return redirect('admin/doctor/list');
    }

    // change doctor status
    public function changeStatus($id)
    {
        $data = Doctor::find($id);
        $data->status = ($data->status == 1) ? 0 : 1;
        $data->save();
        return redirect('admin/doctor/list');
    }

    // soft delete doctor data
    public function delete($id)
    {
        $data = Doctor::find($id);
        $data->status = 3;
        $data->save();
        $user = User::find($data->user_id);
        $user->delete();
        return redirect('admin/doctor/list');
    }
}
