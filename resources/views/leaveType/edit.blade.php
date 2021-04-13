<!-- app/views/leavetype/edit.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Edit Leave type Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Update Leave type: {!! $leaveType->type !!}</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model($leaveType, array('route' => array('updateLeaveType', $leaveType->id), 'files'=>true,
                'method' => 'PATCH')) !!}

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('type', 'Leave Type') !!}
                        {!! Form::text('type', $leaveType->type, array('class' => 'form-control', 'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('cycle_length', 'Cycle Length') !!}
                        {!! Form::text('cycle_length', $leaveType->cycle_length, array('class' => 'form-control',
                        'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('daysPerCycle', 'Days Per Cycle') !!}
                        {!! Form::text('daysPerCycle', $leaveType->daysPerCycle, array('class' => 'form-control',
                        'required')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <a href="{!!URL::route('leaveTypes')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-sm btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>


@endsection
