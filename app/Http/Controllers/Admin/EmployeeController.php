<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Compounder;
use App\Models\User;
use App\Models\Specialist;
use App\Models\Doctor;



class EmployeeController extends Controller
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
        return view('admin.emp.add_compounder');
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
            'nid' => 'required',
        ], [
            'name.required' => 'Doctor Name is required.',
            'phone.required' => 'phone Name is required.',
            'email.required' => 'email Name is required.',
            'password.required' => 'password Name is required.',
            'gender.required' => 'gender Name is required.',
            'nid.required' => 'nid Name is required.',
        ]);

        // create doctor data object for user table
        $data_user = [
            'name' => request('name'),
            'email' => request('email'),
            'email' => request('email'),

            'role' => 'employee',
            'phone' => request('phone'),
            'password' => bcrypt(request('password')),
        ];


        // dd($data_user);
        // insert user table
        $user = User::create($data_user);
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
            $user->save();
        }
        $id = $user->id;
        // create doctor data object for doctor table
        $data_doctor = [
            'user_id' => $id,
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'gender' => request('gender'),
            'nid' => request('nid'),
            'status' => 1
        ];

        // store doctor
        $result = Compounder::create($data_doctor);

        return redirect('admin/employee/list');
    }

    public function list()
    {
        $doctors = DB::table('compounders')
            ->join('users', 'compounders.user_id', '=', 'users.id')
            ->where('users.role', '=', 'employee')
            ->where('compounders.status', '!=', 3)
            ->select('compounders.*', 'users.name', 'users.email', 'users.image', 'users.id as uid')
            ->get();
        return view('admin.emp.list_compounder', ['doctors' => $doctors]);
    }

    public function paymentList()
    {
        $lists = User::select('id', 'name', 'email', 'rfid', 'phone')->where('role', 'patient')->get();
        return view('admin.therapy.payment_list', ['lists' => $lists]);
    }


    // load doctor update form
    public function edit($id, $uid)
    {

        $doctor = Compounder::find($id);

        return view('admin.emp.compounder_edit_form', compact('id', 'uid', 'doctor'));
    }

    // updated doctor data
    public function editStore(Request $request)
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
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data_user['image']  = $imageName;
        }
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

        if (trim(request('nid'))) {
            $data_doctor['nid'] = request('nid');
        }

        // update doctor table
        $result = Compounder::where('id', '=', $id)->update($data_doctor);

        return redirect('admin/employee/list');
    }

    // change doctor status
    public function changeStatus($id)
    {
        $data = Compounder::where('id', $id)->firstOrFail();
        $data->status = ($data->status == 1) ? 0 : 1;
        $data->save();
        return redirect('admin/employee/list');
    }

    // soft delete doctor data
    public function delete($id)
    {
        $data = Compounder::find($id);
        $data->status = 3;
        $data->save();
        $user = User::find($data->user_id);
        $user->delete();
        return redirect('admin/employee/list');
    }
}
