<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeHistory;
use App\Models\EmployeeType;
use App\Models\LeaveCalculation;
use App\Models\LeaveType;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validationRules=[
        'employeeType_id' => 'required|numeric|digits_between:1,9999',
        'dob' => 'date_format:Y-m-d',
        'start_date' => 'date_format:Y-m-d',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id)
            $employees = Employee::where('employee_status', '=', 'A')->get();
        else
            $employees = Employee::where('company_id', '=', $user->company_id)
                ->where('employee_status', '=', 'A')->get();

        $employeesArray = array();

        foreach ($employees as $employee)
        {
            $employeeArray = new Employee();
            $employeeArray->id = $employee->id;
            $employeeArray->name = $employee->name;
            $employeeArray->surname = $employee->surname;
            $employeeArray->employeeNo = $employee->employee_no;
            $employeeArray->dateOfBirth = $employee->dob;
            $employeeArray->idNo = $employee->idNo;
            $employeeArray->gender = $employee->gender;
            $employeeArray->contactNo = $employee->contact_no;
            $employeeArray->emailAddress = $employee->email;
            $employeeArray->startDate = $employee->start_date;
            $employeeArray->occupation = $employee->occupation;
            $employeeType = EmployeeType::find($employee->employeeType_id);
            $employeeArray->employeeType = $employeeType->employee_type;
            array_push($employeesArray, $employeeArray);
        }
        return view('employee.index', ['employeesArray' => $employeesArray]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id) {
            $countries = Country::all();
            $companies = Company::all();
            $departments = Department::all();
            $teams = Team::all();
        } else {
            $companies = Company::where('id', '=', $user->company_id)->get();
            foreach ($companies as $company)
            {
                if ($company->id == $user->company_id)
                    $countries = Country::where('id', '=', $company->country_id)->get();
            }
            $departments = Department::where('company_id', '=', $user->company_id)->get();
            $teams = Team::where('company_id', '=', $user->company_id)->get();
        }
        $employeeTypes = EmployeeType::all();
        $leaveTypes = LeaveType::all();
        return view('employee.add', compact('countries', 'companies', 'departments', 'teams', 'employeeTypes', 'leaveTypes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        // validate duplicate email address
        $exists = Employee::where('email', '=', $request->email)->first();
        if ($exists) {
            return Redirect::route('addEmployee')->withInput()->with('danger', 'Employee with email "' . $exists->email . '" already exists!');
        }
        // validate duplicate ID no
        $exists = Employee::where('idNo', '=', $request->idNo)->first();
        if ($exists) {
            return Redirect::route('addEmployee')->withInput()->with('danger', 'Employee with ID no "' . $exists->idNo . '" already exists!');
        }
        // validate gender
        if ($request->gender != 'Male' && $request->gender != 'Female')
            return Redirect::route('addEmployee')->withInput()->with('warning', 'Please select Gender');

        // validate ID Type
        if ($request->idType == 'Select Type')
            return Redirect::route('addEmployee')->withInput()->with('warning', 'Please select ID Type');

        // validate days employee works per week
        if ($request->days == null)
            return Redirect::route('addEmployee')->withInput()->with('warning', 'Number of working days per week not added!');

        //validate if date of birth and first six characters of ID no are equal
        if ($request->idType == 'RSA ID') {
            $idNumber = strlen($request->idNo);
            if ($idNumber != 13)
                return Redirect::route('addEmployee')->withInput()->with('warning', 'SA ID number is 13 digits long!');
        }
        $idN = $request->idNo;
        $dob = $request->dob;
        if ($request->idType == 'RSA ID') {
            if (substr($idN, 0, 2) != substr($dob, 2, 2) or substr($idN, 2, 2) != substr($dob, 5, 2) or substr($idN, 4, 2) != substr($dob, 8, 2))
                return Redirect::route('addEmployee')->withInput()->with('warning', 'First 6 characters of ID no & date of birth are not equal!');
        }

        if ($request->annual == null && $request->sick == null && $request->public == null && $request->study == null &&
            $request->family == null && $request->maternity == null && $request->commissioning == null &&
            $request->unpaid == null && $request->adoption == null && $request->paternity == null)
            return Redirect::route('addEmployee')->withInput()->with('warning', 'At least one leave type must be selected!');

        $input = $request->all();
        $employee = new Employee($input);
        $company = Company::find($request->company_id);
        $employee->country_id = $company->country_id;
        $days = $request->days;

        if ($employee->save())
        {
            $employeeId = Employee::where('name', '=', $request->name)
                ->where('surname', '=', $request->surname)->first();

            if ($request->annual == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'nnua' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type annual is not added in LeaveType table');
            }
            if ($request->sick == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'ick' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type sick is not added in LeaveType table');
            }
            if ($request->public == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'ublic' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type public holiday is not added in LeaveType table');
            }
            if ($request->study == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'tudy' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type study is not added in LeaveType table');
            }
            if ($request->family == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'amil' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type family responsibility is not added in LeaveType table');
            }
            if ($request->maternity == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'mate' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type maternity is not added in LeaveType table');
            }
            if ($request->commissioning == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'sionin' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type commissioning is not added in LeaveType table');
            }
            if ($request->unpaid == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'paid' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type unpaid is not added in LeaveType table');
            }
            if ($request->adoption == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'dopt' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type adoption is not added in LeaveType table');
            }
            if ($request->paternity == 'on') {
                $leaveType = LeaveType::where('type', 'like', '%' . 'pate' . '%')->first();
                if ($leaveType)
                    $this->leaveCalculation($employeeId->id, $leaveType->id, $days);
                else
                    return Redirect::route('addEmployee')->withInput()->with('warning', 'Leave type paternity is not added in LeaveType table');
            }
            return Redirect::route('employees', ['id' => $employee->id])->with('success', 'Successfully added employee');
        } else
            return Redirect::route('addEmployee')->withInput()->withErrors($employee->errors());
    }
    public function leaveCalculation($id, $typeId, $days)
    {
        $leaveCalculation = new LeaveCalculation();
        if ($days == 'five')
            $leaveCalculation->work_daysPerWeek = 5;
        else
            $leaveCalculation->work_daysPerWeek = 6;

        $leaveCalculation->leaveDays_accumulated = 0;
        $leaveCalculation->leaveDays_taken = 0;
        $leaveCalculation->leaveType_id = $typeId;
        $leaveCalculation->employee_id = $id;
        $leaveCalculation->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee, $id)
    {
        $employee = Employee::find($id);

        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id) {
            $countries = Country::all();
            $companies = Company::all();
            $departments = Department::all();
            $teams = Team::all();
        } else {
            $companies = Company::where('id', '=', $user->company_id)->get();
            foreach ($companies as $company)
            {
                if ($company->id == $user->company_id)
                    $countries = Country::where('id', '=', $company->country_id)->get();
            }
            $departments = Department::where('company_id', '=', $user->company_id)->get();
            $teams = Team::where('company_id', '=', $user->company_id)->get();
        }
        $employeeTypes = EmployeeType::all();
        $leaveCalculations = LeaveCalculation::where('employee_id', '=', $employee->id)->get();

        $annual = null; $sick = null; $public = null; $study = null; $family = null; $maternity = null;
        $commissioning = null; $unpaid = null; $adoption = null; $paternity = null;
        $work_daysPerWeek = null;

        foreach ($leaveCalculations as $calculation)
        {
            $work_daysPerWeek = $calculation->work_daysPerWeek;
            $type = LeaveType::where('type', 'like', '%' . 'nnua' . '%')->first();
            if ($type->id == $calculation->leaveType_id)
                $annual = 'on';
            else {
                $type = LeaveType::where('type', 'like', '%' . 'ick' . '%')->first();
                if ($type->id == $calculation->leaveType_id)
                    $sick = 'on';
                else {
                    $type = LeaveType::where('type', 'like', '%' . 'ublic' . '%')->first();
                    if ($type->id == $calculation->leaveType_id)
                        $public = 'on';
                    else {
                        $type = LeaveType::where('type', 'like', '%' . 'tudy' . '%')->first();
                        if ($type->id == $calculation->leaveType_id)
                            $study = 'on';
                        else {
                            $type = LeaveType::where('type', 'like', '%' . 'amil' . '%')->first();
                            if ($type->id == $calculation->leaveType_id)
                                $family = 'on';
                            else {
                                $type = LeaveType::where('type', 'like', '%' . 'mate' . '%')->first();
                                if ($type->id == $calculation->leaveType_id)
                                    $maternity = 'on';
                                else {
                                    $type = LeaveType::where('type', 'like', '%' . 'sionin' . '%')->first();
                                    if ($type->id == $calculation->leaveType_id)
                                        $commissioning = 'on';
                                    else {
                                        $type = LeaveType::where('type', 'like', '%' . 'paid' . '%')->first();
                                        if ($type->id == $calculation->leaveType_id)
                                            $unpaid = 'on';
                                        else {
                                            $type = LeaveType::where('type', 'like', '%' . 'dopt' . '%')->first();
                                            if ($type->id == $calculation->leaveType_id)
                                                $adoption = 'on';
                                            else {
                                                $type = LeaveType::where('type', 'like', '%' . 'pate' . '%')->first();
                                                if ($type->id == $calculation->leaveType_id)
                                                    $paternity = 'on';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return view('employee.edit', compact('employee', 'countries', 'companies', 'departments', 'teams', 'employeeTypes',
            'work_daysPerWeek', 'annual', 'sick', 'public', 'study', 'family', 'maternity', 'commissioning', 'unpaid',
            'adoption', 'paternity'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee, $id)
    {
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        $employee = Employee::find($id);

        //validate duplicate ID no
        $employee_check = Employee::where('idNo', '=', $request->idNo)->get()->first();
        if ($employee_check && $employee_check->id != $id)
            return Redirect::route('editEmployee', [$id])->withInput()->with('danger', 'Employee"s ID no already exists');

        // validate duplicate email address
        $employee_check = Employee::where('email', '=', $request->email)->get()->first();
        if ($employee_check && $employee_check->id != $id)
            return Redirect::route('editEmployee', [$id])->withInput()->with('danger', 'Employee"s email address already exists');

        //validate if date of birth and first six characters of ID no are equal
        if ($request->idType == 'RSA ID') {
            $idNumber = strlen($request->idNo);
            if ($idNumber != 13)
                return Redirect::route('editEmployee', [$id])->withInput()->with('warning', 'SA ID number is 13 digits long');
        }
        $idN = $request->idNo;
        $dob = $request->dob;
        if ($request->idType == 'RSA ID') {
            if (substr($idN, 0, 2) != substr($dob, 2, 2) or substr($idN, 2, 2) != substr($dob, 5, 2) or substr($idN, 4, 2) != substr($dob, 8, 2))
                return Redirect::route('editEmployee', [$id])->withInput()->with('warning', 'First 6 characters of ID no & date of birth are not equal');
        }

        $employee->employee_no = $request->employee_no;
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->dob = $request->dob;
        $employee->idType = $request->idType;
        $employee->idNo = $request->idNo;
        $employee->gender = $request->gender;
        $employee->occupation = $request->occupation;
        $employee->start_date = $request->start_date;
        $employee->contact_no = $request->contact_no;
        $employee->email = $request->email;
        $employee->employeeType_id = $request->employeeType_id;
        $employee->dept_id = $request->dept_id;
        $employee->team_id = $request->team_id;
        $employee->company_id = $request->company_id;
        $company = Company::find($request->company_id);
        $employee->country_id = $company->country_id;
        $days = $request->days;

        if ($employee->update()) {
            $leaveType = LeaveType::where('type', 'like', '%' . 'nnua' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->annual != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->annual == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->annual == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type annual is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'ick' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->sick != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->sick == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->sick == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type sick is not added on LeaveType table');
            }

            $leaveType = LeaveType::where('type', 'like', '%' . 'blic' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->public != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->public == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->public == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type public is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'udy' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->study != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->study == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->study == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type study is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'mily' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->family != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->family == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->family == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type family responsibility is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'mate' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->maternity != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->maternity == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->maternity == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type maternity is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'sionin' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->commissioning != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->commissioning == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->commissioning == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type commissioning is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'paid' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->unpaid != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->unpaid == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->unpaid == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type unpaid is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'opti' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->adoption != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->adoption == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->adoption == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type adoption is not added on LeaveType table');
            }
            $leaveType = LeaveType::where('type', 'like', '%' . 'pate' . '%')->first();
            if ($leaveType) {
                $leaveCalculation = LeaveCalculation::where('leaveType_id', '=', $leaveType->id)
                    ->where('employee_id', '=', $employee->id)->first();
                if ($leaveCalculation) {
                    if ($request->paternity != 'on')
                        $leaveCalculation->delete();
                } else {
                    if ($request->paternity == 'on')
                        $this->updateLeaveCalculation($employee->id, $leaveType->id, $days);
                }
            } else {
                if ($request->paternity == 'on')
                    return Redirect::route('editEmployee', [$id])->withInput()->with('warning',
                        'Leave type paternity is not added on LeaveType table');
            }
            return Redirect::route('employees')->with('success', 'Successfully updated employee!');
        } else
            return Redirect::route('editEmployee', [$id])->withInput()->withErrors($employee->errors());
    }
    public function updateLeaveCalculation($id, $typeId, $days)
    {
        $leaveCalc = LeaveCalculation::where('leaveType_id', '=', $typeId)
            ->where('employee_id', '=', $id)->first();

        if ($leaveCalc) {
            $leaveCalc->work_daysPerWeek = $days;
            $leaveCalc->update();
        } else {
            $leaveCalculation = new LeaveCalculation();
            $leaveCalculation->work_daysPerWeek = $days;
            $leaveCalculation->leaveDays_accumulated = 0;
            $leaveCalculation->leaveDays_taken = 0;
            $leaveCalculation->leaveType_id = $typeId;
            $leaveCalculation->employee_id = $id;
            $leaveCalculation->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, $id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee)
        {
            $employeeHistory = new EmployeeHistory();
            $employeeHistory->employee_no = $employee->employee_no;
            $employeeHistory->surname = $employee->surname;
            $employeeHistory->name = $employee->name;
            $employeeHistory->dob = $employee->dob;
            $employeeHistory->idType = $employee->idType;
            $employeeHistory->idNo = $employee->idNo;
            $employeeHistory->gender = $employee->gender;
            $employeeHistory->contact_no = $employee->contact_no;
            $employeeHistory->start_date = $employee->start_date;
            $employeeHistory->occupation = $employee->occupation;
            $employeeHistory->email = $employee->email;
            $date = Carbon::now();
            $employeeHistory->termination_date = $date->format('Y-m-d');
            $employeeHistory->action_user = Auth::user()->name . ' ' . Auth::user()->surname;
            $employeeHistory->employeeType_id = $employee->employeeType_id;
            $employeeHistory->dept_id = $employee->dept_id;
            $employeeHistory->team_id = $employee->team_id;
            $employeeHistory->company_id = $employee->company_id;
            $employeeHistory->country_id = $employee->country_id;

            if ($employeeHistory->save()) {
                $employee->employee_status = 'I';
                $employee->update();
                return Redirect::route('employees')->with('success', 'Employee successfully terminated');
            }
        }
    }
    public function getNameData(Request $request)
    {
        $employee_name = $request->input('nameAuto');
        $employeesInfo = array();

        $user = User::where('name', '=', Auth::user()->name)
            ->where('surname', '=', Auth::user()->surname)->first();

        $role = Role::where('description', 'like', '%' . 'uper' . '%')->first();

        if ($role->id == $user->role_id)
            $employees = DB::table('employees')->where('name', 'LIKE', "%{$employee_name}%")->orderBy('name')->get();
        else
            $employees = DB::table('employees')->where('company_id', '=', $user->company_id)
                ->where('name', 'LIKE', "%{$employee_name}%")->orderBy('name')->get();

        foreach ($employees as $employee) {
            $employeeInfo = new EmployeeInfo();
            $employeeInfo->id = $employee->id;
            $employeeInfo->label = $employee->name;
            $employeeInfo->name = $employee->surname;
            array_push($employeesInfo, $employeeInfo);
        }
        return json_encode($employeesInfo);
    }
}
class Employees
{
    public $id;
    public $name;
    public $surname;
    public $employeeNo;
    public $dateOfBirth;
    public $idNo;
    public $gender;
    public $contactNo;
    public $emailAddress;
    public $startDate;
    public $occupation;
    public $employeeType;
}
class EmployeeInfo
{
    public $id;
    public $label;
    public $name;
}
