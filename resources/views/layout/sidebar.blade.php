@if (!Auth::guest())
<!-- sidebar nav -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            BM<span> Systems</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="sidebar-body">

        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item ">
                <a href="{!!URL::route('dashboard')!!}" class="nav-link">
                    <i class="link-icon" data-feather="grid"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <!-- Employees Begin -->
            <li class="nav-item">
                @if(Auth::user()->addEmployee == 'Y')
                <a href="{!!URL::route('employees')!!}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Employees</span>
                </a>
                @endif
            </li>
            <!-- Employees End -->
            <!-- Attendance Begin -->
            <li class="nav-item ">
                @if(Auth::user()->attReg == 'Y')
                <a href="{!!URL::route('searchAttRegister')!!}" class="nav-link">
                    <i class="link-icon" data-feather="user-check"></i>
                    <span class="link-title">Attendance Register</span>
                </a>
                @endif
            </li>
            <!-- Attendance End -->
            <!-- Leave App Begin -->
            <li class="nav-item ">
                @if(Auth::user()->leaveCapture == 'Y')
                <a href="{!!URL::route('addLeave')!!}" class="nav-link">
                    <i class="link-icon" data-feather="check-square"></i>
                    <span class="link-title">Leave Applications</span>
                </a>
                @endif
            </li>
            <!-- Leave App End -->
            <!-- Approve Leav Begin -->
            <li class="nav-item ">
                @if(Auth::user()->leaveApprove == 'Y')
                <a href="{!!URL::route('leaves')!!}" class="nav-link">
                    <i class="link-icon" data-feather="thumbs-up"></i>
                    <span class="link-title">Approve Leave</span>
                </a>
                @endif
            </li>
            <!-- Approve Leav End -->
            <!-- Calendar Begin No IF STATEMENET YET!!! -->
            <li class="nav-item ">
                <a href="{!!URL::route('calendar')!!}" class="nav-link">
                    <i class="link-icon" data-feather="calendar"></i>
                    <span class="link-title">Calendar</span>
                </a>
            </li>
            <!-- Calendar End -->
            <!-- Settings Begin -->
            <li class="nav-item ">
                @if(Auth::user()->settings == 'Y')
                <a class="nav-link" data-toggle="collapse" href="#setup" role="button" aria-expanded=""
                    aria-controls="setup">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Setup</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse " id="setup">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{!! URL::route('setup') !!}" class="nav-link ">Setup Dashboard</a>
                        </li>
                        @if(Auth::user()->addCountry == 'Y')
                        <li class="nav-item">
                            <a href="{!! URL::route('countries') !!}" class="nav-link ">Country</a>
                        </li>
                        @endif
                        @if(Auth::user()->addCompany == 'Y')
                        @if(Auth::user()->updateCompany == 'Y')
                        <li class="nav-item">
                            <a href="{!! URL::route('companies') !!}" class="nav-link ">Company</a>
                        </li>
                        @else
                        <li><a href="{!! URL::route('addCompany') !!}">Add Company</a></li>
                        @endif
                        @endif
                        @if(Auth::user()->addDept == 'Y')
                        @if(Auth::user()->updateDept == 'Y')
                        <li class="nav-item">
                            <a href="{!!URL::route('departments')!!}" class="nav-link ">Department</a>
                        </li>
                        @else
                        <li><a href="{!! URL::route('addDepartment') !!}">Add Department</a></li>
                        @endif
                        @endif
                        @if(Auth::user()->addTeam == 'Y')
                        @if(Auth::user()->updateTeam == 'Y')
                        <li class="nav-item">
                            <a href="{!!URL::route('teams')!!}" class="nav-link ">Teams</a>
                        </li>
                        @else
                        <li><a href="{!! URL::route('addTeam') !!}">Add Team</a></li>
                        @endif
                        @endif
                        @if(Auth::user()->addEmployeeType == 'Y')
                        <li class="nav-item">
                            <a href="{!!URL::route('employeeTypes')!!}" class="nav-link ">Employee Types</a>
                        </li>
                        @endif
                        @if(Auth::user()->addLeaveType == 'Y')
                        <li class="nav-item">
                            <a href="{!!URL::route('leaveTypes')!!}" class=" nav-link ">Leave Types</a>
                        </li>
                        @endif
                        @if(Auth::user()->createRole == 'Y')
                        <li class="nav-item">
                            <a href="{!! URL::route('roles') !!}"" class=" nav-link ">User Roles</a>
                        </li>
                        @endif
                        @if(Auth::user()->addUser == 'Y')
                        <li class=" nav-item">
                                <a href="{!! URL::route('users') !!}" class=" nav-link ">Users</a>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif
            </li>
            @if(Auth::user()->reportView == 'Y')
            <li class=" nav-item nav-category">Reports</li>
            <li class="nav-item ">
                <a href="{!!URL::route('annualLeave')!!}" class="nav-link">
                    <i class="link-icon" data-feather="pie-chart"></i>
                    <span class="link-title">Annual Leave Balance</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{!!URL::route('sickLeave')!!}" class="nav-link">
                    <i class="link-icon" data-feather="user-minus"></i>
                    <span class="link-title">Sick Leave Balance</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{!!URL::route('leaveRequests')!!}" class="nav-link">
                    <i class="link-icon" data-feather="briefcase"></i>
                    <span class="link-title">Leave Requests</span>
                </a>
            </li>
            @endif
            <li class=" nav-item nav-category">Help</li>
            <li class="nav-item ">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Docs</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="" class="nav-link">
                    <i class="link-icon" data-feather="send"></i>
                    <span class="link-title">Contact Us</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
@endif
