<!-- app/views/attendanceRegister/search.blade.php -->

@extends('layout/layout')

@section('content')

    <div class="panel panel-default">
        <div class="col-xs-6">
            <h5>Attendance Register Search</h5>
        </div>
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(array('route' => 'addAttRegister', 'method'=>'GET')) !!}
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::Label('dept_id', 'Departments') !!}
                            <select class="form-control input-sm selectpicker" name="dept_id" multiple>
                                @foreach($departments as $dept)
                                    <option value="{{$dept->id}}">{{$dept->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::Label('team_id', 'Teams') !!}
                            <select class="form-control input-sm selectpicker" name="team_id" multiple>
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::Label('employeeType_id', 'Employee Types') !!}
                            <select class="form-control" required id="employeeType_id" name="employeeType_id">
                                <option value="">Select Employee Type</option>
                                @foreach($employeeTypes as $type)
                                    <option value="{{$type->id}}" @if(old('employeeType_id') == $type->id) selected="selected"@endif>{{$type->employee_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            {!! Form::Label('start_date', 'Date Select') !!}
                            <input type="date" name="start_date" style = "width:100px !important cursor:hand !important" value="{{ old('start_date') }}" required id="start_date" class='form-control' />
                        </div>
                    </div>
                </div>
                {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        jQuery('.selectpicker').selectpicker({
            noneSelectedText:'Select All'
        });
    </script>
@endsection