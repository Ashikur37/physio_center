<?php

namespace App\Http\Controllers\Accountant;

use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MobileAgent;
use App\Models\Requisition;
use App\Models\RequisitionPayment;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions = Requisition::where('emp_approved', 1)->latest()->get();
        return view('accountant.requisition.index', compact('requisitions'));
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
    public function show(Requisition $requisition)
    {
        return view('accountant.requisition.show', compact('requisition'));
    }

    public function pay(Requisition $requisition)
    {
        $mobileAgents = MobileAgent::all();
        return view('accountant.requisition.pay', compact('requisition', 'mobileAgents'));
    }
    public function paid(Request $request, Requisition $requisition)
    {
        $requisition->paid = $requisition->paid + $request->amount;
        $requisition->save();
        if ($request->is_cash == 0) {
            $mobileAgent = MobileAgent::find($request->mobile_agent_id);
            $mobileAgent->balance = $mobileAgent->balance - $request->amount;
            $mobileAgent->save();
        }
        RequisitionPayment::create(
            [
                'requisition_id' => $requisition->id,
                'user_id' => auth()->user()->id,
                'mobile_agent_id' => $request->mobile_agent_id,

                'amount' => $request->amount,
                'is_cash' => $request->is_cash,
                //sender_type	sender_number	trans_id
                'sender_type' => $request->type,
                'sender_number' => $request->number,
                'trans_id' => $request->trans_id

            ]
        );
        return back();
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
