<?php

namespace App\Http\Controllers\Employee;

use App\Models\Requisition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions = Requisition::where('user_id', auth()->user()->id)->orWhere('employee_id', auth()->user()->id)->get();
        return view('employee.requisition.index', compact('requisitions'));
    }
    public function approve(Requisition $requisition)
    {
        $requisition->update([
            "emp_approved" => 1
        ]);
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', 'employee')->get();
        return view('employee.requisition.create', compact('users'));
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

        Requisition::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'employee_id' => $request->user_id,
        ]);
        return redirect('employee/requisition/list')->with('success', 'Requisition created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show(Requisition $requisition)
    {
        return view('employee.requisition.show', compact('requisition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisition $requisition)
    {
        $users = User::where('role', 'employee')->get();

        return view('admin.requisition.edit', compact('requisition', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisition $requisition)
    {
        //name

        $requisition->update($request->all());
        return redirect()->route('requisition.index')->with('success', 'Requisition updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return redirect()->route('requisition.index')->with('success', 'Requisition deleted successfully');
    }
}
