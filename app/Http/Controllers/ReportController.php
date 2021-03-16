<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        if ($employee)
            $employees = Employee::where('company_id', '=', $employee->company_id)->get();
        else
            $employees = Employee::all();

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
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();
        if ($employee)
            $employees = Employee::where('company_id', '=', $employee->company_id)->get();
        else
            $employees = Employee::all();

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