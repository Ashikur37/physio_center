<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserAttendence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserAttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->date) {
            $date = request()->date;
        } else {
            $date = date('Y-m-d');
        }
        $userAttendences = UserAttendence::where('attendence_date', $date)->get();
        $users = User::where('role', '!=', 'patient')->get();

        if ($userAttendences->count() == 0) {

            foreach ($users as $user) {
                UserAttendence::create(
                    [
                        'user_id' => $user->id,
                        'attendence_date' => $date,
                    ]
                );
            }
            $userAttendences = UserAttendence::where('attendence_date', $date)->get();
        }
        return view('admin.user_attendence.index', compact('date', 'userAttendences', 'users'));
    }


    public function report()
    {
        $userAttendences = UserAttendence::whereIn('attendence_date', [request()->start, request()->end])->select('attendence_date', DB::raw('sum(present) as present,sum(on_leave) as on_leave'))->groupBy('attendence_date')->get();
        $totalUser = User::where('role', '!=', 'patient')->count();
        return view('admin.user_attendence.report', compact('userAttendences', 'totalUser'));
    }
    public function userLeave()
    {

        $leaveApplications = LeaveApplication::latest()->get();
        return view('admin.leave.index', compact('leaveApplications'));
    }
    //
    public function approveLeave($id)
    {
        $leaveApplication = LeaveApplication::find($id);
        $leaveApplication->status = 1;
        $leaveApplication->save();
        return redirect()->back();
    }

    public function updateLeave($id)
    {
        $leaveApplication = LeaveApplication::find($id);
        $leaveApplication->start_date = request()->start;
        $leaveApplication->end_date = request()->end;
        $leaveApplication->save();
        return redirect()->back();
    }
    public function showLeave($id)
    {
        $leaveApplication = LeaveApplication::find($id);
        return view('admin.leave.show', compact('leaveApplication'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.machine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        UserAttendence::where('attendence_date', $request->date)->whereIn('user_id', $request->user)->update(['present' => 1]);
        UserAttendence::where('attendence_date', $request->date)->whereNotIn('user_id', $request->user)->update(['present' => 0]);
        return redirect('admin/user-attendence?date=' . $request->date);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAttendence  $machine
     * @return \Illuminate\Http\Response
     */
    public function show(UserAttendence $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAttendence  $machine
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAttendence $machine)
    {
        return view('admin.machine.edit', compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAttendence  $machine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAttendence $machine)
    {
        //name
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $machine->update($request->all());
        return redirect()->route('machine.index')->with('success', 'UserAttendence updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAttendence  $machine
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAttendence $machine)
    {
        $machine->delete();
        return redirect()->route('machine.index')->with('success', 'UserAttendence deleted successfully');
    }
}
