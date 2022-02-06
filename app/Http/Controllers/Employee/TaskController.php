<?php

namespace App\Http\Controllers\Employee;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TaskAssign;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignTasks = TaskAssign::where('assigned_to', auth()->user()->id)->pluck('task_id')->toArray();
        $tasks = Task::where('user_id', auth()->user()->id)->orWhereIn('id', $assignTasks)->get();

        return view('employee.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', '!=', 'patient')->get();
        return view('employee.task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //name

        $task = Task::create([
            "title" => $request->title,
            "description" => $request->description,
            "user_id" => auth()->user()->id,
        ]);
        TaskAssign::create([
            'task_id' => $task->id,
            'assigned_by' => auth()->user()->id,
            'assigned_to' => $request->user_id
        ]);
        return redirect('/employee/task')->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $users =  User::where('role', '!=', 'patient')->get();
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
