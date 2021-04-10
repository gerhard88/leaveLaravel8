<!-- app/views/role/edit.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Edit Country Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-12 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Update Role: {!! $role->description !!}</h4>
            </div>


            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model($role, ['method' => 'PATCH', 'route' => ['update', $role->id]]) !!}

                <!-- Row 1 Begin -->
                <div class="row">
                    <!--Name Col -->
                    <div class="form-group col-md-4 ">
                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::text('description', $role->description, array('class' =>
                            'form-control',
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
                                @if ($createRole == 'on')
                                <input type="checkbox" name="createRole" checked="" id="createRole">
                                @else
                                <input type="checkbox" name="createRole" {{ old('createRole') ? 'checked' : '' }}
                                    id="createRole">
                                @endif
                                Create User Role
                            </label>
                        </div>

                        <div class=" form-check">
                            <label class="form-check-label d-inline p-2" for="addUser">
                                @if ($addUser == 'on')
                                <input type="checkbox" name="addUser" checked="" id="addUser">
                                @else
                                <input type="checkbox" name="addUser" {{ old('addUser') ? 'checked' : '' }}
                                    id="addUser">
                                @endif
                                Add User
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addCountry">
                                @if ($addCountry == 'on')
                                <input type="checkbox" name="addCountry" checked="" id="addCountry">
                                @else
                                <input type="checkbox" name="addCountry" {{ old('addCountry') ? 'checked' : '' }}
                                    id="addCountry">
                                @endif
                                Add Country
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addCompany">
                                @if ($addCompany == 'on')
                                <input type="checkbox" name="addCompany" checked="" id="addCompany">
                                @else
                                <input type="checkbox" name="addCompany" {{ old('addCompany') ? 'checked' : '' }}
                                    id="addCompany">
                                @endif
                                Add Company
                            </label>
                        </div>


                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addDept">
                                @if ($addDept == 'on')
                                <input type="checkbox" name="addDept" checked="" id="addDept">
                                @else
                                <input type="checkbox" name="addDept" {{ old('addDept') ? 'checked' : '' }}
                                    id="addDept">
                                @endif
                                Add Department
                            </label>
                        </div>


                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addTeam">
                                @if ($addTeam == 'on')
                                <input type="checkbox" name="addTeam" checked="" id="addTeam">
                                @else
                                <input type="checkbox" name="addTeam" {{ old('addTeam') ? 'checked' : '' }}
                                    id="addTeam">
                                @endif
                                Add Team
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addEmployeeType">
                                @if ($addEmployeeType == 'on')
                                <input type="checkbox" name="addEmployeeType" checked="" id="addEmployeeType">
                                @else
                                <input type="checkbox" name="addEmployeeType"
                                    {{ old('addEmployeeType') ? 'checked' : '' }} id="addEmployeeType">
                                @endif
                                Add Employee Type
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addLeaveType">
                                @if ($addLeaveType == 'on')
                                <input type="checkbox" name="addLeaveType" checked="" id="addLeaveType">
                                @else
                                <input type="checkbox" name="addLeaveType" {{ old('addLeaveType') ? 'checked' : '' }}
                                    id="addLeaveType">
                                @endif
                                Add Leave Type
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="addEmployee">
                                @if ($addEmployee == 'on')
                                <input type="checkbox" name="addEmployee" checked="" id="addEmployee">
                                @else
                                <input type="checkbox" name="addEmployee" {{ old('addEmployee') ? 'checked' : '' }}
                                    id="addEmployee">
                                @endif
                                Add Employee
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="leaveCreate">
                                @if ($leaveCreate == 'on')
                                <input type="checkbox" name="leaveCreate" checked="" id="leaveCreate">
                                @else
                                <input type="checkbox" name="leaveCreate" {{ old('leaveCreate') ? 'checked' : '' }}
                                    id="leaveCreate">
                                @endif
                                Leave Application
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="attReg">
                                @if ($attReg == 'on')
                                <input type="checkbox" name="attReg" checked="" id="attReg">
                                @else
                                <input type="checkbox" name="attReg" {{ old('attReg') ? 'checked' : '' }} id="attReg">
                                @endif
                                Attendance Register
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="reports">
                                @if ($reports == 'on')
                                <input type="checkbox" name="reports" checked="" id="reports">
                                @else
                                <input type="checkbox" name="reports" {{ old('reports') ? 'checked' : '' }}
                                    id="reports">
                                @endif
                                View Reports
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="settings">
                                @if ($settings == 'on')
                                <input type="checkbox" name="settings" checked="" id='settings'>
                                @else
                                <input type="checkbox" name="settings" id='settings'
                                    {{ old('settings') ? 'checked' : '' }}>
                                @endif
                                Settings
                            </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2">
                                @if ($updateRole == 'on')
                                <input type="checkbox" name="updateRole" checked="" id='settings'>
                                @else
                                <input type="checkbox" name="updateRole" {{ old('updateRole') ? 'checked' : '' }}
                                    id='settings'>
                                @endif
                                Update User Role
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateUser">
                                @if ($updateUser == 'on')
                                <input type="checkbox" name="updateUser" checked="" id='updateUser'>
                                @else
                                <input type="checkbox" name="updateUser" {{ old('updateUser') ? 'checked' : '' }}
                                    id='updateUser'>
                                @endif
                                Update User
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateCountry">
                                @if ($updateCountry == 'on')
                                <input type="checkbox" name="updateCountry" checked="" id='updateCountry'>
                                @else
                                <input type="checkbox" name="updateCountry" {{ old('updateCountry') ? 'checked' : '' }}
                                    id='updateCountry'>
                                @endif
                                Update Country
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateCompany">
                                @if ($updateCompany == 'on')
                                <input type="checkbox" name="updateCompany" checked="" id='updateCompany'>
                                @else
                                <input type="checkbox" name="updateCompany" {{ old('updateCompany') ? 'checked' : '' }}
                                    id='updateCompany'>
                                @endif
                                Update Company
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateDept">
                                @if ($updateDept == 'on')
                                <input type="checkbox" name="updateDept" checked="" id='updateDept'>
                                @else
                                <input type="checkbox" name="updateDept" {{ old('updateDept') ? 'checked' : '' }}
                                    id='updateDept'>
                                @endif
                                Update Department
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateTeam">
                                @if ($updateTeam == 'on')
                                <input type="checkbox" name="updateTeam" checked="" id='updateTeam'>
                                @else
                                <input type="checkbox" name="updateTeam" {{ old('updateTeam') ? 'checked' : '' }}
                                    id='updateTeam'>
                                @endif
                                Update Team
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateEmployeeType">
                                @if ($updateEmployeeType == 'on')
                                <input type="checkbox" name="updateEmployeeType" checked="" id='updateEmployeeType'>
                                @else
                                <input type="checkbox" name="updateEmployeeType"
                                    {{ old('updateEmployeeType') ? 'checked' : '' }} id='updateEmployeeType'>
                                @endif
                                Update Employee Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateLeaveType">
                                @if ($updateLeaveType == 'on')
                                <input type="checkbox" name="updateLeaveType" checked="" id='updateLeaveType'>
                                @else
                                <input type="checkbox" name="updateLeaveType"
                                    {{ old('updateLeaveType') ? 'checked' : '' }} id='updateLeaveType'>
                                @endif
                                Update Leave Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="updateRole">
                                @if ($updateEmployee == 'on')
                                <input type="checkbox" name="updateEmployee" checked="" id='updateRole'>
                                @else
                                <input type="checkbox" name="updateEmployee"
                                    {{ old('updateEmployee') ? 'checked' : '' }} id='updateRole'>
                                @endif
                                Update Employee
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="leaveUpdate">
                                @if ($leaveUpdate == 'on')
                                <input type="checkbox" name="leaveUpdate" checked="" id='leaveUpdate'>
                                @else
                                <input type="checkbox" name="leaveUpdate" {{ old('leaveUpdate') ? 'checked' : '' }}
                                    id='leaveUpdate'>
                                @endif
                                Leave Approval
                            </label>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteRole">
                                @if ($deleteRole == 'on')
                                <input type="checkbox" name="deleteRole" checked="" id='deleteRole'>
                                @else
                                <input type="checkbox" name="deleteRole" {{ old('deleteRole') ? 'checked' : '' }}
                                    id='deleteRole'>
                                @endif
                                Delete User Role
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteUser">
                                @if ($deleteUser == 'on')
                                <input type="checkbox" name="deleteUser" checked="" id='deleteUser'>
                                @else
                                <input type="checkbox" name="deleteUser" {{ old('deleteUser') ? 'checked' : '' }}
                                    id='deleteUser'>
                                @endif
                                Delete User
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteCountry">
                                @if ($deleteCountry == 'on')
                                <input type="checkbox" name="deleteCountry" checked="" id='deleteCountry'>
                                @else
                                <input type="checkbox" name="deleteCountry" {{ old('deleteCountry') ? 'checked' : '' }}
                                    id='deleteCountry'>
                                @endif
                                Delete Country
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteCompany">
                                @if ($deleteCompany == 'on')
                                <input type="checkbox" name="deleteCompany" checked="" id='deleteCompany'>
                                @else
                                <input type="checkbox" name="deleteCompany" {{ old('deleteCompany') ? 'checked' : '' }}
                                    id='deleteCompany'>
                                @endif
                                Delete Company
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteDept">
                                @if ($deleteDept == 'on')
                                <input type="checkbox" name="deleteDept" checked="" id='deleteDept'>
                                @else
                                <input type="checkbox" name="deleteDept" {{ old('deleteDept') ? 'checked' : '' }}
                                    id='deleteDept'>
                                @endif
                                Delete Department
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteTeam">
                                @if ($deleteTeam == 'on')
                                <input type="checkbox" name="deleteTeam" checked="" id='deleteTeam'>
                                @else
                                <input type="checkbox" name="deleteTeam" {{ old('deleteTeam') ? 'checked' : '' }}
                                    id='deleteTeam'>
                                @endif
                                Delete Team
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteEmployeeType">
                                @if ($deleteEmployeeType == 'on')
                                <input type="checkbox" name="deleteEmployeeType" checked="" id='deleteEmployeeType'>
                                @else
                                <input type="checkbox" name="deleteEmployeeType"
                                    {{ old('deleteEmployeeType') ? 'checked' : '' }} id='deleteEmployeeType'>
                                @endif
                                Delete Employee Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteLeaveType">
                                @if ($deleteLeaveType == 'on')
                                <input type="checkbox" name="deleteLeaveType" checked="" id='deleteLeaveType'>
                                @else
                                <input type="checkbox" name="deleteLeaveType"
                                    {{ old('deleteLeaveType') ? 'checked' : '' }} id='deleteLeaveType'>
                                @endif
                                Delete Leave Type
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="deleteEmployee">
                                @if ($deleteEmployee == 'on')
                                <input type="checkbox" name="deleteEmployee" checked="" id='deleteEmployee'>
                                @else
                                <input type="checkbox" name="deleteEmployee"
                                    {{ old('deleteEmployee') ? 'checked' : '' }} id='deleteEmployee'>
                                @endif
                                Terminate Employee
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Row 3 End -->


                <a href="{!!URL::route('roles')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                {!! Form::submit('Update', array('class' => 'btn btn-sm btn-primary')) !!}
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
