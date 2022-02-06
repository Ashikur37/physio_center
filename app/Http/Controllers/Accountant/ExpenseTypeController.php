<?php

namespace App\Http\Controllers\Accountant;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseTypes = ExpenseType::all();
        return view('accountant.expense_type.index', compact('expenseTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accountant.expense_type.create');
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
        $this->validate($request, [
            'name' => 'required|unique:expense_types|max:255',
        ]);
        ExpenseType::create($request->all());
        return redirect()->route('expense-type.index')->with('success', 'ExpenseType created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseType $expenseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseType $expenseType)
    {
        return view('accountant.expense_type.edit', compact('expenseType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseType $expenseType)
    {
        //name
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $expenseType->update($request->all());
        return redirect()->route('expense-type.index')->with('success', 'ExpenseType updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();
        return redirect()->route('expense-type.index')->with('success', 'ExpenseType deleted successfully');
    }
}
