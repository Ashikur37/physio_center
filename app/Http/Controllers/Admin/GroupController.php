<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Machine;
use App\Models\User;
use App\Models\Therapy;
use App\Models\Payment;
use App\Models\TherapyGroup;
use App\Models\TherapyMachine;

class GroupController extends Controller
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


    public function add()
    {
        $machines = Machine::all();
        return view('admin.therapy.therapy_form', compact('machines'));
    }

    public function store(Request $request)
    {


        // create Therapy data object
        $data = [
            'name' => request('name'),

        ];

        // store Therapy
        $group = Group::create($data);
        if ($request->therapies) {
            foreach ($request->therapies as $therapy) {
                TherapyGroup::create([
                    'therapy_id' => $therapy,
                    'group_id' => $group->id,
                    'quantity' => 0
                ]);
            }
        }

        return redirect()->route('group.index');
    }

    public function index()
    {
        $lists = Group::latest()->get();
        return view('admin.group.index', ['lists' => $lists]);
    }
    public function create()
    {
        $therapies = Therapy::all();
        return view('admin.group.create', compact('therapies'));
    }

    public function paymentNew($user_id)
    {
        $history = Payment::where('user_id', '=', $user_id)->get();
        return view('admin.therapy.payment_new_form', ['user_id' => $user_id, 'history' => $history]);
    }

    public function paymentNewStore()
    {
        $data = [
            'user_id' => request('user_id'),
            'patient_id' => request('user_id'),
            'amount' => request('amount'),
            'sub_total' => request('amount'),
            'advanced_pay' => request('amount'),
            'type' => 4,
        ];

        $result = Payment::create($data);

        return redirect('admin/therapy/payment-list');
    }

    public function paymentAdvanced($user_id)
    {
        return view('admin.therapy.payment_advanced_form', ['user_id' => $user_id]);
    }

    public function paymentAdvancedStore()
    {
    }

    public function paymentHistory($user_id)
    {
        $lists = Payment::where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
        return view('admin.therapy.payment_history_form', ['user_id' => $user_id, 'lists' => $lists]);
    }

    public function paymentHistoryStore()
    {
    }

    // load therapy update form
    public function edit($id)
    {
        $therapy = Therapy::find($id);
        $machines = Machine::all();
        $therapy_machines = TherapyMachine::where('therapy_id', $id)->get()->pluck('machine_id')->toArray();
        return view('admin.therapy.therapy_edit_form', compact('therapy', 'machines', 'therapy_machines'));
    }

    // updated therapy data
    public function editStore()
    {
        // therapy id for update data
        $id = request()->post('id');

        // array for updated data
        $data = array();

        if (request()->post('therapy_name')) {
            $data['therapy_name'] = request()->post('therapy_name');
        }

        if (request()->post('price')) {
            $data['price'] = request()->post('price');
        }

        if (request()->post('duration')) {
            $data['duration'] = request()->post('duration');
        }

        if (request()->post('doses')) {
            $data['doses'] = request()->post('doses');
        }

        $result = Therapy::where('id', '=', $id)->update($data);
        //therapy machine update
        foreach (request()->post('machines') as $machine_id) {
            //delete all therapy machine of this therapy
            TherapyMachine::where('therapy_id', $id)->delete();

            TherapyMachine::updateOrCreate([
                'therapy_id' => $id,
                'machine_id' => $machine_id
            ], []);
        }


        return redirect('admin/therapy/list');
    }

    // change therapy status
    public function changeStatus($id)
    {
        $data = Therapy::find($id);
        $data->status = ($data->status == 1) ? 0 : 1;
        $data->save();
        return redirect('admin/therapy/list');
    }

    // soft delete therapy data
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('group.index');
    }
}
