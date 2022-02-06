<?php

namespace App\Http\Controllers\Accountant;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpensePayment;
use App\Models\ExpenseType;
use App\Models\MobileAgent;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return view('accountant.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = ExpenseType::all();
        return view('accountant.expense.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Expense::create([
            "expense_type_id" => $request->expense_type_id,
            "amount" => $request->amount,
            "description" => $request->description,
            "title" => $request->title,
            "user_id" => auth()->user()->id
        ]);
        return redirect()->route('expense.index')->with('success', 'Expense created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $types = ExpenseType::all();
        return view('accountant.expense.edit', compact('expense', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $expense->update([
            "expense_type_id" => $request->expense_type_id,
            "amount" => $request->amount,
            "description" => $request->description,
            "title" => $request->title,
            "user_id" => auth()->user()->id
        ]);
        return redirect()->route('expense.index')->with('success', 'Expense updated successfully');
    }

    public function pay(Expense $expense)
    {
        $mobileAgents = MobileAgent::all();
        return view('accountant.expense.pay', compact('expense', 'mobileAgents'));
    }
    public function paid(Request $request, Expense $expense)
    {
        $expense->paid = $expense->paid + $request->amount;
        $expense->save();
        if ($request->is_cash == 0) {
            $mobileAgent = MobileAgent::find($request->mobile_agent_id);
            $mobileAgent->balance = $mobileAgent->balance - $request->amount;
            $mobileAgent->save();
        }
        ExpensePayment::create(
            [
                'expense_id' => $expense->id,
                'user_id' => auth()->user()->id,
                'mobile_agent_id' => $request->mobile_agent_id,

                'amount' => $request->amount,
                'is_cash' => $request->is_cash,
                //sender_type	sender_number	trans_id
                'receiver_type' => $request->type,
                'receiver_number' => $request->number,
                'trans_id' => $request->trans_id

            ]
        );
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully');
    }
}
