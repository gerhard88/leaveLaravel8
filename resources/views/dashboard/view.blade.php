<!-- app/views/dashboard/view.blade.php -->

@extends('layout/layout')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <div class="elementor-widget-container">
                        <ul class="elementor-icon-list-items">
                            <li class="elementor-icon-list-item">
                                <span class="elementor-icon-list-icon"><i aria-hidden="true" class="fas fa-leaf"></i></span>
                                <span class="elementor-icon-list-text">Calcu-Leave / Accu-Leave</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">

            <div class="row">
                @if(Auth::user()->addEmployee == 'Y')
                    <div class="container pt-4 my-4 col-sm-4">
                        <h3>EMPLOYEES</h3>
                        <a href="{!!URL::route('employees') !!}">Manage <br> Employees</a>
                    </div>
                @endif
                @if(Auth::user()->attReg == 'Y')
                    <div class="container pt-4 my-4 col-sm-4">
                        <h3>Attendance Register</h3>
                        <a href="{!!URL::route('searchRegister') !!}">Attendance <br> Register</a>
                    </div>
                @endif
                <div class="container pt-4 my-4 col-sm-4">
                    <h3>CALENDAR</h3>
                    <a href="{!!URL::route('calendar') !!}">Manage <br> Calendar</a>
                </div>
            </div><br><br>

            <div class="row">
                @if(Auth::user()->settings == 'Y')
                    <div class="container pt-3 my-3 col-sm-3">
                        <h3>SETTINGS</h3>
                        <div class="settings">
                            <button class="settbtn">Settings</button>
                            <div class="settings-content">
                                @if(Auth::user()->createRole == 'Y')
                                    <a href="{!! URL::route('roles') !!}">User Roles</a>
                                @endif
                                @if(Auth::user()->addUser == 'Y')
                                    <a href="{!! URL::route('users') !!}">Users</a>
                                @endif
                                @if(Auth::user()->addCountry == 'Y')
                                    <a href="{!! URL::route('countries') !!}">Countries</a>
                                @endif
                                @if(Auth::user()->addCompany == 'Y')
                                    <a href="{!! URL::route('companies') !!}">Companies</a>
                                @endif
                                @if(Auth::user()->addDept == 'Y')
                                    <a href="{!! URL::route('departments') !!}">Departments</a>
                                @endif
                                @if(Auth::user()->addTeam == 'Y')
                                    <a href="{!! URL::route('teams') !!}">Teams</a>
                                @endif
                                @if(Auth::user()->addEmployeeType == 'Y')
                                    <a href="{!! URL::route('employeeTypes') !!}">Employee Types</a>
                                @endif
                                @if(Auth::user()->addLeaveType == 'Y')
                                    <a href="{!! URL::route('leaveTypes') !!}">Leave Types</a>
                                @endif
                            </div>
                        </div>
                        <p>Add Country / Company / User </p>
                    </div>
                @endif
                @if(Auth::user()->reportView == 'Y')
                    <div class="container pt-3 my-3 col-sm-3">
                        <h3>REPORTS</h3>
                        <div class="settings">
                            <button class="settbtn">View <br> Reports</button>
                            <div class="settings-content">
                                <a href="{!! URL::route('annualLeave') !!}">Annual Leave</a>
                                <a href="{!! URL::route('sickLeave') !!}">Sick Leave</a>
                            </div>
                        </div>
                    </div>
                @endif
                @if(Auth::user()->leaveCapture == 'Y')
                    <div class="container pt-3 my-3 col-sm-3">
                        <h3>LEAVE</h3>
                        <a href="{!!URL::route('addLeave') !!}">Leave <br> Application</a>
                    </div>
                @endif
                @if(Auth::user()->leaveApprove == 'Y')
                    <div class="container pt-3 my-3 col-sm-3">
                        <h3>LEAVE</h3>
                        <a href="{!!URL::route('leaves') !!}">Leave <br> Approval</a>
                    </div>
                @endif
            </div>
            <div class="container pt-4 my-4 col-sm-4">
                <h3>SUPPORT</h3>
                <p> Contact <br> Us <br> Nr 021 021 0211</p>
            </div>
        </div>
    </div>
@endsection