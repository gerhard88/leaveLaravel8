<!-- app/views/employee/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Employee Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Employee {!! $employee->name !!} {!! $employee->surname !!}</h3>
                </div>

                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($employee, array('route' => array('updateEmployee', $employee->id), 'files'=>true, 'method' => 'PATCH')) !!}

                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('surname', 'Surname') !!}
                                {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('employee_no', 'Employee No') !!}
                                {!! Form::text('employee_no', Request::old('employee_no'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('dob', 'Date of birth') !!}
                                {!! Form::date('dob', $employee->dob, array('class' => 'form-control', 'id' => 'dob')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('idType', 'ID Type') !!}
                                {!! Form::select('idType', array('RSA ID'=>'RSA ID', 'Passport/Foreign ID'=>'Passport/Foreign ID',
                                'Asylum Seeker"s Permit'=>'Asylum Seeker"s Permit', 'Refugee ID'=>'Refugee ID'), null, array('class'
                                => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('idNo', 'ID No') !!}
                                {!! Form::text('idNo', Request::old('idNo'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender') !!}
                                {!! Form::select('gender', array('Female'=>'Female', 'Male'=>'Male'), null, array('class'
                                => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('occupation', 'Occupation') !!}
                                {!! Form::text('occupation', Request::old('occupation'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('contact_no', 'Contact No') !!}
                                {!! Form::text('contact_no', Request::old('contact_no'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('start_date', 'Start Date') !!}
                                {!! Form::date('start_date', $employee->start_date, array('class' => 'form-control', 'id' => 'startDate')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('email', 'Email Address') !!}
                                {!! Form::text('email', Request::old('email'), array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::Label('employeeType_id', 'Employee Type') !!}
                                <select class="form-control input-sm" required name="employeeType_id" id="employeeType_id">
                                    @foreach($employeeTypes as $type)
                                        @if($type['id'] == $employee['employeeType_id'])
                                            <option value="{{$employee['employeeType_id']}}" selected="{{$employee['employeeType_id']}}">{{$type['employee_type']}}</option>
                                        @else
                                            <option value="{{$type->id}}">{{$type->employee_type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::Label('country_id', 'Country Name') !!}
                                <select class="form-control input-sm" required name="country_id" id="country_id">
                                    @foreach($countries as $country)
                                        @if($country['id'] == $employee['country_id'])
                                            <option value="{{$employee['country_id']}}" selected="{{$employee['country_id']}}">{{$country['name']}}</option>
                                        @else
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::Label('company_id', 'Company Name') !!}
                                <select class="form-control input-sm" required name="company_id" id="company_id">
                                    @foreach($companies as $company)
                                        @if($company['id'] == $employee['company_id'])
                                            <option value="{{$employee['company_id']}}" selected="{{$employee['company_id']}}">{{$company['name']}}</option>
                                        @else
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::Label('dept_id', 'Department Name') !!}
                                <select class="form-control input-sm" required name="dept_id" id="dept_id">
                                    @foreach($departments as $dept)
                                        @if($dept['id'] == $employee['dept_id'])
                                            <option value="{{$employee['dept_id']}}" selected="{{$employee['dept_id']}}">{{$dept['name']}}</option>
                                        @else
                                            <option value="{{$dept->id}}">{{$dept->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::Label('team_id', 'Team Name') !!}
                                <select class="form-control input-sm" required name="team_id" id="team_id">
                                    @foreach($teams as $team)
                                        @if($team['id'] == $employee['team_id'])
                                            <option value="{{$employee['team_id']}}" selected="{{$employee['team_id']}}">{{$team['name']}}</option>
                                        @else
                                            <option value="{{$team->id}}">{{$team->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('work_daysPerWeek', 'No of working days per week:') !!}
                                {!! Form::text('work_daysPerWeek', $work_daysPerWeek, array('class' => 'form-control', 'required')) !!}
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong><p>Employee Leave Types: <input type="checkbox" id="selectAll"></p></strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($annual === 'on')
                                        <input type="checkbox" name="annual" checked="">
                                    @else
                                        <input type="checkbox" name="annual" {{ old('annual') ? 'checked' : '' }} >
                                    @endif
                                    Annual Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($sick === 'on')
                                        <input type="checkbox" name="sick" checked="">
                                    @else
                                        <input type="checkbox" name="sick" {{ old('sick') ? 'checked' : '' }} >
                                    @endif
                                    Sick Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($study === 'on')
                                        <input type="checkbox" name="study" checked="">
                                    @else
                                        <input type="checkbox" name="study" {{ old('study') ? 'checked' : '' }} >
                                    @endif
                                    Study Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($maternity === 'on')
                                        <input type="checkbox" name="maternity" checked="">
                                    @else
                                        <input type="checkbox" name="maternity" {{ old('maternity') ? 'checked' : '' }} >
                                    @endif
                                    Maternity Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($unpaid === 'on')
                                        <input type="checkbox" name="unpaid" checked="">
                                    @else
                                        <input type="checkbox" name="unpaid" {{ old('unpaid') ? 'checked' : '' }} >
                                    @endif
                                    Unpaid Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($paternity === 'on')
                                        <input type="checkbox" name="paternity" checked="">
                                    @else
                                        <input type="checkbox" name="paternity" {{ old('paternity') ? 'checked' : '' }} >
                                    @endif
                                    Paternity Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($public === 'on')
                                        <input type="checkbox" name="public" checked="">
                                    @else
                                        <input type="checkbox" name="public" {{ old('public') ? 'checked' : '' }} >
                                    @endif
                                    Public Holidays
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <label>
                                    @if ($family === 'on')
                                        <input type="checkbox" name="family" checked="">
                                    @else
                                        <input type="checkbox" name="family" {{ old('family') ? 'checked' : '' }} >
                                    @endif
                                    Family Responsibility Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($commissioning === 'on')
                                        <input type="checkbox" name="commissioning" checked="">
                                    @else
                                        <input type="checkbox" name="commissioning" {{ old('commissioning') ? 'checked' : '' }} >
                                    @endif
                                    Commissioning Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($adoption === 'on')
                                        <input type="checkbox" name="adoption" checked="">
                                    @else
                                        <input type="checkbox" name="adoption" {{ old('adoption') ? 'checked' : '' }} >
                                    @endif
                                    Adoption Leave
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <label>
                                    @if ($covid === 'on')
                                        <input type="checkbox" name="covid" checked="">
                                    @else
                                        <input type="checkbox" name="covid" {{ old('covid') ? 'checked' : '' }} >
                                    @endif
                                    Covid Leave
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('employees')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                    </div>
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