<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRegister;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeType;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AttendanceRegisterController extends Controller
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
     * Search the specified resource.
     *
     * @param  \App\Models\AttendanceRegister  $attendanceRegister
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();
        if ($employee) {
            $departments = Department::where('company_id', '=', $employee->company_id)->get();
            $teams = Team::where('company_id', '=', $employee->company_id)->get();
        } else {
            $departments = Department::all();
            $teams = Team::all();
        }
        $employeeTypes = EmployeeType::all();
        return view('attendanceRegister.search', compact('departments', 'teams', 'employeeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $employee = Employee::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $pieces = array_filter( explode("&",$_SERVER['QUERY_STRING'] ));
        $params = array();
        //add all the parameters into a array called $params
        foreach ($pieces as $param) {
            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }
        $employeesQuery = Employee::where('id', '>', 0);

        if (array_key_exists("employeeType_id",$params))
        {
            $employeesQuery = $employeesQuery->wherein('employeeType_id', $params["employeeType_id"]);
        }
        if(count($params) > 0)
        {
            if (array_key_exists("dept_id",$params))
            {
                $employeesQuery = $employeesQuery->wherein('dept_id',$params["dept_id"]);
            }
            if (array_key_exists("team_id",$params))
            {
                $employeesQuery = $employeesQuery->wherein('team_id',$params["team_id"]);
            }
        }
        if ($employee)
            $employees = $employeesQuery->where('company_id', '=', $employee->company_id)->get();
        else
            $employees = $employeesQuery->get();

        $dates = $request->start_date;

        $date2 = date('Y-m-d', strtotime($dates));
        $date2 = Carbon::parse($date2)->format('Y-m-d');

        $employeesRegisterArray = array();
        foreach ($employees as $employee)
        {
            //* don't forget to validate employees when it's not the super user logged in
            $employeesRegister = new EmployeesRegister();
            $employeesRegister->id = $employee->id;
            $employeesRegister->employeeNo = $employee->employee_no;
            $employeesRegister->surname = $employee->surname;
            $employeesRegister->name = $employee->name;
            $employeeType = EmployeeType::find($employee->employeeType_id);
            $employeesRegister->employeeType = $employeeType->employee_type;
            $attendanceRegister = AttendanceRegister::where('employee_id', '=', $employee->id)
                ->where('dayOfWeek', '>=', $date2)->get();

            if ($attendanceRegister) {
                $cnt = 1;
                foreach ($attendanceRegister as $register) {
                    if ($cnt == 1)
                        $employeesRegister->day1Reg = $register->register;
                    if ($cnt == 2)
                        $employeesRegister->day2Reg = $register->register;
                    if ($cnt == 3)
                        $employeesRegister->day3Reg = $register->register;
                    if ($cnt == 4)
                        $employeesRegister->day4Reg = $register->register;
                    if ($cnt == 5)
                        $employeesRegister->day5Reg = $register->register;
                    if ($cnt == 6)
                        $employeesRegister->day6Reg = $register->register;
                    if ($cnt == 7) {
                        $employeesRegister->day7Reg = $register->register;
                        break;
                    }
                    $cnt = ++$cnt;
                }
            } else {
                $employeesRegister->day1Reg = null;
                $employeesRegister->day2Reg = null;
                $employeesRegister->day3Reg = null;
                $employeesRegister->day4Reg = null;
                $employeesRegister->day5Reg = null;
                $employeesRegister->day6Reg = null;
                $employeesRegister->day7Reg = null;
            }
            array_push($employeesRegisterArray, $employeesRegister);
        }
        $day1 = null; $day2 = null; $day3 = null; $day4 = null; $day5 = null; $day6 = null; $day7 = null; $str_day1 = null;
        $last_date = null;
        $type = $employeeType->employee_type;
        $datePagination = Carbon::now();
        $checkPagination = $datePagination->format('Y-m-d');

        for ($i = 0; $i < 7; $i++)
        {
            $create_date = Carbon::parse($date2)->addDays($i);
            if ($create_date->format('Y-m-d') <= $checkPagination) {
                if ($i == 0) {
                    $day1 = $create_date->format('Y-m-d');
                }
                if ($i == 1) {
                    $day2 = $create_date->format('Y-m-d');
                }
                if ($i == 2) {
                    $day3 = $create_date->format('Y-m-d');
                }
                if ($i == 3) {
                    $day4 = $create_date->format('Y-m-d');
                }
                if ($i == 4) {
                    $day5 = $create_date->format('Y-m-d');
                }
                if ($i == 5) {
                    $day6 = $create_date->format('Y-m-d');
                }
                if ($i == 6) {
                    $day7 = $create_date->format('Y-m-d');
                }
            }
        }
        if ($day7 != null) {
            if ($day7 < $checkPagination)
                $paginateRight = 'Yes';
            else
                $paginateRight = 'No';
        } else
            $paginateRight = 'No';
        return view('attendanceRegister.add', compact('employeesRegisterArray', 'day1', 'day2', 'day3', 'day4',
            'day5', 'day6', 'day7', 'type', 'paginateRight'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pageDate = Carbon::now();
        $endDate = $pageDate->format('Y-m-d');

        $input = $request->all();
        $employees = $request->input('employee_id');
        $day1Register = $request->input('day1Register');
        $day2Register = $request->input('day2Register');
        $day3Register = $request->input('day3Register');
        $day4Register = $request->input('day4Register');
        $day5Register = $request->input('day5Register');
        $day6Register = $request->input('day6Register');
        $day7Register = $request->input('day7Register');

        $arrayLength = count($employees);

        for ($i = 0; $i < $arrayLength; $i++) {

            $employee = Employee::find($employees[$i]);

            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day1'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day1Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day1')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day1');
                    $attendanceRegister->register = $day1Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day2'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day2Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day2')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day2');
                    $attendanceRegister->register = $day2Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day3'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day3Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day3')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day3');
                    $attendanceRegister->register = $day3Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day4'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day4Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day4')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day4');
                    $attendanceRegister->register = $day4Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day5'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day5Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day5')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day5');
                    $attendanceRegister->register = $day5Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day6'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day6Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day6')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day6');
                    $attendanceRegister->register = $day6Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $attRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day7'))
                ->where('employee_id', '=', $employee->id)->first();
            if ($attRegister) {
                $attRegister->register = $day7Register[$i];
                $attRegister->update();
            } else {
                if ($employee->start_date <= $request->input('day7')) {
                    $attendanceRegister = new AttendanceRegister($input);
                    $attendanceRegister->dayOfWeek = $request->input('day7');
                    $attendanceRegister->register = $day7Register[$i];
                    $attendanceRegister->employeeType_id = $employee->employeeType_id;
                    $attendanceRegister->employee_id = $employees[$i];
                    $attendanceRegister->save();
                }
            }
            $this->calculateLeave($employees[$i]);
        }
        if ($endDate > $request->input('day7') && $request->input('day7') != null) {
            $attendanceRegister = AttendanceRegister::where('dayOfWeek', '=', $request->input('day7'))->first();
            $day7 = $attendanceRegister->dayOfWeek;
            $type = $attendanceRegister->employeeType_id;
            return Redirect::route('paginateRight', ['type' => $type, 'day7' => $day7]);
        } else
            return Redirect::route('annualLeave')->with('success', 'Successfully captured employees" register!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendanceRegister  $attendanceRegister
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceRegister $attendanceRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendanceRegister  $attendanceRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceRegister $attendanceRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttendanceRegister  $attendanceRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceRegister $attendanceRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceRegister  $attendanceRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendanceRegister $attendanceRegister)
    {
        //
    }
    public function calculateLeave($id)
    {
        $employee = Employee::find($id);
        $attendanceRegister = AttendanceRegister::where('employee_id', '=', $employee->id)->get();
        $grandTotalHours = 0;
        $grandTotalDays = 0;
        $empType = EmployeeType::where('employee_type', 'like', '%' . 'hift' . '%')
            ->where('id', '=', $employee->employeeType_id)->first();

        foreach ($attendanceRegister as $register)
        {
            if ($empType)
            {
                if ($register->register == 'P')
                    $grandTotalDays = ++$grandTotalDays;
            } else {
                if ($register->register != null)
                    $grandTotalHours = $grandTotalHours + $register->register;
            }
        }
        if ($empType) {
            $calculated_leave = $grandTotalDays / 17;
        } else {
            $grandTotalDays = $grandTotalHours / 8;
            $calculated_leave = $grandTotalDays / 17;
        }
        //store Leave Calculation table
        $type = LeaveType::where('type', 'like', '%' . 'nnua' . '%')->first();
        $leaveCalcEmployee = LeaveCalculation::where('leaveType_id', '=', $type->id)
            ->where('employee_id', '=', $employee->id)->first();

        $leaveCalculation = new LeaveCalculation();

        $leaveCalculation->work_daysPerWeek = $leaveCalcEmployee->work_daysPerWeek;
        $leaveCalculation->leaveDays_accumulated = $calculated_leave;
        $leaveCalculation->leaveDays_taken = $leaveCalcEmployee->leaveDays_taken;
        $leaveCalculation->leaveType_id = $type->id;
        $leaveCalculation->employee_id = $employee->id;
        if ($leaveCalcEmployee)
            $leaveCalcEmployee->delete();
        $leaveCalculation->save();
    }
    public function paginateRight(Request $request)
    {
        $employees = Employee::where('employeeType_id', '=', $request->type)->get();
        $paginateRight = 'Yes';

        $employeesRegisterArray = array();
        foreach ($employees as $employee)
        {
            $employeeRegister = new EmployeesRegister();
            $employeeRegister->id = $employee->id;
            $employeeRegister->employeeNo = $employee->employee_no;
            $employeeRegister->surname = $employee->surname;
            $employeeRegister->name = $employee->name;
            $employeeType = EmployeeType::find($employee->employeeType_id);
            $employeeRegister->employeeType = $employeeType->employee_type;
            $attendanceRegister = AttendanceRegister::where('dayOfWeek', '>', $request->day7)
                ->where('employeeType_id', '=', $request->type)
                ->where('employee_id', '=', $employee->id)->get();
            if ($attendanceRegister) {
                $cnt = 1;
                foreach ($attendanceRegister as $register)
                {
                    if ($cnt == 1)
                        $employeeRegister->day1Reg = $register->register;
                    if ($cnt == 2)
                        $employeeRegister->day2Reg = $register->register;
                    if ($cnt == 3)
                        $employeeRegister->day3Reg = $register->register;
                    if ($cnt == 4)
                        $employeeRegister->day4Reg = $register->register;
                    if ($cnt == 5)
                        $employeeRegister->day5Reg = $register->register;
                    if ($cnt == 6)
                        $employeeRegister->day6Reg = $register->register;
                    if ($cnt == 7) {
                        $employeeRegister->day7Reg = $register->register;
                        break;
                    }
                    $cnt = $cnt + 1;
                }
            } else {
                $employeeRegister->day1Reg = null;
                $employeeRegister->day2Reg = null;
                $employeeRegister->day3Reg = null;
                $employeeRegister->day4Reg = null;
                $employeeRegister->day5Reg = null;
                $employeeRegister->day6Reg = null;
                $employeeRegister->day7Reg = null;
            }
            array_push($employeesRegisterArray, $employeeRegister);
        }
        $pageDate = Carbon::now();
        $endDate = $pageDate->format('Y-m-d');
        $day7 = $request->day7;
        $type = $employeeType->employee_type;

        while ($request->day7 < $endDate && $day7 == $request->day7)
        {
            $day1 = Carbon::parse($day7)->addDays(1);
            $day1 = $day1->format('Y-m-d');

            if ($day1 < $endDate && $day1 != null) {
                $day2 = Carbon::parse($day1)->addDays(1);
                $day2 = $day2->format('Y-m-d');
            } else
                $day2 = null;

            if ($day2 < $endDate && $day2 != null) {
                $day3 = Carbon::parse($day2)->addDays(1);
                $day3 = $day3->format('Y-m-d');
            } else
                $day3 = null;

            if ($day3 < $endDate && $day3 != null) {
                $day4 = Carbon::parse($day3)->addDays(1);
                $day4 = $day4->format('Y-m-d');
            } else
                $day4 = null;

            if ($day4 < $endDate && $day4 != null) {
                $day5 = Carbon::parse($day4)->addDays(1);
                $day5 = $day5->format('Y-m-d');
            } else
                $day5 = null;

            if ($day5 < $endDate && $day5 != null) {
                $day6 = Carbon::parse($day5)->addDays(1);
                $day6 = $day6->format('Y-m-d');
            } else
                $day6 = null;

            if ($day6 < $endDate && $day6 != null) {
                $day7 = Carbon::parse($day6)->addDays(1);
                $day7 = $day7->format('Y-m-d');
            } else
                $day7 = null;
        }
        if ($day1 == $endDate or $day2 == $endDate or $day3 == $endDate or $day4 == $endDate or $day5 == $endDate or
            $day6 == $endDate or $day7 == $endDate)
            $paginateRight = 'No';

        return view('attendanceRegister.add', compact('employeesRegisterArray', 'day1', 'day2', 'day3', 'day4',
            'day5', 'day6', 'day7', 'type', 'paginateRight'));
    }
    public function paginateLeft(Request $request)
    {
        $employees = $request->employeesRegisterArray;
        $day1 = $request->day1;
        for($i = 0; $i < 7; $i++)
        {
            if ($i == 0) {
                $day7 = Carbon::parse($day1)->subDays(1);
                $day7 = $day7->format('Y-m-d');
            }
            if ($i == 1) {
                $day6 = Carbon::parse($day7)->subDays(1);
                $day6 = $day6->format('Y-m-d');
            }
            if ($i == 2) {
                $day5 = Carbon::parse($day6)->subDays(1);
                $day5 = $day5->format('Y-m-d');
            }
            if ($i == 3) {
                $day4 = Carbon::parse($day5)->subDays(1);
                $day4 = $day4->format('Y-m-d');
            }
            if ($i == 4) {
                $day3 = Carbon::parse($day4)->subDays(1);
                $day3 = $day3->format('Y-m-d');
            }
            if ($i == 5) {
                $day2 = Carbon::parse($day3)->subDays(1);
                $day2 = $day2->format('Y-m-d');
            }
            if ($i == 6) {
                $day1 = Carbon::parse($day2)->subDays(1);
                $day1 = $day1->format('Y-m-d');
            }
        }
        $employeesRegisterArray = array();
        foreach ($employees as $employee)
        {
            $employeeRegister = new EmployeesRegister();
            $employeeRegister->id = $employee['id'];
            $employeeRegister->employeeNo = $employee['employeeNo'];
            $employeeRegister->surname = $employee['surname'];
            $employeeRegister->name = $employee['name'];
            $employeeRegister->employeeType = $employee['employeeType'];
            $employeeType = EmployeeType::where('employee_type', 'like', '%' . $employee['employeeType'] . '%')->first();
            $attendanceRegister = AttendanceRegister::where('dayOfWeek', '<', $request->day1)
                ->where('employeeType_id', '=', $employeeType->id)
                ->where('employee_id', '=', $employee['id'])->orderBy('dayOfWeek', 'DESC')->get();
            if ($attendanceRegister) {
                $cnt = 1;
                foreach ($attendanceRegister as $register)
                {
                    if ($cnt == 1) {
                        if ($day7 == $register->dayOfWeek)
                            $employeeRegister->day7Reg = $register->register;
                        else
                            $employeeRegister->day7Reg = null;
                    }
                    if ($cnt == 2) {
                        if ($day6 == $register->dayOfWeek)
                            $employeeRegister->day6Reg = $register->register;
                        else
                            $employeeRegister->day6Reg = null;
                    }
                    if ($cnt == 3) {
                        if ($day5 == $register->dayOfWeek)
                            $employeeRegister->day5Reg = $register->register;
                        else
                            $employeeRegister->day5Reg = null;
                    }
                    if ($cnt == 4) {
                        if ($day4 == $register->dayOfWeek)
                            $employeeRegister->day4Reg = $register->register;
                        else
                            $employeeRegister->day4Reg = null;
                    }
                    if ($cnt == 5) {
                        if ($day3 == $register->dayOfWeek)
                            $employeeRegister->day3Reg = $register->register;
                        else
                            $employeeRegister->day3Reg = null;
                    }
                    if ($cnt == 6) {
                        if ($day2 == $register->dayOfWeek)
                            $employeeRegister->day2Reg = $register->register;
                        else
                            $employeeRegister->day2Reg = null;
                    }
                    if ($cnt == 7) {
                        if ($day1 == $register->dayOfWeek)
                            $employeeRegister->day1Reg = $register->register;
                        else
                            $employeeRegister->day1Reg = null;
                        break;
                    }
                    $cnt = $cnt + 1;
                }
            } else {
                $employeeRegister->day1Reg = null;
                $employeeRegister->day2Reg = null;
                $employeeRegister->day3Reg = null;
                $employeeRegister->day4Reg = null;
                $employeeRegister->day5Reg = null;
                $employeeRegister->day6Reg = null;
                $employeeRegister->day7Reg = null;
            }
            array_push($employeesRegisterArray, $employeeRegister);
            $type = $employee['employeeType'];
        }
        $paginateRight = 'Yes';
        return view('attendanceRegister.add', compact('employeesRegisterArray', 'day1', 'day2', 'day3', 'day4',
            'day5', 'day6', 'day7', 'type', 'paginateRight'));
    }
}
class EmployeesRegister
{
    public $id;
    public $employeeNo;
    public $surname;
    public $name;
    public $employeeType;
    public $day1Reg;
    public $day2Reg;
    public $day3Reg;
    public $day4Reg;
    public $day5Reg;
    public $day6Reg;
    public $day7Reg;
}
