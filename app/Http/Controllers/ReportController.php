<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveCalculation;
use App\Models\LeaveType;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buildLeaves = Leave::where('id', '>', 0);

        if ($request->nameAuto == null && $request->surname != null)
            return redirect()->back()->withInput()->with('danger', 'Both name and surname must be entered');

        if ($request->surname == null && $request->nameAuto != null)
            return redirect()->back()->withInput()->with('danger', 'Both name and surname must be entered');

        $employee = Employee::where('name', '=', $request->nameAuto)
            ->where('surname', '=', $request->surname)->first();

        if($employee) {
            if ($request->leaveType_id != null)
                $buildLeaves = $buildLeaves->where('leaveType_id', '=', $request->leaveType_id)
                    ->where('employee_id', '=', $employee->id);
            else
                $buildLeaves = $buildLeaves->where('employee_id', '=', $employee->id);
        } else {
            if ($request->leaveType_id != null)
                $buildLeaves = $buildLeaves->where('leaveType_id', '=', $request->leaveType_id);
        }
        $leaves = $buildLeaves->get();

        $leaveSummaries = array();
        foreach ($leaves as $leave)
        {
            $LeaveSummary = new LeaveSummary();
            $LeaveSummary->leaveId = $leave->id;
            $employee = Employee::find($leave->employee_id);
            $LeaveSummary->employeeNo = $employee->employee_no;
            $LeaveSummary->employeeSurname = $employee->surname;
            $LeaveSummary->employeeName = $employee->name;
            $LeaveSummary->leaveStart = $leave->start_date;
            $LeaveSummary->leaveEnd = $leave->end_date;

            $date1 = new Carbon($leave->start_date);
            $date2 = new Carbon($leave->end_date);
            $interval = $date1->diffInWeekdays($date2);
            $days = ++$interval;
            $LeaveSummary->duration = $days;

            $type = LeaveType::find($leave->leaveType_id);
            $LeaveSummary->leaveType = $type->type;
            if ($leave->approved == 'Y')
                $LeaveSummary->leaveStatus = 'Approved';
            elseif ($leave->approved == 'N')
                $LeaveSummary->leaveStatus = 'Pending';
            else
                $LeaveSummary->leaveStatus = 'Cancelled';
            array_push($leaveSummaries, $LeaveSummary);
        }
        return view('reports.leaveSummary', compact('leaveSummaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function annualLeave()
    {
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id)
            $employees = Employee::all();
        else
            $employees = Employee::where('company_id', '=', $user->company_id)->get();

        $annualLeaveBalances = array();
        foreach ($employees as $employee) {
            $annualLeaveBalance = new AnnualLeaveBalance();
            $annualLeaveBalance->id = $employee->id;
            $annualLeaveBalance->employeeNo = $employee->employee_no;
            $annualLeaveBalance->surname = $employee->surname;
            $annualLeaveBalance->name = $employee->name;
            $annualLeaveBalance->startDate = $employee->start_date;
            $leaveType = LeaveType::where('type', 'like', '%' . 'nnua' . '%')->first();
            $leaveCalculations = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                ->where('employee_id', '=', $employee->id)->first();
            $annualLeaveBalance->accumulatedLeave = $leaveCalculations->leaveDays_accumulated;
            $annualLeaveBalance->daysTaken = $leaveCalculations->leaveDays_taken;
            $annualLeaveBalance->daysRemaining = $leaveCalculations->leaveDays_accumulated - $leaveCalculations->leaveDays_taken;
            array_push($annualLeaveBalances, $annualLeaveBalance);
        }
        return view('reports.annualLeave', compact('annualLeaveBalances'));
    }
    public function sickLeave()
    {
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id)
            $employees = Employee::all();
        else
            $employees = Employee::where('company_id', '=', $user->company_id)->get();

        $annualLeaveBalances = array();
        foreach ($employees as $employee) {
            $annualLeaveBalance = new AnnualLeaveBalance();
            $annualLeaveBalance->id = $employee->id;
            $annualLeaveBalance->employeeNo = $employee->employee_no;
            $annualLeaveBalance->surname = $employee->surname;
            $annualLeaveBalance->name = $employee->name;
            $annualLeaveBalance->startDate = $employee->start_date;
            $leaveType = LeaveType::where('type', 'like', '%' . 'ick' . '%')->first();
            $leaveCalculations = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                ->where('employee_id', '=', $employee->id)->first();
            $annualLeaveBalance->accumulatedLeave = $leaveCalculations->leaveDays_accumulated;
            $annualLeaveBalance->daysTaken = $leaveCalculations->leaveDays_taken;
            $annualLeaveBalance->daysRemaining = $leaveCalculations->leaveDays_accumulated - $leaveCalculations->leaveDays_taken;
            array_push($annualLeaveBalances, $annualLeaveBalance);
        }
        return view('reports.sickLeave', compact('annualLeaveBalances'));
    }
    public function leaveRequests()
    {
        $leaves = Leave::all();
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();

        return view('reports.leaveSearch', compact('leaves', 'employees', 'leaveTypes'));
    }
}
class AnnualLeaveBalance
{
    public $id;
    public $employeeNo;
    public $surname;
    public $name;
    public $startDate;
    public $accumulatedLeave;
    public $daysTaken;
    public $daysRemaining;
}
class LeaveSummary
{
    public $leaveId;
    public $employeeNo;
    public $employeeName;
    public $employeeSurname;
    public $leaveStart;
    public $leaveEnd;
    public $duration;
    public $leaveType;
    public $leaveStatus;
}