<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = Role::where('description', '=', $request->description)->count();
        if ($roles > 0)
            return redirect('role/create')->withInput()->with('danger', 'Role already exists');

        $input = $request->all();
        $role = new Role($input);

        if($request->createRole == null && $request->updateRole == null && $request->deleteRole == null &&
            $request->addUser == null && $request->updateUser == null && $request->deleteUser == null &&
            $request->addCountry == null && $request->addCompany == null && $request->addDept == null &&
            $request->addTeam == null && $request->addEmployeeType == null && $request->addLeaveType == null &&
            $request->updateCountry == null && $request->updateCompany == null && $request->updateDept == null &&
            $request->updateTeam == null && $request->updateEmployeeType == null && $request->updateLeaveType == null &&
            $request->deleteCountry == null && $request->deleteCompany == null && $request->deleteDept == null &&
            $request->deleteTeam == null && $request->deleteEmployeeType == null && $request->deleteLeaveType == null &&
            $request->addEmployee == null && $request->updateEmployee == null && $request->deleteEmployee == null &&
            $request->attReg == null && $request->leaveCreate == null && $request->leaveUpdate == null &&
            $request->settings == null && $request->reports == null)
            return Redirect::route('create')->withInput()->with('warning', 'At least one user function must be selected');

        if ($role->save()) {
            $role = Role::where('description', '=', $request->description)->first();

            if ($request->createRole == 'on')
                $this->addFunction($role->id, 'Create User Role');

            if ($request->updateRole == 'on')
                $this->addFunction($role->id, 'Update User Role');

            if ($request->deleteRole == 'on')
                $this->addFunction($role->id, 'Delete User Role');

            if ($request->addUser == 'on')
                $this->addFunction($role->id, 'Add User');

            if ($request->updateUser == 'on')
                $this->addFunction($role->id, 'Update User');

            if ($request->deleteUser == 'on')
                $this->addFunction($role->id, 'Delete User');

            if ($request->addCountry == 'on')
                $this->addFunction($role->id, 'Add Country');

            if ($request->addCompany == 'on')
                $this->addFunction($role->id, 'Add Company');

            if ($request->addDept == 'on')
                $this->addFunction($role->id, 'Add Department');

            if ($request->addTeam == 'on')
                $this->addFunction($role->id, 'Add Team');

            if ($request->addEmployeeType == 'on')
                $this->addFunction($role->id, 'Add Employee Type');

            if ($request->addLeaveType == 'on')
                $this->addFunction($role->id, 'Add Leave Type');

            if ($request->updateCountry == 'on')
                $this->addFunction($role->id, 'Update Country');

            if ($request->updateCompany == 'on')
                $this->addFunction($role->id, 'Update Company');

            if ($request->updateDept == 'on')
                $this->addFunction($role->id, 'Update Department');

            if ($request->updateTeam == 'on')
                $this->addFunction($role->id, 'Update Team');

            if ($request->updateEmployeeType == 'on')
                $this->addFunction($role->id, 'Update Employee Type');

            if ($request->updateLeaveType == 'on')
                $this->addFunction($role->id, 'Update Leave Type');

            if ($request->deleteCountry == 'on')
                $this->addFunction($role->id, 'Delete Country');

            if ($request->deleteCompany == 'on')
                $this->addFunction($role->id, 'Delete Company');

            if ($request->deleteDept == 'on')
                $this->addFunction($role->id, 'Delete Department');

            if ($request->deleteTeam == 'on')
                $this->addFunction($role->id, 'Delete Team');

            if ($request->deleteEmployeeType == 'on')
                $this->addFunction($role->id, 'Delete Employee Type');

            if ($request->deleteLeaveType == 'on')
                $this->addFunction($role->id, 'Delete Leave Type');

            if ($request->addEmployee == 'on')
                $this->addFunction($role->id, 'Add Employee');

            if ($request->updateEmployee == 'on')
                $this->addFunction($role->id, 'Update Employee');

            if ($request->deleteEmployee == 'on')
                $this->addFunction($role->id, 'Delete Employee');

            if ($request->attReg == 'on')
                $this->addFunction($role->id, 'Attendance Register');

            if ($request->leaveCreate == 'on')
                $this->addFunction($role->id, 'Capture Leave');

            if ($request->leaveUpdate == 'on')
                $this->addFunction($role->id, 'Approve Leave');

            if ($request->settings == 'on')
                $this->addFunction($role->id, 'Settings');

            if ($request->reports == 'on')
                $this->addFunction($role->id, 'View Reports');

            return Redirect::route('roles')->with('success', 'Successfully added user role!');
        } else
            return Redirect::route('role/create')->withInput()->withErrors($roles->errors());
    }
    public function addFunction($role_id, $description)
    {
        $function = UserFunction::where('description', '=', $description)
            ->where('role_id', '=', $role_id)->first();

        if (!$function) {
            $function = new UserFunction();
            $function->description = $description;
            $function->role_id = $role_id;
            $function->save();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role, $id)
    {
        $role = Role::find($id);

        $function = UserFunction::where('description', 'like', '%' . 'eate User R'. '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $createRole = 'on';
        else
            $createRole = null;

        $function = UserFunction::where('description', 'like', '%' . 'date User R' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateRole = 'on';
        else
            $updateRole = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete User R' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteRole = 'on';
        else
            $deleteRole = null;

        $function = UserFunction::where('description', 'like', '%' . 'd User')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addUser = 'on';
        else
            $addUser = null;

        $function = UserFunction::where('description', 'like', '%' . 'date User')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateUser = 'on';
        else
            $updateUser = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete User')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteUser = 'on';
        else
            $deleteUser = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Coun' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addCountry = 'on';
        else
            $addCountry = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Comp' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addCompany = 'on';
        else
            $addCompany = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Depa' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addDept = 'on';
        else
            $addDept = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Team')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addTeam = 'on';
        else
            $addTeam = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Employee T' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addEmployeeType = 'on';
        else
            $addEmployeeType = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Leav' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addLeaveType = 'on';
        else
            $addLeaveType = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Coun' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateCountry = 'on';
        else
            $updateCountry = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Comp' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateCompany = 'on';
        else
            $updateCompany = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Depa' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateDept = 'on';
        else
            $updateDept = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Team')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateTeam = 'on';
        else
            $updateTeam = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Employee T' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateEmployeeType = 'on';
        else
            $updateEmployeeType = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Leav' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateLeaveType = 'on';
        else
            $updateLeaveType = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Coun' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteCountry = 'on';
        else
            $deleteCountry = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Comp' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteCompany = 'on';
        else
            $deleteCompany = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Depa' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteDept = 'on';
        else
            $deleteDept = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Team')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteTeam = 'on';
        else
            $deleteTeam = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Employee T' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteEmployeeType = 'on';
        else
            $deleteEmployeeType = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Leav' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteLeaveType = 'on';
        else
            $deleteLeaveType = null;

        $function = UserFunction::where('description', 'like', '%' . 'd Employee')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $addEmployee = 'on';
        else
            $addEmployee = null;

        $function = UserFunction::where('description', 'like', '%' . 'date Employee')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $updateEmployee = 'on';
        else
            $updateEmployee = null;

        $function = UserFunction::where('description', 'like', '%' . 'lete Employee')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $deleteEmployee = 'on';
        else
            $deleteEmployee = null;

        $function = UserFunction::where('description', 'like', '%' . 'egis' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $attReg = 'on';
        else
            $attReg = null;

        $function = UserFunction::where('description', 'like', '%' . 'ture' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $leaveCreate = 'on';
        else
            $leaveCreate = null;

        $function = UserFunction::where('description', 'like', '%' . 'ppro' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $leaveUpdate = 'on';
        else
            $leaveUpdate = null;

        $function = UserFunction::where('description', 'like', '%' . 'etti' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $settings = 'on';
        else
            $settings = null;

        $function = UserFunction::where('description', 'like', '%' . 'epor' . '%')
            ->where('role_id', '=', $role->id)->first();
        if ($function)
            $reports = 'on';
        else
            $reports = null;

        return view('role.edit', compact('role', 'createRole', 'updateRole', 'deleteRole', 'addUser', 'updateUser',
            'deleteUser', 'addCountry', 'addCompany', 'addDept', 'addTeam', 'addEmployeeType', 'addLeaveType',
            'updateCountry', 'updateCompany', 'updateDept', 'updateTeam', 'updateEmployeeType', 'updateLeaveType',
            'deleteCountry', 'deleteCompany', 'deleteDept', 'deleteTeam', 'deleteEmployeeType', 'deleteLeaveType',
            'addEmployee', 'updateEmployee', 'deleteEmployee', 'attReg', 'leaveCreate', 'leaveUpdate', 'settings', 'reports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, $id)
    {
        $role = Role::find($id);
        $role_check = Role::where('description', '=', $request->description)->get()->first();

        if ($role_check && $role_check->id != $id)
            return Redirect::route('edit', [$id])->withInput()->with('danger', 'User role already exists');

        if($request->createRole == null && $request->updateRole == null && $request->deleteRole == null &&
            $request->addUser == null && $request->updateUser == null && $request->deleteUser == null &&
            $request->addCountry == null && $request->addCompany == null && $request->addDept == null &&
            $request->addTeam == null && $request->addEmployeeType == null && $request->addLeaveType == null &&
            $request->updateCountry == null && $request->updateCompany == null && $request->updateDept == null &&
            $request->updateTeam == null && $request->updateEmployeeType == null && $request->updateLeaveType == null &&
            $request->deleteCountry == null && $request->deleteCompany == null && $request->deleteDept == null &&
            $request->deleteTeam == null && $request->deleteEmployeeType == null && $request->deleteLeaveType == null &&
            $request->addEmployee == null && $request->updateEmployee == null && $request->deleteEmployee == null &&
            $request->attReg == null && $request->leaveCreate == null && $request->leaveUpdate == null &&
            $request->settings == null && $request->reports == null)
            return Redirect::route('edit', [$id])->withInput()->with('warning', 'At least one user function must be selected');

        $role->description = $request->description;

        if ($role->update())
        {
            $function = UserFunction::where('description', 'like', '%' . 'eate User R' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->createRole !== 'on')
                    $function->delete();
            } else {
                if ($request->createRole == 'on')
                    $this->addFunction($role->id, 'Create User Role');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date User R' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateRole !== 'on')
                    $function->delete();
            } else {
                if ($request->updateRole == 'on')
                    $this->addFunction($role->id, 'Update User Role');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete User R' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteRole !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteRole == 'on')
                    $this->addFunction($role->id, 'Delete User Role');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd User')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addUser !== 'on')
                    $function->delete();
            } else {
                if ($request->addUser == 'on')
                    $this->addFunction($role->id, 'Add User');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date User')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateUser !== 'on')
                    $function->delete();
            } else {
                if ($request->updateUser == 'on')
                    $this->addFunction($role->id, 'Update User');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete User')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteUser !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteUser == 'on')
                    $this->addFunction($role->id, 'Delete User');
            }

            $function = UserFunction::where('description', 'like', '%' . 'd Coun' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addCountry !== 'on')
                    $function->delete();
            } else {
                if ($request->addCountry == 'on')
                    $this->addFunction($role->id, 'Add Country');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd Comp' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addCompany !== 'on')
                    $function->delete();
            } else {
                if ($request->addCompany == 'on')
                    $this->addFunction($role->id, 'Add Company');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd Depa' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addDept !== 'on')
                    $function->delete();
            } else {
                if ($request->addDept == 'on')
                    $this->addFunction($role->id, 'Add Department');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd Team')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addTeam !== 'on')
                    $function->delete();
            } else {
                if ($request->addTeam == 'on')
                    $this->addFunction($role->id, 'Add Team');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd Employee T' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addEmployeeType !== 'on')
                    $function->delete();
            } else {
                if ($request->addEmployeeType == 'on')
                    $this->addFunction($role->id, 'Add Employee Type');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd Leave' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addLeaveType !== 'on')
                    $function->delete();
            } else {
                if ($request->addLeaveType == 'on')
                    $this->addFunction($role->id, 'Add Leave Type');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Coun' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateCountry !== 'on')
                    $function->delete();
            } else {
                if ($request->updateCountry == 'on')
                    $this->addFunction($role->id, 'Update Country');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Comp' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateCompany !== 'on')
                    $function->delete();
            } else {
                if ($request->updateCompany == 'on')
                    $this->addFunction($role->id, 'Update Company');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Depa' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateDept !== 'on')
                    $function->delete();
            } else {
                if ($request->updateDept == 'on')
                    $this->addFunction($role->id, 'Update Department');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Team')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateTeam !== 'on')
                    $function->delete();
            } else {
                if ($request->updateTeam == 'on')
                    $this->addFunction($role->id, 'Update Team');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Employee T' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateEmployeeType !== 'on')
                    $function->delete();
            } else {
                if ($request->updateEmployeeType == 'on')
                    $this->addFunction($role->id, 'Update Employee Type');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Leave' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateLeaveType !== 'on')
                    $function->delete();
            } else {
                if ($request->updateLeaveType == 'on')
                    $this->addFunction($role->id, 'Update Leave Type');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Coun' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteCountry !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteCountry == 'on')
                    $this->addFunction($role->id, 'Delete Country');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Comp' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteCompany !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteCompany == 'on')
                    $this->addFunction($role->id, 'Delete Company');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Depa' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteDept !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteDept == 'on')
                    $this->addFunction($role->id, 'Delete Department');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Team')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteTeam !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteTeam == 'on')
                    $this->addFunction($role->id, 'Delete Team');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Employee T' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteEmployeeType !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteEmployeeType == 'on')
                    $this->addFunction($role->id, 'Delete Employee Type');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Leave' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteLeaveType !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteLeaveType == 'on')
                    $this->addFunction($role->id, 'Delete Leave Type');
            }
            $function = UserFunction::where('description', 'like', '%' . 'd Employee')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->addEmployee !== 'on')
                    $function->delete();
            } else {
                if ($request->addEmployee == 'on')
                    $this->addFunction($role->id, 'Add Employee');
            }
            $function = UserFunction::where('description', 'like', '%' . 'date Employee')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->updateEmployee !== 'on')
                    $function->delete();
            } else {
                if ($request->updateEmployee == 'on')
                    $this->addFunction($role->id, 'Update Employee');
            }
            $function = UserFunction::where('description', 'like', '%' . 'lete Employee')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->deleteEmployee !== 'on')
                    $function->delete();
            } else {
                if ($request->deleteEmployee == 'on')
                    $this->addFunction($role->id, 'Delete Employee');
            }
            $function = UserFunction::where('description', 'like', '%' . 'egist' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->attReg !== 'on')
                    $function->delete();
            } else {
                if ($request->attReg == 'on')
                    $this->addFunction($role->id, 'Attendance Register');
            }
            $function = UserFunction::where('description', 'like', '%' . 'ture' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->leaveCreate !== 'on')
                    $function->delete();
            } else {
                if ($request->leaveCreate == 'on')
                    $this->addFunction($role->id, 'Capture Leave');
            }
            $function = UserFunction::where('description', 'like', '%' . 'ppro' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->leaveUpdate !== 'on')
                    $function->delete();
            } else {
                if ($request->leaveUpdate == 'on')
                    $this->addFunction($role->id, 'Approve Leave');
            }
            $function = UserFunction::where('description', 'like', '%' . 'ttin' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->settings !== 'on')
                    $function->delete();
            } else {
                if ($request->settings == 'on')
                    $this->addFunction($role->id, 'Settings');
            }
            $function = UserFunction::where('description', 'like', '%' . 'port' . '%')
                ->where('role_id', '=', $role->id)->first();
            if ($function) {
                if ($request->reports !== 'on')
                    $function->delete();
            } else {
                if ($request->reports == 'on')
                    $this->addFunction($role->id, 'View Reports');
            }
            // update all the users using that role
            $users = User::where('role_id', '=', $role->id)->get();
            foreach ($users as $user)
            {
                $user->createRole = 'N'; $user->updateRole = 'N'; $user->DeleteRole = 'N';
                $user->addUser = 'N'; $user->updateUser = 'N'; $user->DeleteUser = 'N';
                $user->addCountry = 'N'; $user->updateCountry = 'N'; $user->DeleteCountry = 'N';
                $user->addCompany = 'N'; $user->updateCompany = 'N'; $user->DeleteCompany = 'N';
                $user->addDept = 'N'; $user->updateDept = 'N'; $user->DeleteDept = 'N';
                $user->addTeam = 'N'; $user->updateTeam = 'N'; $user->DeleteTeam = 'N';
                $user->addEmployeeType = 'N'; $user->updateEmployeeType = 'N'; $user->DeleteEmployeeType = 'N';
                $user->addLeaveType = 'N'; $user->updateLeaveType = 'N'; $user->DeleteLeaveType = 'N';
                $user->addEmployee = 'N'; $user->updateEmployee = 'N'; $user->DeleteEmployee = 'N';
                $user->attReg = 'N'; $user->leaveCapture = 'N'; $user->leaveApprove = 'N';
                $user->settings = 'N'; $user->reportView = 'N';

                $functions = UserFunction::where('role_id', '=', $role->id)->get();
                foreach ($functions as $function) {
                    if ($function->description == 'Create User Role')
                        $user->createRole = 'Y';
                    if ($function->description == 'Update User Role')
                        $user->updateRole = 'Y';
                    if ($function->description == 'Delete User Role')
                        $user->deleteRole = 'Y';
                    if ($function->description == 'Add User')
                        $user->addUser = 'Y';
                    if ($function->description == 'Update User')
                        $user->updateUser = 'Y';
                    if ($function->description == 'Delete User')
                        $user->deleteUser = 'Y';
                    if ($function->description == 'Add Country')
                        $user->addCountry = 'Y';
                    if ($function->description == 'Add Company')
                        $user->addCompany = 'Y';
                    if ($function->description == 'Add Department')
                        $user->addDept = 'Y';
                    if ($function->description == 'Add Team')
                        $user->addTeam = 'Y';
                    if ($function->description == 'Add Employee Type')
                        $user->addEmployeeType = 'Y';
                    if ($function->description == 'Add Leave Type')
                        $user->addLeaveType = 'Y';
                    if ($function->description == 'Add Employee')
                        $user->addEmployee = 'Y';
                    if ($function->description == 'Update Country')
                        $user->updateCountry = 'Y';
                    if ($function->description == 'Update Company')
                        $user->updateCompany = 'Y';
                    if ($function->description == 'Update Department')
                        $user->updateDept = 'Y';
                    if ($function->description == 'Update Team')
                        $user->updateTeam = 'Y';
                    if ($function->description == 'Update Employee Type')
                        $user->updateEmployeeType = 'Y';
                    if ($function->description == 'Update Leave Type')
                        $user->updateLeaveType = 'Y';
                    if ($function->description == 'Update Employee')
                        $user->updateEmployee = 'Y';
                    if ($function->description == 'Delete Country')
                        $user->deleteCountry = 'Y';
                    if ($function->description == 'Delete Company')
                        $user->deleteCompany = 'Y';
                    if ($function->description == 'Delete Department')
                        $user->deleteDept = 'Y';
                    if ($function->description == 'Delete Team')
                        $user->deleteTeam = 'Y';
                    if ($function->description == 'Delete Employee Type')
                        $user->deleteEmployeeType = 'Y';
                    if ($function->description == 'Delete Leave Type')
                        $user->deleteLeaveType = 'Y';
                    if ($function->description == 'Delete Employee')
                        $user->deleteEmployee = 'Y';
                    if ($function->description == 'Attendance Register')
                        $user->attReg = 'Y';
                    if ($function->description == 'Capture Leave')
                        $user->leaveCapture = 'Y';
                    if ($function->description == 'Approve Leave')
                        $user->leaveApprove = 'Y';
                    if ($function->description == 'Settings')
                        $user->settings = 'Y';
                    if ($function->description == 'View Reports')
                        $user->reportView = 'Y';
                }
                $user->update();
            }
            return Redirect::route('roles')->with('success', 'Successfully updated user role');
        } else
            return Redirect::route('edit', [$id])->withInput()->withErrors($role->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
