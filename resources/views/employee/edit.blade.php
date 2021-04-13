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
                        <label for="EmployeeLeaveTypes">Employee Leave Types
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
                                <input type="checkbox" class="form-check-input" name="annual" checked="" id="annual">
                                @else
                                <input type="checkbox" id="annual" {{ old('annual') ? 'checked' : '' }}>
                                @endif
                                Annual Leave
                            </label>
                            <!-- Button trigger modal Annual Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
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
                                            <h5 class="modal-title text-center" id="annualLeave">Annual Types
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3 ">Section 20 of the Basic Condition of Employment Act,
                                                Act 75
                                                of 1997
                                                (BCEA) deals with annual leave.</h6>
                                            <p class="mt-4 ml-3">In this Chapter, “annual leave cycle” means the
                                                period of 12 months’ employment with the same employer immediate!
                                                following<br>
                                                <ul>
                                                    <li>(a) an employee’s commencement of employment: or<br>
                                                    </li>
                                                    <li>(b) the completion of that employee’s prior leave cycle.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">An employer must grant an employee at least <br>
                                                <ul>
                                                    <li>(a) 21 consecutive days’ annual leave on full remuneration in
                                                        respect of each annual leave cycle or <br>
                                                    </li>
                                                    <li>
                                                        (b) by agreement, one day of annual leave on full remuneration
                                                        for every
                                                        17 days on which the employee worked or was entitled to be paid
                                                        or <br>
                                                    </li>
                                                    <li>
                                                        (c) by agreement, one hour of annual leave on full remuneration
                                                        for
                                                        every 17 hours on which the employee worked or was entitled to
                                                        be paid.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">An employee is entitled to take leave accumulated in an
                                                annual leave cycle in terms of subsection (2) on consecutive days.
                                            </p>
                                            <p class="mt-4 ml-3">An employer must grant annual leave not later than six
                                                months after the end of the annual leave cycle.
                                            </p>
                                            <p class="mt-4 ml-3">An employer may not require or permit an employee to
                                                take
                                                annual leave during <br>
                                                <ul>
                                                    <li>
                                                        (a) any other period of leave to which the employee is entitled
                                                        in terms
                                                        of this Chapter; or <br>
                                                    </li>
                                                    <li>
                                                        (b) any period of notice of termination of employment.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">Despite subsection (5), an employer must permit an
                                                employee, at the employee’s written request. to take leave during a
                                                period of unpaid leave.
                                            </p>
                                            <p class="mt-4 ml-3">An employer may reduce an employee’s entitlement to
                                                annual
                                                leave by the number of days of occasional leave on full remuneration
                                                granted to the employee
                                                at the employee’s request in that leave cycle.
                                            </p>
                                            <p class="mt-4 ml-3">An employer must grant an employee an additional day of
                                                paid leave if a public holiday falls on a day during an employee’s
                                                annual leave on which the
                                                employee would ordinarily have worked.
                                            </p>
                                            <p class="mt-4 ml-3">An employer may not require or permit an employee to
                                                work
                                                for the employer during any period of annual leave.
                                            </p>
                                            <p class="mt-4 ml-3">Annual leave must be taken <br>
                                                <ul>
                                                    <li>
                                                        (a) in accordance with an agreement between the employer and
                                                        employee;
                                                        or <br>
                                                    </li>
                                                    <li>
                                                        (b) if there is no agreement in terms of paragraph (a). at a
                                                        time determined by the employer in accordance with
                                                        this section.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">An employer may not pay an employee instead of
                                                granting paid leave in terms of this section except <br>
                                                <ul>
                                                    <li>
                                                        (a) on termination of employment; and <br>
                                                    </li>
                                                    <li>
                                                        (b) in accordance with section 40(b) and (c).
                                                    </li>
                                                </ul>
                                            </p>
                                            <h6 class="my-2 ml-3">Pay for annual leave</h6>
                                            <p class="mt-4 ml-3">An employer must pay an employee leave pay at least
                                                equivalent to the remuneration that the employee would have received for
                                                working for a period equal to the period of annual leave, calculated<br>
                                                <ul>
                                                    <li>
                                                        (a) at the employee’s rate of remuneration immediately before
                                                        the
                                                        beginning of the period of annual leave: and<br>
                                                    </li>
                                                    <li>
                                                        (b) in accordance with section 35.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">An employer must pay an employee leave pay<br>
                                                <ul>
                                                    <li>
                                                        (a) before the beginning of the period of leave; or<br>
                                                    </li>
                                                    <li>
                                                        (b) by agreement. on the employee’s usual pay day.
                                                    </li>
                                                </ul>
                                            </p>
                                            <h6 class="my-2 ml-3">Additional:</h6>
                                            <p class="mt-4 ml-3">This method of calculation is useful when dealing
                                                with temporary employees or those working on a fixed-term contract. In
                                                the
                                                absence of an agreement as referred to above, leave typically accrues at
                                                1,25 days per month for employees who work 5 days a week. If the
                                                employee works 6 days a week, the leave will accrue at 1,5 days per
                                                month.
                                            </p>
                                            <p class="mt-4 ml-3">When the employee works 5 days a week, this means the
                                                employee will be entitled to <strong>15</strong> working days’ leave, or
                                                <strong>18</strong> working days
                                                if the employee normally works <strong>6</strong> days a week.
                                            </p>
                                            <p class="mt-4 ml-3">Although the BCEA prescribes the minimum number of
                                                days to be granted for annual leave, nothing prohibits an employer from
                                                granting
                                                additional days leave to employees over and above the minimum days
                                                required.
                                            </p>
                                            <p class="mt-4 ml-3">An employer is prohibited from paying out annual
                                                leave except upon termination of the employee’s contract.
                                            </p>
                                            <p class="mt-4 ml-3">Many companies have an annual shutdown period which
                                                should be communicated to employees early in the year. If an employee’s
                                                annual
                                                leave has already been exhausted at the time of the annual shutdown,
                                                leave may still be granted, in which case it is advisable to treat this
                                                as unpaid leave. This is sometimes problematic as the shutdown periods
                                                are not determined by employees, but they are expected to take leave
                                                during such time. Employers may elect to grant leave that is not yet
                                                due, in which case employees go into a “negative leave” balance.
                                                Although nothing prohibits such a practice, it might cause problems
                                                later when an employee’s employment is terminated. If an employee still
                                                has a negative balance when his/her employment is terminated, the value
                                                of the negative balance may not be deducted from the employee’s final
                                                salary, as it had not been agreed that the leave granted previously
                                                (which was not yet due) would be treated as unpaid leave.
                                            </p>

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
                            <button type="button " class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#exampleModalLongScollable3">
                                <i class="link-icon" width="20px" data-feather="info"></i>
                            </button>
                            <!-- Modal Unpaid Leave -->
                            <div class="modal fade" id="exampleModalLongScollable3" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle3" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable3" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollableTitle3">Unpaid Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3">Unpaid Leave</h6>
                                            <p class="mt-4 ml-3">Cras mattis consectetur purus sit amet fermentum. Cras
                                                justo
                                                odio, dapibus ac facilisis in, egestas eget quam. Morbi leo
                                                risus, porta ac consectetur ac, vestibulum at eros.</p>

                                            <h6 class="my-3 ml-3">When Leave is applicable</h6>
                                            <p class="mt-4 ml-3">Aenean lacinia bibendum nulla sed consectetur. Praesent
                                                commodo
                                                cursus magna.
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
                            </label>
                            <!-- Button trigger modal Sick Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#sickLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Leave Leave -->
                            <div class="modal fade" id="sickLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalSickLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableSick" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="sickLeave">Sick Types
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3">Sections 22 and 23 of the Basic Conditions of Employment
                                                Act (BCEA) deal with an employee's sick
                                                leave.</p>
                                            <p class="mt-4 ml-3">In this Chapter. “sick leave cycle” means the period
                                                of 36
                                                months’ employment with the same employer immediately following<br>
                                                <ul>
                                                    <li>
                                                        (a) an employee’s commencement of employment; or<br>
                                                    </li>
                                                    <li>
                                                        (b) the completion of that employee’s prior sick leave cycle.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">During every sick leave cycle. an employee is entitled
                                                to
                                                an amount of paid sick leave equal to the number of days the employee
                                                would normally work during a period of six weeks.<br>
                                            </p>
                                            <p class="mt- ml-3">Despite subsection (2), during the first six months of
                                                employment. an employee is entitled to one day’s paid sick leave for
                                                every 26 days worked.
                                            </p>
                                            <p class="mt-4 ml-3">During an employee’s first sick leave cycle. an
                                                employer
                                                may reduce the employee’s entitlement to sick leave in terms of
                                                subsection (2) by the number of days” sick leave taken in terms of
                                                subsection (3).
                                            </p>
                                            <p class="mt-4 ml-3">Subject to section 23. an employer must pay an
                                                employee for a day’s sick leave<br>
                                                <ul>
                                                    <li>
                                                        (a) the wage the employee would ordinarily have received for
                                                        work on
                                                        that day; and <br>
                                                    </li>
                                                    <li>
                                                        (b) on the employee’s usual pay day.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4 ml-3">An agreement may reduce the pay to which an employee
                                                is
                                                entitled in respect of any day’s absence in terms of this section if<br>
                                                <ul>
                                                    <li>
                                                        (a) the number of days of paid sick leave is increased at least
                                                        commensurately with any reduction in the daily amount of sick
                                                        pay:
                                                        and<br>
                                                    </li>
                                                    <li>
                                                        (b) the employee’s entitlement to pay.<br>
                                                    </li>
                                                </ul>


                                            </p>
                                            <p class="mr-1 ml-3">
                                                <strong>(i)</strong> for any day’s sick leave is at least 75 per cent of
                                                the wage payable to the employee for the ordinary hours the employee
                                                would have worked on
                                                that day: and<br>
                                                <strong>(ii)</strong> for sick leave over the sick leave cycle is at
                                                least equivalent to the employee’s entitlement in terms of subsection
                                                (2).
                                            </p>
                                            <h6 class="mt-3 ml-3">Proof of incapacity</h6>
                                            <p class="mt-4 ml-3 ml-3">An employer is not required to pay an employee in
                                                terms
                                                of
                                                section 22 if the employee has been absent from work for more than two
                                                consecutive days or on more than two occasions during an eight-week
                                                period and, on request by the employer. does not produce a medical
                                                certificate stating that the employee was unable to work for the
                                                duration of the employee’s absence on account of sickness or injury.
                                            </p>
                                            <p class="mt-4 ml-3">If it is not reasonably practicable for an employee who
                                                lives on the employer’s premises to obtain a medical certificate, the
                                                employer may not withhold payment in terms of subsection (1) unless
                                                the employer provides reasonable assistance to the employee to obtain
                                                the certificate.
                                            </p>
                                            <h6 class="mt-3 mb-1 ml-3">Additional:</h6>
                                            <p class="mt-4 ml-3">For employees who work a five-day week, this will
                                                amount to 30 days’ sick leave for every 36 months or three years in
                                                employment. Employees who work a six-day week will be entitled to 36
                                                days’ sick leave over a period of 36 months or three years.
                                            </p>
                                            <p class="mt-4 ml-3">Employers must note that the sick leave is not 10 days
                                                per year, or 12 days per year, or 0, 83 days per month. It is 30 days
                                                (or 36 days) in every three-year cycle.
                                            </p>
                                            <p class="mt-4 ml-3">On the first working day of month number 7, the balance
                                                of the full entitlement kicks in and is available to the employee. The
                                                employee can use those sick leave days at any time required over the
                                                next 2,5 years, or if it is the second cycle, over the next 3 years.
                                            </p>

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
                            <label class="form-check-label d-inline p-2" for="study">
                                <input type="checkbox" class="form-check-input" id="study" name="study">
                                Study Leave
                            </label>
                            <!-- Button trigger modal Study Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#studyLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Leave Leave -->
                            <div class="modal fade" id="studyLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalStudyLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableMaternity" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="studyLeave">Study Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3 ml-3">Labour legislation there isn't any provision-it does
                                                notexist. Therefore, if the employee has such a requirement, he must
                                                apply for paid Annual leave in accordance with the employer’s Annual
                                                leave policy.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
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
                            </label>
                            <!-- Button trigger modal Sick Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#maternityLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Leave Leave -->
                            <div class="modal fade" id="maternityLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalMaternityLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableMaternity" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="maternityLeave">Maternity Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3 ml-3">Is paid leave.</h6>
                                            <p class="mt-4 ml-3 mb-4">These benefits are paid under UIF Act. A
                                                worker contributing to UIF is eligible for a maternity benefit of
                                                38% to 60% of avg. earnings in the last six months, depending on the
                                                insured person's level of income. Maternity is paid for a total
                                                17.32 weeks.
                                            </p>
                                            <ul>
                                                <li>
                                                    4 Months unpaid - Starting a month before the birth of
                                                    a child.
                                                </li>
                                                <li>
                                                    Annual leave continues to accrue to the employee during
                                                    a period of maternity leave, whether such period of maternity leave
                                                    is paid leave or unpaid leave.
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
                            <label class="form-check-label d-inline p-2" for="family">
                                @if ($family === 'on')
                                <input type="checkbox" class="form-check-input" id="family" name="family" checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="family" name="family"
                                    {{ old('family') ? 'checked' : '' }}>
                                @endif
                                Family Responsibility Leave
                            </label>
                            <!-- Button trigger modal Family-->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#familyLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Leave Leave -->
                            <div class="modal fade" id="familyLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalFamilyLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableSick" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="familyLeave">Family Responsibility
                                                Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mb-3 ml-3">Only an employee who has worked for longer than four
                                                months for the same employer and who is 5 days in an employee’s
                                                employment year, based on starting date. Employed on more than four
                                                days per week with the same employer qualifies for family
                                                responsibility leave.</p>
                                            <p class="mt-4 mb-1 ml-3"><strong>Covers:</strong>
                                                <ul>
                                                    <li>Employee's child is born.</li>
                                                    <li>Employee's child or adoptive child is sick.</li>
                                                    <li>Death of the employer's spouse or life partner,
                                                        parents, adoptive parents, grandchild, grandparents, siblings.
                                                    </li>
                                                </ul>
                                            </p>

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
                            </label>
                            <!-- Button trigger modal Commisioning Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#commisioningLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Leave Leave -->
                            <div class="modal fade" id="commisioningLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalCommisionLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableSick" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="commisioningLeave">Commisioning
                                                Types
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3 ml-3">Relates to surrogate motherhood.</h6>
                                            <p class="mt-4 ml-3">
                                                <ul>
                                                    <li class="mb-1">10 consecutive weeks leave for Primary
                                                        commissioning
                                                        parent.
                                                    </li>
                                                    <li class="mb-1">
                                                        If there are 2 Commissioning Parents – 1 gets 10 weeks the
                                                        other gets normal 10 days parental leave.
                                                    </li>
                                                    <li class="mb-1">
                                                        Leave commences on the date of the birth of the child.
                                                    </li>
                                                    <li class="mb-1">
                                                        1 month written notice to an employer of the date leave
                                                        will commence & the employee will return.
                                                    </li>
                                                    <li class="mb-1">
                                                        Entitled to UIF if parent contributed to the fund during
                                                        the 13 weeks before applying for the benefit.
                                                    </li>
                                                </ul>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
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
                            </label>
                            <!-- Button trigger modal Sick Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#adoptionLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Adoption Leave Leave -->
                            <div class="modal fade" id="adoptionLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalAdoptionLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableSick" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="adoptionLeave">Adoption Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3 ml-3">Relates to the adoptive mother.</h6>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        10 Consecutive weeks for a child below the age of 2.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        If there are 2 adoptive parents 1 gets 10 weeks the other
                                                        normal 10 days parental leave. The parents will have to decide.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Single adoptive parent – entitled to 10 consecutive weeks.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Leave commences on the day that the adoption order is
                                                        granted or the day that a competent court places the child in
                                                        the care
                                                        of a prospective adoptive parent.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        No calculation – Unpaid leave.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Can only claim UIF if the individual contributed to the
                                                        fund for 13 weeks before applying for such benefit.
                                                    </li>
                                                </ul>
                                            </p>
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
                            <label class="form-check-label d-inline p-2" for="paternity">
                                @if ($paternity === 'on')
                                <input type="checkbox" class="form-check-input" id="paternity" name="paternity"
                                    checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="paternity" name="paternity"
                                    {{ old('paternity') ? 'checked' : '' }}>
                                @endif
                                Paternity Leave
                            </label>
                            <!-- Button trigger modal Paternity -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#paternityLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Paternity Leave -->
                            <div class="modal fade" id="paternityLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalPaternityLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableSick" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="paternityLeave">Paternity Leave
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="mb-3 ml-3">10 Consecutive days – Calendar days</h6>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Fathers, adoptive parents, surrogates are entitled to 10
                                                        days of unpaid leave when their children are born.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Irrespective of gender (same-sex parents)
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Commence on the day that the child is born
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        Entitled to UIF if parent contributed to the fund during
                                                        the 13 weeks before applying for the benefit.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        The male employee will have to adduce proof of him being
                                                        the father of the child – BC with his name on.
                                                    </li>
                                                </ul>
                                            </p>
                                            <p class="mt-4">
                                                <ul>
                                                    <li>
                                                        1 month written notice to an employer of the date leave
                                                        will commence & the employee will return.
                                                    </li>
                                                </ul>
                                            </p>
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
                            <label class="form-check-label d-inline p-2" for="public">
                                @if ($public === 'on')
                                <input type="checkbox" class="form-check-input" id="public" name="public" checked="">
                                @else
                                <input type="checkbox" class="form-check-input" id="public" name="public"
                                    {{ old('public') ? 'checked' : '' }}>
                                @endif
                                Public Holidays
                            </label>
                            <!-- Button trigger modal Public Leave -->
                            <button type="button" class="btn btn-xs mt-n2 float-right mr-5" data-toggle="modal"
                                data-target="#publicLeave">
                                <div><i class="link-icon-2" width="20px" justify-content-end data-feather="info"></i>
                                </div>
                            </button>
                            <!-- Modal Sick Leave Leave -->
                            <div class="modal fade" id="publicLeave" tabindex="-1" role="dialog"
                                aria-labelledby="ModalPublicLeave" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollableSick" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="publicLeave">Public Holidays
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="ml-3">When an employee is on Annal leave and a Public Holiday
                                                falls on a working day the employee is entitled to an extra day annual
                                                leave for each such Public Holiday. </p>

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
