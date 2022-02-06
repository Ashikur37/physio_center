<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\MobileAgent;
use App\Models\MobileAgentType;
use Illuminate\Http\Request;

class MobileAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mobile agent list
        $mobileAgents = MobileAgent::all();
        return view('accountant.mobile.index', compact('mobileAgents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mobileAgentTypes = MobileAgentType::all();
        //show create view
        return view('accountant.mobile.create', compact('mobileAgentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //type	number	balance
        $mobileAgent = new MobileAgent();
        $mobileAgent->type = $request->type;
        $mobileAgent->number = $request->number;

        $mobileAgent->balance = 0;
        $mobileAgent->save();
        //redirect to index
        return redirect()->route('mobile-agent.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mobileAgent = MobileAgent::find($id);
        return view('accountant.mobile.edit', compact('mobileAgent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileAgent $mobileAgent)
    {
        $mobileAgent->type = $request->type; {
            $mobileAgent->type = $request->type;
            $mobileAgent->number = $request->number;

            $mobileAgent->balance = $request->balance ? $request->balance : $mobileAgent->balance;

            $mobileAgent->save();
            //redirect to index
            return redirect()->route('mobile-agent.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileAgent $mobileAgent)
    {
        $mobileAgent->delete();
        return redirect()->route('mobile-agent.index');
    }
}
