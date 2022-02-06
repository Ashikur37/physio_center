<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PatientProfile;
use App\Models\Specialist;



class SpecialistController extends Controller
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

    // load specialist form
    public function add()
    {
        return view('admin.specialist.specialist_form');
    }

    // add new specialist
    public function store(Request $request)
    {
        // patient data validated
        $validateData = $request->validate([
            'name' => 'required',
          ],[
              'name.required' => 'Specialist Name is required.',
        ]);

        // create specialist data object
        $data = ['name' => request('name'), 'status' => 1];

        // store specialist
        $result = Specialist::create($data);

        return redirect('admin/specialist/list');
    }

    // load specialist list
    public function list()
    {
        $lists = Specialist::where('status', '!=', 3)->get();
        return view('admin.specialist.specialist_list', ['lists' => $lists]);
    }

    // load specialist update form
    public function edit($id){
        $specialist = Specialist::find($id);
        return view('admin.specialist.specialist_edit_form', compact('specialist'));
    }

    // updated specialist data
    public function editStore(){
        $data = [ 'name' => request()->post('name')];
        $id = request()->post('id');
        $result = Specialist::where('id', '=', $id)->update($data);
        return redirect('admin/specialist/list');
    }

    // change specialist status
    public function changeStatus($id){
        $data = Specialist::find($id);
        $data->status = ( $data->status == 1) ? 0: 1;
        $data->save();
        return redirect('admin/specialist/list');
    }

    // soft delete specialist data
    public function delete($id){
        $data = Specialist::find($id);
        $data->status = 3;
        $data->save();
        return redirect('admin/specialist/list');   
    }
}
