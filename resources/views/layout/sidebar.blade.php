@if (!Auth::guest())
    <!-- sidebar nav -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav nav-pills nav-stacked">
                    <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#mainMenu">Main</span>
                    <div id="mainMenu" class="collapse in">
                        <li><a href="{!!URL::route('dashboard')!!}">Dashboard</a></li>
                        @if(Auth::user()->addEmployee == 'Y')
                            <li><a href="{!!URL::route('employees')!!}">Employees</a></li>
                        @endif
                        @if(Auth::user()->attReg == 'Y')
                            <li><a href="{!!URL::route('searchAttRegister')!!}">Attendance Register</a></li>
                        @endif
                        @if(Auth::user()->leaveCapture == 'Y')
                            <li><a href="{!!URL::route('addLeave')!!}">Leave Application</a></li>
                        @endif
                        @if(Auth::user()->leaveApprove == 'Y')
                            <li><a href="{!!URL::route('leaves')!!}">Approve Leave</a></li>
                        @endif
                        <li><a href="{!!URL::route('calendar')!!}">Calendar</a></li>

                        @if(Auth::user()->settings == 'Y')
                            <div class="settings">
                                <button class="settbtn">Settings</button>
                                <div class="settings-content">
                                    @if(Auth::user()->createRole == 'Y')
                                        <li><a href="{!! URL::route('roles') !!}">User Roles</a></li>
                                    @endif
                                    @if(Auth::user()->addCountry == 'Y')
                                        <li><a href="{!! URL::route('countries') !!}">Countries</a></li>
                                    @endif
                                    @if(Auth::user()->addCompany == 'Y')
                                        @if(Auth::user()->updateCompany == 'Y')
                                            <li><a href="{!! URL::route('companies') !!}">Companies</a></li>
                                        @else
                                            <li><a href="{!! URL::route('addCompany') !!}">Add Company</a></li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->addUser == 'Y')
                                        <li><a href="{!! URL::route('users') !!}">Users</a></li>
                                    @endif
                                    @if(Auth::user()->addDept == 'Y')
                                        @if(Auth::user()->updateDept == 'Y')
                                            <li><a href="{!! URL::route('departments') !!}">Departments</a></li>
                                        @else
                                            <li><a href="{!! URL::route('addDepartment') !!}">Add Department</a></li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->addTeam == 'Y')
                                        @if(Auth::user()->updateTeam == 'Y')
                                            <li><a href="{!! URL::route('teams') !!}">Teams</a></li>
                                        @else
                                            <li><a href="{!! URL::route('addTeam') !!}">Add Team</a></li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->addEmployeeType == 'Y')
                                        <li><a href="{!!URL::route('employeeTypes')!!}">Employee Types</a></li>
                                    @endif
                                    @if(Auth::user()->addLeaveType == 'Y')
                                        <li><a href="{!!URL::route('leaveTypes')!!}">Leave Types</a></li>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(Auth::user()->reportView == 'Y')
                        <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#reports">Reports</span>
                        <div id="reports" class="collapse in">
                            <li><a href="{!!URL::route('annualLeave')!!}">Annual Leave Balances</a></li>
                            <li><a href="{!!URL::route('sickLeave')!!}">Sick Leave Balances</a></li>
                            <li><a href="{!! URL::route('leaveRequests') !!}">Leave Requests</a></li>
                        </div>
                    @endif
                    <span class="label label-primary col-xs-12 col-sm-12 col-md-12" style="cursor: pointer;" data-toggle="collapse" data-target="#helpSupport">Help & Support</span>
                    <div id="helpSupport" class="collapse in">
                        <li><a href="#">FAQ's</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Documentation</a></li>
                    </div>
                    <div><li><a href="{!!URL::route('logout')!!}">Logout</a></li></div>
                </ul>
            </div>
        </div>
    </nav>
@endif