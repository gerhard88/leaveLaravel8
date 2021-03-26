<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Define your validation rules in a property in
     * the controller to reuse the rules.
     */
    protected $validationRules=[
        'company_id' => 'required|numeric|digits_between:1,9999',
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
            $departments = DB::table('departments')->get();
        else
            $departments = Department::where('company_id', '=', $user->company_id)->get();

        return view('department.index', ['departments' => $departments]);
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

        if ($role->id == $user->role_id)
            $companies = Company::all();
        else
            $companies = Company::where('id', '=', $user->company_id)->get();

        return view('department.add', compact('companies', $companies));
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

        $department = Department::where('name', '=', $request->name)->count();
        if ($department > 0)
            return redirect('department/add')->withInput()->with('danger', 'Department already exists');

        $company = Company::where('id', '=', $request->company_id)->first();
        $input = $request->all();
        $department = new Department($input);
        $department->company_id = $company->id;

        if ($department->save())
            return Redirect::route('departments', ['company_id' => $company->id])->with('success', 'Successfully added department!');
        else
            return Redirect::route('addDepartment')->withInput()->withErrors($department->errors());
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department, $id)
    {
        $department = Department::find($id);
        $companies = Company::all();
        $did = Department::find($id)->company_id;
        return view('department.edit', compact('department', 'companies', 'did'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department, $id)
    {
        $v = Validator::make($request->all(), $this->validationRules);
        if ($v->fails())
            return redirect()->back()->withErrors($v->errors())->withInput();

        $department = Department::find($id);
        $department_check = Department::where('name', '=', $request->name)->get()->first();

        if ($department_check && $department_check->id != $id)
            return Redirect::route('editDepartment', [$id])->withInput()->with('danger', 'Department already exists');

        $department->name = $request->name;
        $department->company_id = $request->company_id;

        if ($department->update())
            return Redirect::route('departments')->with('success', 'Successfully updated department!');
        else
            return Redirect::route('editDepartment', [$id])->withInput()->withErrors($department->errors());
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department, $id)
    {
        $department = Department::findOrFail($id);
        $employees = Employee::where('dept_id', '=', $department->id)->first();

        if ($employees)
            return Redirect::route('departments')->with('danger', 'Department has employees linked to it');
        else {
            $department->delete();
            return Redirect::route('departments')->with('success', 'Department successfully deleted!');
        }
    }
}
