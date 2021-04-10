<!-- app/views/leaveType/add.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create LeaveType Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Add Leave Type</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::open(array('route' => 'storeLeaveType', 'method'=>'POST','files'=>true)) !!}

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('type', 'Leave Type') !!}
                        {!! Form::text('type', Request::old('type'), array('class' => 'form-control', 'required',
                        'autofocus')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('cycle_length', 'Cycle Length') !!}
                        {!! Form::text('cycle_length', Request::old('cycle_length'), array('class' => 'form-control',
                        'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('daysPerCycle', 'Days Per Cycle') !!}
                        {!! Form::text('daysPerCycle', Request::old('daysPerCycle'), array('class' => 'form-control',
                        'required')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <a href="{!!URL::route('leaveTypes')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-sm btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>


@endsection
