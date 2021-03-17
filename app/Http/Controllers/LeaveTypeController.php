<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaveTypes = DB::table('leaveTypes')->get();
        return view('leaveType.index', ['leaveTypes' => $leaveTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('leaveType.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leaveType = LeaveType::where('type', '=', $request->type)->count();
        if ($leaveType > 0) {
            return redirect('leaveType/add')->withInput()->with('danger', 'Leave type already exists');
        }

        $input = $request->all();
        $leaveType = new LeaveType($input);

        if ($leaveType->save())
            return Redirect::route('leaveTypes')->with('success', 'Successfully added leave type');
        else
            return Redirect::route('addLeaveType')->withInput()->withErrors($leaveType->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaveType $leaveType, $id)
    {
        $leaveType = LeaveType::find($id);
        return view('leaveType.edit', compact('leaveType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaveType $leaveType, $id)
    {
        $leaveType = LeaveType::find($id);
        $type_check = LeaveType::where('type', '=', $request->type)->get()->first();

        if ($type_check && $type_check->id != $id)
            return Redirect::route('editLeaveType', [$id])->withInput()->with('danger', 'Leave type already exists');

        $leaveType->type = $request->type;
        $leaveType->cycle_length = $request->cycle_length;
        $leaveType->daysPerCycle = $request->daysPerCycle;

        if ($leaveType->update())
            return Redirect::route('leaveTypes')->with('success', 'Successfully updated leave type');
        else
            return Redirect::route('editLeaveType', [$id])->withInput()->withErrors($leaveType->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaveType $leaveType, $id)
    {
        $leaveType = LeaveType::findOrFail($id);
        $leave = Leave::where('leaveType_id', '=', $leaveType->id)->first();

        if ($leave)
            return Redirect::route('leaveTypes')->with('danger', 'There were leaves booked for this leave type');
        else {
            $leaveType->delete();
            return Redirect::route('leaveTypes')->with('success', 'Leave type successfully deleted');
        }
    }
}
