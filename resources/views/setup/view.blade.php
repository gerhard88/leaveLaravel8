@extends('layout.layout')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Setup</h4>
    </div>

</div>
<!-- row 1 begin -->
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Country Card Begin-->
                <div class="card icons-list ">
                    <div class="card-body" onclick="location.href='countries';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">COUNTRY</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Country Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-map-marker-multiple"></i>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- Country Card End-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Company Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='companies';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">COMPANY</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Company Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-home-modern"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Company Card End-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Department Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='departments';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h5 class="card-title mb-0">DEPARTMENT</h5>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Department Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div><i class="mdi mdi-account-convert"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row 1 end -->

<!-- row 2 begin -->
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Team Card Begin-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='teams';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">TEAMS</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Team Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-kabaddi"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Card End-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Leave Type Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='employeeTypes';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Employee Types</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Employee Types Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-human-greeting"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Leave Type Card End-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Leave Type Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='leaveTypes';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">LEAVE TYPES</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>Leave Type Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-calendar-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row 2 end -->

<!-- row 3 begin -->
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <!-- User Roles Card Begin-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='roles';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">User Roles</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>User Roles Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-account-key"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Team Card End-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Leave Type Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='users';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">USER</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-primary">
                                        <span>User <br>Settings</span>
                                    </p>
                                </div>
                            </div>
                            <div class="icons-list">
                                <div><i class="mdi mdi-account-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Leave Type Card End-->
            <div class="col-md-4 grid-margin stretch-card">
                <!-- Calendar Card Begins-->
                <div class="card icons-list">
                    <div class="card-body" onclick="location.href='';" style="cursor:pointer;">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h5 class="card-title mb-0">PUBLIC HOLIDAYS</h5>
                            <div class="dropdown mb-2">
                                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye"
                                            class="icon-sm mr-2"></i> <span class="">View</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2"
                                            class="icon-sm mr-2"></i> <span class="">Add/Edit</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash"
                                            class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="#"><i
                                            data-feather="download" class="icon-sm mr-2"></i> <span
                                            class="">Report</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                        <span>Public Holiday Settings</span>
                                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                    </p>
                                </div>
                            </div>
                            <div><i class="mdi mdi-calendar-today"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row 3 end -->


@endsection
