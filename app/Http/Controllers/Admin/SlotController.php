<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slots = Slot::all();
        return view('admin.slot.index', compact('slots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slot.create');
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
            'start' => 'required|unique:slots|max:255',
            'end' => 'required|unique:slots|max:255',

        ]);
        Slot::create($request->all());
        return redirect()->route('slot.index')->with('success', 'Slot created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function show(Slot $slot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function edit(Slot $slot)
    {
        return view('admin.slot.edit', compact('slot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slot $slot)
    {
        //name
        $this->validate($request, [
            'start' => 'required|max:255',
        ]);
        $slot->update($request->all());
        return redirect()->route('slot.index')->with('success', 'Slot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slot  $slot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slot $slot)
    {
        $slot->delete();
        return redirect()->route('slot.index')->with('success', 'Slot deleted successfully');
    }
}
