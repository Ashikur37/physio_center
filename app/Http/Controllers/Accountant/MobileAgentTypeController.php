<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\MobileAgentType;
use Illuminate\Http\Request;

class MobileAgentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mobile agent list
        $mobileAgentTypes = MobileAgentType::all();
        return view('accountant.mobile_type.index', compact('mobileAgentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show create view
        return view('accountant.mobile_type.create');
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
        $mobileAgentType = new MobileAgentType();
        $mobileAgentType->name = $request->name;

        $mobileAgentType->save();
        //redirect to index
        return redirect()->route('mobile-agent-type.index');
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
        $mobileAgentType = MobileAgentType::find($id);
        return view('accountant.mobile_type.edit', compact('mobileAgentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileAgentType $mobileAgentType)
    {

        $mobileAgentType->name = $request->name;

        $mobileAgentType->save();
        //redirect to index
        return redirect()->route('mobile-agent-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileAgentType $mobileAgentType)
    {
        $mobileAgentType->delete();
        return redirect()->route('mobile-agent-type.index');
    }
}
