<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveCalculation;
use App\Models\LeaveType;
use Carbon\Carbon;
use Faker\Provider\cs_CZ\DateTime;
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
            $employees = Employee::where('company_id', '=', $employee->company_id)
                ->where('employee_status', '=', 'A')->get();
        else
            $employees = Employee::where('employee_status', '=', 'A')->get();

        $leaveApplications = array();
        foreach ($employees as $employee)
        {
            $leaves = Leave::where('employee_id', '=', $employee->id)
                ->where('approved', '=', 'N')->get();
            if ($leaves)
            {
                foreach ($leaves as $leave)
                {
                    $leaveApplication = new LeaveApplication();
                    $leaveApplication->leaveId = $leave->id;
                    $leaveApplication->employeeNo = $employee->employee_no;
                    $leaveApplication->name = $employee->name;
                    $leaveApplication->surname = $employee->surname;
                    $leaveType = LeaveType::where('id', '=', $leave->leaveType_id)->first();
                    $leaveApplication->leaveType = $leaveType->type;
                    $leaveApplication->start_date = $leave->start_date;
                    $leaveApplication->end_date = $leave->end_date;
                    array_push($leaveApplications, $leaveApplication);
                }
            }
        }
        return view('leave.index', compact('leaveApplications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $pieces = array_filter( explode("?",$_SERVER['QUERY_STRING'] ));
        $params = array();
        //add all the parameters into a array called $params
        foreach ($pieces as $param) {
            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }
        if (array_key_exists("id",$params))
        {
            $employeesQuery = Employee::where('id', '>', 0);
            $employeesQuery = $employeesQuery->wherein('id', $params["id"]);
            $employee = $employeesQuery->first();
        } else
            $employee = null;
        $leaveTypes = LeaveType::all();
        return view('leave.add', compact('leaveTypes', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->employee_id == null)
            $employee = Employee::where('name', '=', $request->input('name'))
                ->where('surname', '=', $request->input('surname'))->first();
        else
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
        $leave = Leave::find($id);
        $leaveTypes = LeaveType::all();
        $employee = Employee::where('id', '=', $leave->employee_id)->first();
        $lid = Leave::find($id)->leaveType_id;
        return view('leave.edit', compact('leave', 'leaveTypes', 'employee', 'lid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave, $id)
    {
        $leave = Leave::find($id);
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->leaveType_id = $request->leaveType_id;

        if ($leave->update())
            return Redirect::route('leaves')->with('success', 'Successfully updated leave');
        else
            return Redirect::route('editLeave', [$id])->withInput()->withErrors($leave->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave, $id)
    {
        $leave = Leave::find($id);
        if ($leave->delete())
            return Redirect::route('leaves')->with('warning', 'Employees" leave has been cancelled');
        else
            return Redirect::route('leaves')->withInput()->withErrors($leave->errors());
    }
    public function approve(Request $request, $id)
    {
        $leave = Leave::find($id);
        $date1 = new Carbon($leave->start_date);
        $date2 = new Carbon($leave->end_date);
        $interval = $date1->diffInWeekdays($date2);
        $days = ++$interval;

        $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leave->leaveType_id)
            ->where('employee_id', '=', $leave->employee_id)->first();

        if ($leaveCalculation) {
            //if ($days > $leaveCalculation->leaveDays_available)
            //    return Redirect::route('leave.add')->with('warning', 'Available leave days are less than applied days!');

            $leaveCalculation->leaveDays_accumulated = $leaveCalculation->leaveDays_accumulated - $days;
            $leaveCalculation->leaveDays_taken = $leaveCalculation->leaveDays_taken + $days;

            $leave->approved = 'Y';
            $leave->update();

            if ($leaveCalculation->update())
                return Redirect::route('leaves')->with('success', 'Successfully approved leave for employee');
            else
                return Redirect::route('leaves')->withInput()->withErrors($leave->errors());
        }
    }
}
class LeaveApplication {
    public $leaveId;
    public $employeeNo;
    public $name;
    public $surname;
    public $leaveType;
    public $start_date;
    public $end_date;
}

