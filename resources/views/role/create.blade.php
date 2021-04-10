<!-- app/views/role/create.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create User Role Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-12 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Add User Role</h4>
            </div>


            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model(new App\Models\Role, ['route' => ['store']]) !!}

                <!-- Row 1 Begin -->
                <div class="row">
                    <!--Name Col -->
                    <div class="form-group col-md-4 ">
                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::text('description', Request::old('description'), array('class' => 'form-control',
                            'autofocus',
                            'required')) !!}
                        </div>
                    </div>
                </div>
                <!-- Row 1 End -->

                <!-- Row 2 Begin -->
                <div class="row">
                    <!--Name Col -->
                    <div class="form-group col-md-4 mb-n1">
                        <div class="form-check ">
                            <strong><label class="form-check-label d-inline p-2">
                                    <input type="checkbox" id="selectAll">
                                    Select All</strong>
                            </label>
                        </div>
                    </div>
                    <!-- Col -->
                </div>
                <!-- Row 2 End -->


                <!-- Row 3 Begin -->
                <div class="row">
                    <div class="form-group col-md-4 ">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="createRole">
                                <input type="checkbox" class="form-check-input" id="createRole" name="createRole">
                                Create User Role
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addUser">
                                <input type="checkbox" class="form-check-input" id="addUser" name="addUser">
                                Add User
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addCountry">
                                <input type="checkbox" class="form-check-input" id="addCountry" name="addCountry">
                                Add Country
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addCompany">
                                <input type="checkbox" class="form-check-input" id="addCompany" name="addCompany">
                                Add Company
                            </label>
                        </div>


                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addDept">
                                <input type="checkbox" class="form-check-input" id="addDept" name="addDept">
                                Add Department
                            </label>
                        </div>


                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addTeam">
                                <input type="checkbox" class="form-check-input" id="addTeam" name="addTeam">
                                Add Team
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addEmployeeType">
                                <input type="checkbox" class="form-check-input" id="addEmployeeType"
                                    name="addEmployeeType">
                                Add Employee Type
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addLeaveType">
                                <input type="checkbox" class="form-check-input" id="addLeaveType" name="addLeaveType">
                                Add Leave Type
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addEmployee">
                                <input type="checkbox" class="form-check-input" id="addEmployee" name="addEmployee">
                                Add Employee
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="leaveCreate">
                                <input type="checkbox" class="form-check-input" id="leaveCreate" name="leaveCreate">
                                Leave Application
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="attReg">
                                <input type="checkbox" class="form-check-input" id="attReg" name="attReg">
                                Attendance Register
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="reports">
                                <input type="checkbox" class="form-check-input" id="reports" name="reports">
                                View Reports
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="settings">
                                <input type="checkbox" class="form-check-input" id="settings" name="settings">
                                Settings
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2">
                                <input type="checkbox" class="form-check-input">
                                Update User Role
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateUser">
                                <input type="checkbox" class="form-check-input" id="updateUser" name="updateUser">
                                Update User
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateCountry">
                                <input type="checkbox" class="form-check-input" id="updateCountry" name="updateCountry">
                                Update Country
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateCompany">
                                <input type="checkbox" class="form-check-input" id="updateCompany" name="updateCompany">
                                Update Company
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateDept">
                                <input type="checkbox" class="form-check-input" id="updateDept" name="updateDept">
                                Update Department
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateTeam">
                                <input type="checkbox" class="form-check-input" id="updateTeam" name="updateTeam">
                                Update Team
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateEmployeeType">
                                <input type="checkbox" class="form-check-input" id="updateEmployeeType"
                                    name="updateEmployeeType">
                                Update Employee Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateLeaveType">
                                <input type="checkbox" class="form-check-input" id="updateLeaveType"
                                    name="updateLeaveType">
                                Update Leave Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateRole">
                                <input type="checkbox" class="form-check-input" id="updateRole" name="updateRole">
                                Update Employee
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="leaveUpdate">
                                <input type="checkbox" class="form-check-input" id="leaveUpdate" name="leaveUpdate">
                                Leave Approval
                            </label>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteRole">
                                <input type="checkbox" class="form-check-input" id="deleteRole" name="deleteRole">
                                Delete User Role
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteUser">
                                <input type="checkbox" class="form-check-input" id="deleteUser" name="deleteUser">
                                Delete User
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteCountry">
                                <input type="checkbox" class="form-check-input" id="deleteCountry" name="deleteCountry">
                                Delete Country
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteCompany">
                                <input type="checkbox" class="form-check-input" id="deleteCompany" name="deleteCompany">
                                Delete Company
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteDept">
                                <input type="checkbox" class="form-check-input" id="deleteDept" name="deleteDept">
                                Delete Department
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteTeam">
                                <input type="checkbox" class="form-check-input" id="deleteTeam" name="deleteTeam">
                                Delete Team
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteEmployeeType">
                                <input type="checkbox" class="form-check-input" id="deleteEmployeeType"
                                    name="deleteEmployeeType">
                                Delete Employee Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteLeaveType">
                                <input type="checkbox" class="form-check-input" id="deleteLeaveType"
                                    name="deleteLeaveType">
                                Delete Leave Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteEmployee">
                                <input type="checkbox" class="form-check-input" id="deleteEmployee"
                                    name="deleteEmployee">
                                Terminate Employee
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Row 3 End -->


                @auth()
                <a href="{!!URL::route('roles')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                @else
                <a href="{!!URL::previous()!!}" class="btn btn-sm btn-info" role="button">Back</a>
                @endif
                {!! Form::submit('Add', array('class' => 'btn btn-sm btn-primary')) !!}
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
