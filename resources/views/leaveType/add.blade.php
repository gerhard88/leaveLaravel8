<!-- app/views/leaveType/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create LeaveType Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Leave Type</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::open(array('route' => 'storeLeaveType', 'method'=>'POST','files'=>true)) !!}

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('type', 'Leave Type') !!}
                            {!! Form::text('type', Request::old('type'), array('class' => 'form-control', 'required')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('cycle_length', 'Cycle Length') !!}
                            {!! Form::text('cycle_length', Request::old('cycle_length'), array('class' => 'form-control', 'required')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('daysPerCycle', 'Days Per Cycle') !!}
                            {!! Form::text('daysPerCycle', Request::old('daysPerCycle'), array('class' => 'form-control', 'required')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('leaveTypes')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close() !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection