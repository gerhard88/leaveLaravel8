<!-- app/views/employee/edit.blade.php -->


@extends('layout/layout')

@section('content')
<!-- Edit Employee Form... -->


<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Update Employee: {!! $employee->name !!} {!! $employee->surname !!}
                </h4>
                <a href="{!!URL::route('employees')!!}" class="btn btn-primary btn-sm mt-3 float-right" role="button"><i
                        data-feather="arrow-left-circle" class="mr-2 icon-md"></i>Back</a>
            </div>

            <div class="card-body">
                @if ( session()->has('success') )
                <div class="alert alert-success alert-dismissable" role="alert">
                    {{ session()->get('success') }} <button type="button" class="close" data-dismiss="alert"
                        aria-label="close">&times;</button></div>
                @elseif ( session()->has('warning') )
                <div class="alert alert-warning alert-dismissable">{{ session()->get('warning') }}</div>
                @elseif ( session()->has('info') )
                <div class="alert alert-info alert-dismissable">{{ session()->get('info') }}</div>
                @elseif ( session()->has('danger') )
                <div class="alert alert-danger alert-dismissable">{{ session()->get('danger') }}</div>
                @endif
                @yield('login')

                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model($employee, array('route' => array('updateEmployee', $employee->id), 'files'=>true,
                'method' => 'PATCH')) !!}

                <!-- Row 1 Begin -->
                <div class="row">
                    <!--Name Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required'))
                            !!}
                        </div>
                    </div>
                    <!-- Surname Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('surname', 'Surname') !!}
                            {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control',
                            'required')) !!}
                        </div>
                    </div>
                    <!-- Employee Nr Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('employee_no', 'Employee No') !!}
                            {!! Form::text('employee_no', Request::old('employee_no'), array('class' => 'form-control',
                            'required')) !!}
                        </div>
                    </div><!-- Col -->
                </div><!-- Row 1 End -->

                <!-- Row 2 Begin -->
                <div class="row">
                    <!--Employee Date of Birth Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('dob', 'Date of birth') !!}
                            {!! Form::date('dob', $employee->dob, array('class' => 'form-control', 'id' => 'dob')) !!}
                        </div>
                    </div>
                    <!-- Employee ID Type Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('idType', 'ID Type') !!}
                            {!! Form::select('idType', array('RSA ID'=>'RSA ID', 'Passport/Foreign
                            ID'=>'Passport/Foreign ID',
                            'Asylum Seeker"s Permit'=>'Asylum Seeker"s Permit', 'Refugee ID'=>'Refugee ID'), null,
                            array('class'
                            => 'form-control')) !!}
                        </div>
                    </div>
                    <!-- Employee ID No Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('idNo', 'ID No') !!}
                            {!! Form::text('idNo', Request::old('idNo'), array('class' => 'form-control', 'required'))
                            !!}
                        </div>
                    </div><!-- Col -->
                </div>
                <!-- Row 2 End -->

                <!-- Row 3 Begin -->
                <div class="row">
                    <!--Employee Gender Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('gender', 'Gender') !!}
                            {!! Form::select('gender', array('Female'=>'Female', 'Male'=>'Male'), null, array('class'
                            => 'form-control')) !!}
                        </div>
                    </div>
                    <!-- Employee Ocupation Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('occupation', 'Occupation') !!}
                            {!! Form::text('occupation', Request::old('occupation'), array('class' => 'form-control',
                            'required')) !!}
                        </div>
                    </div>
                    <!-- Employee Contact Nr Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('contact_no', 'Contact No') !!}
                            {!! Form::text('contact_no', Request::old('contact_no'), array('class' => 'form-control',
                            'required')) !!}
                        </div>
                    </div><!-- Col -->
                </div><!-- Row 3 End -->

                <!-- Row 4 -->
                <div class="row">
                    <!-- Employee Start Date Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('start_date', 'Start Date') !!}
                            {!! Form::date('start_date', $employee->start_date, array('class' => 'form-control', 'id' =>
                            'startDate')) !!}
                        </div>
                    </div>
                    <!-- Employee Email per week Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('email', 'Email Address') !!}
                            {!! Form::text('email', Request::old('email'), array('class' => 'form-control', 'required'))
                            !!}
                        </div>
                    </div>
                    <!-- Employee Type Col -->
                    <div class="col-sm-4 ">
                        <div class="form-group ">
                            {!! Form::label('employeeType_id', 'Employee Type') !!}
                            <select class="form-control input-sm" required name="employeeType_id" id="employeeType_id">
                                @foreach($employeeTypes as $type)
                                @if($type['id'] == $employee['employeeType_id'])
                                <option value="{{$employee['employeeType_id']}}"
                                    selected="{{$employee['employeeType_id']}}">{{$type['employee_type']}}</option>
                                @else
                                <option value="{{$type->id}}">{{$type->employee_type}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Row 4 End -->

                <!-- Row 5 -->
                <div class="row">
                    <!--Country Type Col -->
                    <div class="col-sm-4">
                        <div class="form-group ">
                            {!! Form::label('country_id', 'Country Name') !!}<a tabindex="0" class="btn btn-xs mt-n2"
                                role="button" data-toggle="popover" data-trigger="focus" title="Country Name"
                                data-content="Country Needs to be created first"><i class="link-icon-2" width="20px"
                                    justify-content-end data-feather="info"></i></a>
                            <select class="form-control input-sm" required name="country_id" id="country_id">
                                @foreach($countries as $country)
                                @if($country['id'] == $employee['country_id'])
                                <option value="{{$employee['country_id']}}" selected="{{$employee['country_id']}}">
                                    {{$country['name']}}</option>
                                @else
                                <option value="{{$country->id}}">{{$country->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Company Name Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('company_id', 'Company Name') !!}
                            <a tabindex="0" class="btn btn-xs mt-n2" role="button" data-toggle="popover"
                                data-trigger="focus" title="Company Name"
                                data-content="Company Needs to be created first"><i class="link-icon-2" width="20px"
                                    justify-content-end data-feather="info"></i></a>
                            <select class="form-control input-sm" required name="company_id" id="company_id">
                                @foreach($companies as $company)
                                @if($company['id'] == $employee['company_id'])
                                <option value="{{$employee['company_id']}}" selected="{{$employee['company_id']}}">
                                    {{$company['name']}}</option>
                                @else
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Department Name Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('dept_id', 'Department Name') !!}
                            <a tabindex="0" class="btn btn-xs mt-n2" role="button" data-toggle="popover"
                                data-trigger="focus" title="Department Name"
                                data-content="a Department Needs to be created first"><i class="link-icon-2"
                                    width="20px" justify-content-end data-feather="info"></i></a>
                            <select class="form-control input-sm" required name="dept_id" id="dept_id">
                                @foreach($departments as $dept)
                                @if($dept['id'] == $employee['dept_id'])
                                <option value="{{$employee['dept_id']}}" selected="{{$employee['dept_id']}}">
                                    {{$dept['name']}}</option>
                                @else
                                <option value="{{$dept->id}}">{{$dept->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div><!-- Col -->
                </div><!-- Row 5 End -->

                <!-- Row 6 Begin -->
                <div class="row">
                    <!--Employee Type Col -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('team_id', 'Team Name') !!}
                            <a tabindex="0" class="btn btn-xs mt-n2" role="button" data-toggle="popover"
                                data-trigger="focus" title="Team Name"
                                data-content="a Team Needs to be created first"><i class="link-icon-2" width="20px"
                                    justify-content-end data-feather="info"></i></a>
                            <select class="form-control input-sm" required name="team_id" id="team_id">
                                @foreach($teams as $team)
                                @if($team['id'] == $employee['team_id'])
                                <option value="{{$employee['team_id']}}" selected="{{$employee['team_id']}}">
                                    {{$team['name']}}</option>
                                @else
                                <option value="{{$team->id}}">{{$team->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Empty ID Col -->
                    <div class="col-sm-4">
                        <div class="form-group ">
                        </div>
                    </div>
                    <!-- Email Col -->
                    <div class="col-sm-4">
                        <div class="form-group">

                        </div>
                    </div><!-- Col -->
                </div>
                <!-- Row 6 End -->

                <!-- Row 7 Begin - Please select no of working days per week -->
                <div class="row">
                    <!--Working Day Selection Col -->
                    <div class="col-sm-12">
                        <label for="exampleFormControlSelect1">Please select no of working days per week:
                        </label> <!-- -->
                        <!-- Button trigger modal - Working Days -->
                        <button type="button" class="btn btn-xs mt-n2" data-toggle="modal" data-target="#workingDays">
                            <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i></div>
                        </button>

                        <!-- Modal Working Days -->
                        <div class="modal fade" id="workingDays" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalScrollableTitleAnn" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollableAnn" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EmployeeLeaveTypes">Number of Working Days
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="mb-3">Working Days Explained</h6>
                                        <p>In order to calculate accurate leave types, please select the number of
                                            working days</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- Col -->


                </div><!-- Row ### End -->

                <!-- Row 8 Begin Working days Radio buttons -->
                <div class="row">
                    <!--Working days per week Type Col -->
                    <div class="col-sm-4">

                        <div class="form-group">
                            <div class="form-check">
                                {!! Form::label('work_daysPerWeek', 'No of working days per week:') !!}
                                {!! Form::text('work_daysPerWeek', $work_daysPerWeek, array('class' => 'form-control',
                                'required')) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Empty ID Col -->
                    <div class="col-sm-4">
                        <div class="form-group ">

                        </div>
                    </div>
                    <!-- Email Col -->
                    <div class="col-sm-4">
                        <div class="form-group">

                        </div>
                    </div><!-- Col -->
                </div>
                <!-- Row 8 End -->

                <!-- Row 9 Begin -->
                <div class="row">
                    <!--Name Col -->
                    <div class="col-sm-8">
                        <label for="exampleFormControlSelect1">Employee Leave Types
                        </label> <!-- -->
                        <!-- Button trigger modal Employee Leave Types -->
                        <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                            data-target="#EmployeeLeaveTypes">
                            <i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                        </button>
                        <!-- Modal Employee Leave Types -->
                        <div class="modal fade" id="EmployeeLeaveTypes" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalScrollableTitleAnn" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollableAnn" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="EmployeeLeaveTypes">Annual Types
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h6 class="mb-3">Employee Leave Types Explained</h6>
                                        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                            odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                            risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                            et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                            dolor auctor.</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div><!-- Col -->
                    <!-- Open 2/3 Col -->
                    <div class="col-sm-4">

                    </div>
                    <!-- Open 3/3 Col -->
                    <div class="col-sm-4">
                        <div class="d-flex flex-row">

                        </div>
                    </div><!-- Col -->
                </div><!-- Row 9 End -->

                <!-- Row 10 Begin -->
                <div class="row">
                    <!--Name Col -->
                    <div class="form-group col-md-4 mb-n1">
                        <div class="form-check">
                            <strong><label class="form-check-label d-inline p-2">
                                    <input type="checkbox" id="selectAll">
                                    Select All</strong>
                            </label>
                        </div>
                    </div>
                    <!-- Col -->


                </div><!-- Row 10 End -->

                <!-- Row 10 Begin Leave Types -->
                <div class="row">
                    <div class="form-group col-md-4 ">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="annual">
                                @if ($annual === 'on')
                                <input type="checkbox" name="annual" checked="">
                                @else
                                <input type="checkbox" name="annual" {{ old('annual') ? 'checked' : '' }}>
                                @endif
                                Annual Leave
                            </label>
                            <!-- Button trigger modal Annual Leave -->
                            <button type="button" class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#annualLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Annual Leavel -->
                            <div class="modal fade" id="annualLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalAnnualLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableAnn" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="annualLeave">Annual Types
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Section 20 of the Basic Condition of Employment Act,
                                                Act 75
                                                of 1997
                                                (BCEA) deals with annual leave.</h6>
                                            <ul>
                                                <li>In this Chapter, “annual leave cycle” means the period
                                                    of 12
                                                    months’ employment with the same employer immediate! following<br>
                                                    (a) an employee’s commencement of employment: or<br>
                                                    (b) the completion of that employee’s prior leave cycle.

                                                    <ul>
                                                        <li>(a) an employee’s commencement of employment: or</li>
                                                        <li>(b) the completion of that employee’s prior leave cycle.
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li>An employer must grant an employee at least
                                                    <ul>
                                                        <li>(a) 21 consecutive days’ annual leave on full remuneration
                                                            in respect of each annual leave cycle or</li>
                                                        <li>(b) by agreement, one day of annual leave on full
                                                            remuneration for every 17 days on which the employee worked
                                                            or was entitled to be paid or</li>
                                                        <li>(c) by agreement, one hour of annual leave on full
                                                            remuneration for every 17 hours on which the employee worked
                                                            or was entitled to be paid. </li>
                                                    </ul>
                                                </li>
                                            </ul>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="unpaid">
                                @if ($unpaid === 'on')
                                <input type="checkbox" class="form-check-input" id="unpaid" name="unpaid" checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="unpaid" name="unpaid"
                                    {{ old('maternity') ? 'checked' : '' }}>
                                @endif
                                Unpaid Leave
                            </label> <!-- Button trigger modal Unpaid Leave -->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Unpaid Leave -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave bla
                                                bla
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Annual Leave2</h6>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <h6 class="my-3">When Leave is applicable</h6>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="sick">
                                @if ($sick === 'on')
                                <input type="checkbox" class="form-check-input" id="sick" name="sick" checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="sick" name="sick"
                                    {{ old('sick') ? 'checked' : '' }}>
                                @endif
                                Sick Leave
                            </label><!-- Button trigger modal Sick Leave -->
                            <button type="button " class="btn btn-xs mt-n2 ml-3" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Sick Leave -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave bla
                                                bla
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Annual Leave2</h6>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="study">
                                <input type="checkbox" class="form-check-input" id="study" name="study">
                                Study Leave
                            </label><!-- Button trigger modal Study-->
                            <button type="button " class="btn btn-xs mt-n2 ml-2" data-toggle="modal"
                                data-target="#exampleModalLongScollableStu">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Study -->
                            <div class="modal fade" id="exampleModalLongScollableStu" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitleStu" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableStu" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitleStu">Study Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Study Leave Explained</h6>
                                            <p>Labour legislation there isn't any provision-it does not exist.
                                                Therefore, if the employee has such a requirement, he must apply for
                                                paid Annual leave in accordance with the employer’s Annual leave policy.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="maternity">
                                @if ($maternity === 'on')
                                <input type="checkbox" class="form-check-input" id="maternity" name="maternity"
                                    checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="maternity" name="maternity"
                                    {{ old('maternity') ? 'checked' : '' }}>
                                @endif
                                Maternity Leave
                            </label><!-- Button trigger modal Maternity -->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollableMat">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Maternity -->
                            <div class="modal fade" id="exampleModalLongScollableMat" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitleMat" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableMat" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitleMat">Maternity Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Maternity Leave Explained</h6>
                                            <p>Is <strong>paid leave</strong>. These benefits are paid under UIF Act. A
                                                worker
                                                contributing to UIF is eligible for a maternity benefit of 38%
                                                to 60% of
                                                avg. earnings in the last six months, depending on the insured
                                                person's
                                                level of income. Maternity is paid for a total 17.32 weeks.</p>
                                            <ul class="my-2">
                                                <li>4 Months unpaid - Starting a month before the birth of a child</li>
                                            </ul>
                                            <ul class="my-2">
                                                <li>Annual leave continues to accrue to the employee during a period of
                                                    maternity leave, whether such period of maternity leave is paid
                                                    leave or unpaid leave.</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="family">
                                @if ($family === 'on')
                                <input type="checkbox" class="form-check-input" id="family" name="family" checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="family" name="family"
                                    {{ old('family') ? 'checked' : '' }}>
                                @endif
                                Family Responsibility Leave
                            </label><!-- Button trigger modal Family-->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Family -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave bla
                                                bla
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Annual Leave2</h6>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <h6 class="my-3">When Leave is applicable</h6>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">

                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="commissioning">
                                @if ($commissioning === 'on')
                                <input type="checkbox" class="form-check-input" id="commissioning" name="commissioning"
                                    checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="commissioning" name="commissioning"
                                    {{ old('commissioning') ? 'checked' : '' }}>
                                @endif
                                Commisioning Leave
                            </label><!-- Button trigger modal Commisioning -->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollableCom">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Commisioning -->
                            <div class="modal fade" id="exampleModalLongScollableCom" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitleCom" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableCom" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitleCom">Commisioning
                                                Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Commisioning Leave Explained</h6>
                                            <p>Relates to surrogate motherhood.</p>
                                            <ul class="my-2">
                                                <li>Fathers, adoptive parents, surrogates are entitled to 10 days of
                                                    unpaid leave when their children are born.</li>
                                            </ul>
                                            <ul class="my-2">
                                                <li>Irrespective of gender (same-sex parents).</li>
                                            </ul>
                                            <ul class="my-2">
                                                <li>Commence on the day that the child is born.</li>
                                            </ul>
                                            <ul class="my-2">
                                                <li>Entitled to UIF if parent contributed to the fund during the 13
                                                    weeks before applying for the benefit.</li>
                                            </ul>
                                            <ul class="my-2">
                                                <li>The male employee will have to adduce proof of him being the father
                                                    of the child – BC with his name on.</li>
                                            </ul>
                                            <ul class="my-2">
                                                <li>1 month written notice to an employer of the date leave will
                                                    commence & the employee will return.</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="adoption">
                                @if ($adoption === 'on')
                                <input type="checkbox" class="form-check-input" id="adoption" name="adoption"
                                    checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="adoption" name="adoption"
                                    {{ old('adoption') ? 'checked' : '' }}>
                                @endif
                                Adoption Leave
                            </label><!-- Button trigger modal Adoption -->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Adoption -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave bla
                                                bla
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Annual Leave2</h6>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <h6 class="my-3">When Leave is applicable</h6>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                            <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                cursus magna, vel scelerisque nisl consectetur et. Donec sed
                                                odio dui. Donec ullamcorper nulla non metus auctor fringilla.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="paternity">
                                @if ($paternity === 'on')
                                <input type="checkbox" class="form-check-input" id="paternity" name="paternity"
                                    checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="paternity" name="paternity"
                                    {{ old('paternity') ? 'checked' : '' }}>
                                @endif
                                Paternity Leave
                            </label><!-- Button trigger modal Paternity -->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Paternity -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave bla
                                                bla
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Annual Leave2</h6>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur
                                                et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus
                                                dolor auctor.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label d-inline p-2" for="public">
                                @if ($public === 'on')
                                <input type="checkbox" class="form-check-input" id="public" name="public" checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="public" name="public"
                                    {{ old('public') ? 'checked' : '' }}>
                                @endif
                                Public Holidays
                            </label><!-- Button trigger modal Public-->
                            <button type="button " class="btn btn-xs mt-n2" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon-2" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Public -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave bla
                                                bla
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Annual Leave2</h6>
                                            <p>Cras mattis consectetur purus sit amet fermentum. Cras justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">

                        </div>
                    </div>
                </div><!-- Row 10 End -->

                <a href="{!!URL::route('employees')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
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
