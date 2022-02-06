<?php

namespace App\Http\Controllers\Employee;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\LeaveType;
use App\Models\TaskAssign;
use App\Models\User;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveApplications = LeaveApplication::where('user_id', auth()->user()->id)->latest()->get();

        return view('employee.leave_application.index', compact('leaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = LeaveType::all();
        return view('employee.leave_application.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //user_id,leave_type_id,start_date,end_date,status,days,description
        LeaveApplication::create([
            'user_id' => auth()->user()->id,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
            'days' => 0,
            'description' => $request->description,
        ]);
        return redirect()->route('leave-application.index')->with('success', 'Leave application submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $users = User::where('role', 'employee')->get();
        return view('employee.task.show', compact('task', 'users'));
    }
    public function assign(Request $request, Task $task)
    {
        TaskAssign::create([
            'task_id' => $task->id,
            'assigned_by' => auth()->user()->id,
            'assigned_to' => $request->user_id
        ]);
        return back()->with('success', 'Task assigned successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = User::where('role', '!=', 'patient')->get();

        return view('admin.task.edit', compact('task', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //name

        $task->update($request->all());
        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task deleted successfully');
    }
}
