<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validationRules=[
        'role_id' => 'required|numeric|digits_between:1,9999',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $roles = Role::all();
        return view('user.add', compact('roles'));
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

        $input = $request->all();
        $user = new User($input);
        $user->password = Hash::make($request->password);

        $exists = User::where('email', '=', $user->email)->first();
        if ($exists)
            return Redirect::route('addUser')->withInput()->with('danger', 'User with email "' . $user->email . '" already exists');

        $userFunctions = UserFunction::where('role_id', '=', $request->role_id)->get();
        foreach ($userFunctions as $function)
        {
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
            if ($function->description == 'Add Employee')
                $user->addEmployee = 'Y';
            if ($function->description == 'Update Employee')
                $user->updateEmployee = 'Y';
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
        if ($user->save())
            return Redirect::route('users')->with('success', 'Successfully added user');
        else
            return Redirect::route('addUser')->withInput()->withErrors($user->errors());
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
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
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
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        $user = User::find($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;

        if ($request->password != $user->password)
            $user->password = Hash::make($request->password);

        $user->createRole = 'N'; $user->updateRole = 'N'; $user->deleteRole = 'N';
        $user->addUser = 'N'; $user->updateUser = 'N'; $user->deleteUser = 'N';
        $user->addCountry = 'N'; $user->updateCountry = 'N'; $user->deleteCountry = 'N';
        $user->addCompany = 'N'; $user->updateCompany = 'N'; $user->deleteCompany = 'N';
        $user->addDept = 'N'; $user->updateDept = 'N'; $user->deleteDept = 'N';
        $user->addTeam = 'N'; $user->updateTeam = 'N'; $user->deleteTeam = 'N';
        $user->addEmployeeType = 'N'; $user->updateEmployeeType = 'N'; $user->deleteEmployeeType = 'N';
        $user->addLeaveType = 'N'; $user->updateLeaveType = 'N'; $user->deleteLeaveType = 'N';
        $user->addEmployee = 'N'; $user->updateEmployee = 'N'; $user->deleteEmployee = 'N';
        $user->attReg = 'N'; $user->leaveCapture = 'N'; $user->leaveApprove = 'N';
        $user->settings = 'N'; $user->reportView = 'N';
        $user->role_id = $request->role_id;

        $exists = User::where('email', '=', $user->email)->first();
        if ($exists && $exists->id != $id)
            return Redirect::route('editUser', [$id])->withInput()->with('danger', 'User with email "' . $user->email .
            '" already exists');

        $userFunctions = UserFunction::where('role_id', '=', $request->role_id)->get();
        foreach ($userFunctions as $function) {
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
            if ($function->description == 'Add Employee')
                $user->addEmployee = 'Y';
            if ($function->description == 'Update Employee')
                $user->updateEmployee = 'Y';
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
        if ($user->update())
            return Redirect::route('users')->with('success', 'Successfully updated user');
        else
            return Redirect::route('editUser', [$id])->withInput()->withErrors($user->errors());
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
    public function showLogin()
    {
        // show the form
        return view('user.login');
    }
    public function doLogin(Request $request)
    {
        // validate the credentials, create rules for the input
        $users = User::where('email', '=', $request->email)->get();

        // check if email address exists
        if ($users -> isEmpty())
            return Redirect::to('login')->withInput()->with('danger', 'Sorry email address does not exist');

        foreach ($users as $user)
        {
            $rules = array(
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:3');

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return Redirect::to('login')
                    ->withInput($validator)
                    ->withInput()
                    ->with('danger', 'Your login failed, Please try again.');
            else
                $userData = array(
                    'email' => $request->email,
                    'password' => $request->password);

            if (Auth::attempt($userData, true))
               return redirect('dashboard');
            else
                return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('danger', 'Your login failed, Please try again');
        }
    }
    public function doLogout()
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
