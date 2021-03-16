<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
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
