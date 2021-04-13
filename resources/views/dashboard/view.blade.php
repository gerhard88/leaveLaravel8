<!-- app/views/dashboard/view.blade.php -->

@extends('layout/layout')


@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
    </div>

</div>
<!-- row 1 begin -->
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            @if(Auth::user()->addEmployee == 'Y')
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Employees Card Begin-->
                <div class="card icons-list ">
                    <div class="card-body" onclick="location.href='employees';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">EMPLOYEES</h6>

                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage Employees</span>

                                    </p>

                                </div>
                            </div>
                            <div class="icons-list icon">
                                <div><i class="mdi mdi-account-multiple-plus"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            @endif
            <!-- Employees Card Begin-->

            <!-- Attendance Card End-->
            @if(Auth::user()->attReg == 'Y')
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Attendance Reg Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='attendanceRegister/search';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">ATTENDANCE REGISTER</h6>

                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage Attendance</span>

                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-calendar-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Attendance Reg Card End-->

            <!-- Leave Appl Card Begins-->
            @if(Auth::user()->leaveCapture == 'Y')
            <div class="col-md-4 grid-margin stretch-card">

                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='leave/add';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h5 class="card-title mb-0">LEAVE APPLICATION</h5>
                            <div class="dropdown mb-2">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage<br> Leave</span>

                                    </p>
                                </div>
                            </div>
                            <div><i class="mdi mdi-clipboard-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Leave Appl Card Begins-->
        </div>
    </div>
</div>
<!-- row 1 end -->

<!-- row 2 begin -->
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <!-- Calendar Card Begin-->
            <div class="col-md-4 grid-margin stretch-card">

                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='calendar';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">CALENDAR</h6>

                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage Calendar</span>

                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-calendar-multiple"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Calendar Card End-->

            <!-- Reports Card Begins-->
            @if(Auth::user()->reportView == 'Y')
            <div class="col-md-4 grid-margin stretch-card">

                <div class="card icons-list">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">REPORTS</h6>
                            <div class="dropdown mb-2">
                                <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                                            class="icon-sm mr-2"></i> <span class="">Annual Leave Balance</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                                            class="icon-sm mr-2"></i> <span class="">Sick Leave Balance</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                                            class="icon-sm mr-2"></i> <span class="">Leave Balance</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage <br>Reports</span>

                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-file-multiple"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Reports Card End-->

            <!-- Leave Approval Card Begins-->
            @if(Auth::user()->leaveApprove == 'Y')
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h5 class="card-title mb-0">Leave Approval</h5>

                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage Leave Approval</span>

                                    </p>
                                </div>
                            </div>
                            <div><i class="mdi mdi-calendar-today"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Leave Approval Card End-->

        </div>
    </div>
    <!-- row 2 end -->
</div>
<!-- row 2 end -->

<!-- row 3 Begin -->
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <!-- Settings Card Begin-->
            @if(Auth::user()->settings == 'Y')
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Settings Card Begin-->
                <div class="card icons-list">
                    <div class="card-body">
                        </a>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">SETTINGS</h6>

                            <div class="dropdown mb-2">
                                <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    @if(Auth::user()->addCountry == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('countries') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">Country</span></a>
                                    @endif

                                    @if(Auth::user()->addCompany == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('companies') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">Company</span></a>
                                    @endif

                                    @if(Auth::user()->addDept == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('departments') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">Department</span></a>
                                    @endif

                                    @if(Auth::user()->addTeam == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('teams') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">Teams</span></a>
                                    @endif

                                    @if(Auth::user()->addEmployeeType == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('employeeTypes') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">Employee
                                            Types</span></a>
                                    @endif

                                    @if(Auth::user()->addLeaveType == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('leaveTypes') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">Leave
                                            Types</span></a>
                                    @endif

                                    @if(Auth::user()->createRole == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('roles') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">User
                                            Roles</span></a>
                                    @endif

                                    @if(Auth::user()->addUser == 'Y')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{!! URL::route('users') !!}"><i data-feather="chevrons-right"
                                            class="icon-sm mr-2"></i> <span class="">User</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Manage <br>Setup</span>

                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-puzzle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Settings Card End-->

            <!-- Support Card Begin-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Support Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">SUPPORT</h6>
                            <div class="dropdown mb-2">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Contact Us</span>

                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-heart-pulse"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Support Card End-->


        </div>

    </div>
</div>
<!-- row 3 end -->


@endsection
