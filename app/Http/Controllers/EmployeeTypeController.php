<?php

namespace App\Http\Controllers;

use App\Models\EmployeeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EmployeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeTypes = DB::table('employeeTypes')->get();
        return view('employeeType.index', ['employeeTypes' => $employeeTypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('employeeType.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employeeTypes = EmployeeType::where('employee_type', '=', $request->employee_type)->count();
        if ($employeeTypes > 0)
            return redirect('employeeType/add')->withInput()->with('danger', 'Employee Type already exists');

        $input = $request->all();
        $employeeTypes = new EmployeeType($input);

        if ($employeeTypes->save())
            return Redirect::route('employeeTypes')->with('success', 'Successfully added employee type!');
        else
            return Redirect::route('addEmployeeType')->withInput()->withErrors($employeeTypes->errors());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeType $employeeType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeType $employeeType, $id)
    {
        $employeeType = EmployeeType::find($id);
        return view('employeeType.edit', ['employeeType' => $employeeType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeType $employeeType, $id)
    {
        $employeeType = EmployeeType::find($id);
        $employeeType_check = EmployeeType::where('employee_type', '=', $request->employee_type)->get()->first();

        if ($employeeType_check && $employeeType_check->id != $id)
            return Redirect::route('editEmployeeType', [$id])->withInput()->with('danger', 'Employee Type already exists');

        $employeeType->employee_type = $request->employee_type;

        if ($employeeType->update())
            return Redirect::route('employeeTypes')->with('success', 'Successfully updated employee type!');
        else
            return Redirect::route('editEmployeeType', [$id])->withInput()->withErrors($employeeType->errors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeType  $employeeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeType $employeeType, $id)
    {
        $employeeType = EmployeeType::findOrFail($id);
        $employee = Employee::where('employeeType_id', '=', $employeeType->id)->first();

        if ($employee)
            return Redirect::route('employeeTypes')->with('danger', 'Employee type has employees linked to it');
        else {
            $employeeType->delete();
            return Redirect::route('employeeTypes')->with('success', 'Employee type successfully deleted!');
        }
    }
}
