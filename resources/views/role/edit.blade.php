<!-- app/views/role/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Country Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Role {!! $role->description !!}</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['update', $role->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::text('description', $role->description, array('class' => 'form-control', 'required')) !!}
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><p>User role functions: <input type="checkbox" id="selectAll"></p></strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($createRole == 'on')
                                        <input type="checkbox" name="createRole" checked="">
                                    @else
                                        <input type="checkbox" name="createRole" {{ old('createRole') ? 'checked' : '' }} >
                                    @endif
                                    Create User Role
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateRole == 'on')
                                        <input type="checkbox" name="updateRole" checked="">
                                    @else
                                        <input type="checkbox" name="updateRole" {{ old('updateRole') ? 'checked' : '' }} >
                                    @endif
                                    Update User Role
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteRole == 'on')
                                        <input type="checkbox" name="deleteRole" checked="">
                                    @else
                                        <input type="checkbox" name="deleteRole" {{ old('deleteRole') ? 'checked' : '' }} >
                                    @endif
                                    Delete User Role
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addUser == 'on')
                                        <input type="checkbox" name="addUser" checked="">
                                    @else
                                        <input type="checkbox" name="addUser" {{ old('addUser') ? 'checked' : '' }} >
                                    @endif
                                    Add User
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateUser == 'on')
                                        <input type="checkbox" name="updateUser" checked="">
                                    @else
                                        <input type="checkbox" name="updateUser" {{ old('updateUser') ? 'checked' : '' }} >
                                    @endif
                                    Update User
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteUser == 'on')
                                        <input type="checkbox" name="deleteUser" checked="">
                                    @else
                                        <input type="checkbox" name="deleteUser" {{ old('deleteUser') ? 'checked' : '' }} >
                                    @endif
                                    Delete User
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addCountry == 'on')
                                        <input type="checkbox" name="addCountry" checked="">
                                    @else
                                        <input type="checkbox" name="addCountry" {{ old('addCountry') ? 'checked' : '' }} >
                                    @endif
                                    Add Country
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addCompany == 'on')
                                        <input type="checkbox" name="addCompany" checked="">
                                    @else
                                        <input type="checkbox" name="addCompany" {{ old('addCompany') ? 'checked' : '' }} >
                                    @endif
                                    Add Company
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addDept == 'on')
                                        <input type="checkbox" name="addDept" checked="">
                                    @else
                                        <input type="checkbox" name="addDept" {{ old('addDept') ? 'checked' : '' }} >
                                    @endif
                                    Add Department
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addTeam == 'on')
                                        <input type="checkbox" name="addTeam" checked="">
                                    @else
                                        <input type="checkbox" name="addTeam" {{ old('addTeam') ? 'checked' : '' }} >
                                    @endif
                                    Add Team
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addEmployeeType == 'on')
                                        <input type="checkbox" name="addEmployeeType" checked="">
                                    @else
                                        <input type="checkbox" name="addEmployeeType" {{ old('addEmployeeType') ? 'checked' : '' }} >
                                    @endif
                                    Add Employee Type
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addLeaveType == 'on')
                                        <input type="checkbox" name="addLeaveType" checked="">
                                    @else
                                        <input type="checkbox" name="addLeaveType" {{ old('addLeaveType') ? 'checked' : '' }} >
                                    @endif
                                    Add Leave Type
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateCountry == 'on')
                                        <input type="checkbox" name="updateCountry" checked="">
                                    @else
                                        <input type="checkbox" name="updateCountry" {{ old('updateCountry') ? 'checked' : '' }} >
                                    @endif
                                    Update Country
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateCompany == 'on')
                                        <input type="checkbox" name="updateCompany" checked="">
                                    @else
                                        <input type="checkbox" name="updateCompany" {{ old('updateCompany') ? 'checked' : '' }} >
                                    @endif
                                    Update Company
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateDept == 'on')
                                        <input type="checkbox" name="updateDept" checked="">
                                    @else
                                        <input type="checkbox" name="updateDept" {{ old('updateDept') ? 'checked' : '' }} >
                                    @endif
                                    Update Department
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateTeam == 'on')
                                        <input type="checkbox" name="updateTeam" checked="">
                                    @else
                                        <input type="checkbox" name="updateTeam" {{ old('updateTeam') ? 'checked' : '' }} >
                                    @endif
                                    Update Team
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateEmployeeType == 'on')
                                        <input type="checkbox" name="updateEmployeeType" checked="">
                                    @else
                                        <input type="checkbox" name="updateEmployeeType" {{ old('updateEmployeeType') ? 'checked' : '' }} >
                                    @endif
                                    Update Employee Type
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateLeaveType == 'on')
                                        <input type="checkbox" name="updateLeaveType" checked="">
                                    @else
                                        <input type="checkbox" name="updateLeaveType" {{ old('updateLeaveType') ? 'checked' : '' }} >
                                    @endif
                                    Update Leave Type
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteCountry == 'on')
                                        <input type="checkbox" name="deleteCountry" checked="">
                                    @else
                                        <input type="checkbox" name="deleteCountry" {{ old('deleteCountry') ? 'checked' : '' }} >
                                    @endif
                                    Delete Country
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteCompany == 'on')
                                        <input type="checkbox" name="deleteCompany" checked="">
                                    @else
                                        <input type="checkbox" name="deleteCompany" {{ old('deleteCompany') ? 'checked' : '' }} >
                                    @endif
                                    Delete Company
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteDept == 'on')
                                        <input type="checkbox" name="deleteDept" checked="">
                                    @else
                                        <input type="checkbox" name="deleteDept" {{ old('deleteDept') ? 'checked' : '' }} >
                                    @endif
                                    Delete Department
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteTeam == 'on')
                                        <input type="checkbox" name="deleteTeam" checked="">
                                    @else
                                        <input type="checkbox" name="deleteTeam" {{ old('deleteTeam') ? 'checked' : '' }} >
                                    @endif
                                    Delete Team
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteEmployeeType == 'on')
                                        <input type="checkbox" name="deleteEmployeeType" checked="">
                                    @else
                                        <input type="checkbox" name="deleteEmployeeType" {{ old('deleteEmployeeType') ? 'checked' : '' }} >
                                    @endif
                                    Delete Employee Type
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteLeaveType == 'on')
                                        <input type="checkbox" name="deleteLeaveType" checked="">
                                    @else
                                        <input type="checkbox" name="deleteLeaveType" {{ old('deleteLeaveType') ? 'checked' : '' }} >
                                    @endif
                                    Delete Leave Type
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($addEmployee == 'on')
                                        <input type="checkbox" name="addEmployee" checked="">
                                    @else
                                        <input type="checkbox" name="addEmployee" {{ old('addEmployee') ? 'checked' : '' }} >
                                    @endif
                                    Add Employee
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($updateEmployee == 'on')
                                        <input type="checkbox" name="updateEmployee" checked="">
                                    @else
                                        <input type="checkbox" name="updateEmployee" {{ old('updateEmployee') ? 'checked' : '' }} >
                                    @endif
                                    Update Employee
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($deleteEmployee == 'on')
                                        <input type="checkbox" name="deleteEmployee" checked="">
                                    @else
                                        <input type="checkbox" name="deleteEmployee" {{ old('deleteEmployee') ? 'checked' : '' }} >
                                    @endif
                                    Terminate Employee
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($attReg == 'on')
                                        <input type="checkbox" name="attReg" checked="">
                                    @else
                                        <input type="checkbox" name="attReg" {{ old('attReg') ? 'checked' : '' }} >
                                    @endif
                                    Attendance Register
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($leaveCreate == 'on')
                                        <input type="checkbox" name="leaveCreate" checked="">
                                    @else
                                        <input type="checkbox" name="leaveCreate" {{ old('leaveCreate') ? 'checked' : '' }} >
                                    @endif
                                    Leave Application
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($leaveUpdate == 'on')
                                        <input type="checkbox" name="leaveUpdate" checked="">
                                    @else
                                        <input type="checkbox" name="leaveUpdate" {{ old('leaveUpdate') ? 'checked' : '' }} >
                                    @endif
                                    Leave Approval
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($settings == 'on')
                                        <input type="checkbox" name="settings" checked="">
                                    @else
                                        <input type="checkbox" name="settings" {{ old('settings') ? 'checked' : '' }} >
                                    @endif
                                    Settings
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($reports == 'on')
                                        <input type="checkbox" name="reports" checked="">
                                    @else
                                        <input type="checkbox" name="reports" {{ old('reports') ? 'checked' : '' }} >
                                    @endif
                                    View Reports
                                </label>
                            </div>
                        </div>
                    </div>
                    <a href="{!!URL::route('roles')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#selectAll').click(function() {
            $(this.form.elements).filter(':checkbox').prop('checked', this.checked)
        });
    </script>
@endsection