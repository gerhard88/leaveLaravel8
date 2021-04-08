<!-- app/views/employee/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Employee Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Employee</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model(new App\Models\Employee, ['route' => ['storeEmployee']]) !!}

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
                                <input type="date" name="dob" value="{{ old('dob') }}" required id="dob" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('idType', 'ID Type') !!}
                                {!! Form::select('idType', array('Select Type' => 'Select Type', 'RSA ID'=>'RSA ID',
                                'Passport/Foreign ID'=>'Passport/Foreign ID', 'Asylum Seeker"s Permit'=>'Asylum Seeker"s Permit',
                                'Refugee ID'=>'Refugee ID'), null,
                                array('class' => 'form-control')) !!}
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
                                {!! Form::select('gender', array('Select Gender' =>'Select Gender', 'Female'=>'Female', 'Male'=>'Male'), null, array('class' => 'form-control')) !!}
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
                                <input type="date" required name="start_date" value="{{ old('start_date') }}" required id="start_date" class="form-control">
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
                                {!! Form::label('employeeType_id', 'Employee Type') !!}
                                <select class="form-control" required name="employeeType_id" id="employeeType_id">
                                    <option value="">Select Employee Type</option>
                                    @foreach($employeeTypes as $type)
                                        <option value="{{$type->id}}" @if(old('employeeType_id') == $type->id) selected="selected"@endif>{{$type->employee_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::label('country_id', 'Country Name') !!}
                                <select class="form-control input-sm" required name="country_id" id="country_id">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" @if(old('country_id') == $country->id) selected="selected"@endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::label('company_id', 'Company Name') !!}
                                <select class="form-control input-sm" required name="company_id" id="company_id">
                                    <option value="{{ old('company_id') }}">Select Country First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::label('dept_id', 'Department Name') !!}
                                <select class="form-control input-sm" required name="dept_id" id="dept_id">
                                    <option value="{{ old('dept_id') }}">Select Company First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                {!! Form::label('team_id', 'Team Name') !!}
                                <select class="form-control input-sm" required name="team_id" id="team_id">
                                    <option value="{{ old('team_id') }}">Select Company First</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-md-3">
                            <strong><p>Please select no of working days per week:</p></strong>
                            <input type="radio" id="five" name="days" value="five">
                            <label for="five">Five working days</label><br>
                            <input type="radio" id="six" name="days" value="six">
                            <label for="six">Six working days</label><br>
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
                                <input type="checkbox" id="annual" name="annual">
                                <label for="annual"> Annual Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="sick" name="sick">
                                <label for="sick"> Sick Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="study" name="study">
                                <label for="study"> Study Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="maternity" name="maternity">
                                <label for="maternity"> Maternity Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="unpaid" name="unpaid">
                                <label for="unpaid"> Unpaid Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="paternity" name="paternity">
                                <label for="paternity"> Paternity Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="public" name="public">
                                <label for="public"> Public Holidays</label><br>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-3">
                            <div class="form-group">
                                <input type="checkbox" id="family" name="family">
                                <label for="family"> Family Responsibility Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="commissioning" name="commissioning">
                                <label for="commissioning"> Commissioning Leave</label><br>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <div class="form-group">
                                <input type="checkbox" id="adoption" name="adoption">
                                <label for="adoption"> Adoption Leave</label><br>
                            </div>
                        </div>
                    </div>
                    <a href="{!!URL::route('employees')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
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