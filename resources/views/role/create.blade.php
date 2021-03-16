<!-- app/views/role/create.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create User Role Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add User Role</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model(new App\Models\Role, ['route' => ['store']]) !!}

                    <div class="form-group">
                        {!! Form::label('description', 'Description') !!}
                        {!! Form::text('description', Request::old('description'), array('class' => 'form-control', 'required')) !!}
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
                                <input type="checkbox" id="createRole" name="createRole">
                                <label for="createRole"> Create User Role</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateRole" name="updateRole">
                                <label for="updateRole"> Update User Role</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteRole" name="deleteRole">
                                <label for="deleteRole"> Delete User Role</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addUser" name="addUser">
                                <label for="addUser"> Add User</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateUser" name="updateUser">
                                <label for="updateUser"> Update User</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteUser" name="deleteUser">
                                <label for="deleteUser"> Delete User</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addCountry" name="addCountry">
                                <label for="addCountry"> Add Country</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addCompany" name="addCompany">
                                <label for="addCompany"> Add Company</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addDept" name="addDept">
                                <label for="addDept"> Add Department</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addTeam" name="addTeam">
                                <label for="addTeam"> Add Team</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addEmployeeType" name="addEmployeeType">
                                <label for="addEmployeeType"> Add Employee Type</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addLeaveType" name="addLeaveType">
                                <label for="addLeaveType"> Add Leave Type</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateCountry" name="updateCountry">
                                <label for="updateCountry"> Update Country</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateCompany" name="updateCompany">
                                <label for="updateCompany"> Update Company</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateDept" name="updateDept">
                                <label for="updateDept"> Update Department</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateTeam" name="updateTeam">
                                <label for="updateTeam"> Update Team</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateEmployeeType" name="updateEmployeeType">
                                <label for="updateEmployeeType"> Update Employee Type</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateLeaveType" name="updateLeaveType">
                                <label for="updateLeaveType"> Update Leave Type</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteCountry" name="deleteCountry">
                                <label for="deleteCountry"> Delete Country</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteCompany" name="deleteCompany">
                                <label for="deleteCompany"> Delete Company</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteDept" name="deleteDept">
                                <label for="deleteDept"> Delete Department</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteTeam" name="deleteTeam">
                                <label for="deleteTeam"> Delete Team</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteEmployeeType" name="deleteEmployeeType">
                                <label for="deleteEmployeeType"> Delete Employee Type</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteLeaveType" name="deleteLeaveType">
                                <label for="deleteLeaveType"> Delete Leave Type</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="addEmployee" name="addEmployee">
                                <label for="addEmployee"> Add Employee</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="updateEmployee" name="updateEmployee">
                                <label for="updateEmployee"> Update Employee</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="deleteEmployee" name="deleteEmployee">
                                <label for="deleteEmployee"> Terminate Employee</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="attReg" name="attReg">
                                <label for="attReg"> Attendance Register</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="leaveCreate" name="leaveCreate">
                                <label for="leaveCreate"> Leave Application</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="leaveUpdate" name="leaveUpdate">
                                <label for="leaveUpdate"> Leave Approval</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="settings" name="settings">
                                <label for="settings"> Settings</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="reports" name="reports">
                                <label for="reports"> View Reports</label><br>
                            </div>
                        </div>
                    </div>
                    <a href="{!!URL::route('roles')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
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