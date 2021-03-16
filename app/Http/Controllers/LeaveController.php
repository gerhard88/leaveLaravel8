<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveCalculation;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        if ($employee)
            $employees = Employee::where('company_id', '=', $employee->company_id)->get();
        else
            $employees = Employee::all();
        $leaves = Leave::all();
        return view('leave.index', compact('employees', 'leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $leaveTypes = LeaveType::all();
        return view('leave.add', compact('leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::where('name', '=', $request->input('nameAuto'))
            ->where('surname', '=', $request->input('surname'))->first();

        $input = $request->all();
        $leave = new Leave($input);
        $leave->employee_id = $employee->id;

        if ($leave->save())
            return Redirect::route('annualLeave')->with('success', 'Successfully captured leave for employee!');
        else
            return Redirect::route('addLeave')->withInput()->withErrors($leave->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave, $id)
    {
        $employee = Employee::find($id);
        $leave = Leave::all();
        return view('editLeave', compact('employee', 'leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
    public function approveLeave(Reequest $request, $id)
    {
        $employee = Employee::find($id);

        $date1 = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
        $date2 = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        $interval = $date1->diffInDays($date2);
        $days = ++$interval;

        $leaveType = LeaveType::where('id', '=', $request->input('leaveType_id'))->first();
        $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
            ->where('employee_id', '=', $employee->id)->first();

        if ($leaveCalculation) {
            if ($days > $leaveCalculation->leaveDays_available)
                return Redirect::route('leave.add')->with('warning', 'Available leave days are less than applied days!');

            $leaveCalculation->leaveDays_available = $leaveCalculation->leaveDays_available - $days;
            $leaveCalculation->leaveDays_taken = $leaveCalculation->leaveDays_taken + $days;
            $leaveCalculation->update();
        }

        $input = $request->all();
        $leave = new Leave($input);
        $leave->employee_id = $employee->id;

        if ($leave->save())
            return Redirect::route('annualLeave')->with('success', 'Successfully captured leave for employee!');
        else
            return Redirect::route('addLeave')->withInput()->withErrors($leave->errors());
    }
}
