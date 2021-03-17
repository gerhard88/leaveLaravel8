<!-- app/views/leavetype/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Leave type Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Leave type {!! $leaveType->type !!}</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($leaveType, array('route' => array('updateLeaveType', $leaveType->id), 'files'=>true, 'method' => 'PATCH')) !!}

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('type', 'Leave Type') !!}
                            {!! Form::text('type', $leaveType->type, array('class' => 'form-control', 'required')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('cycle_length', 'Cycle Length') !!}
                            {!! Form::text('cycle_length', $leaveType->cycle_length, array('class' => 'form-control', 'required')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('daysPerCycle', 'Days Per Cycle') !!}
                            {!! Form::text('daysPerCycle', $leaveType->daysPerCycle, array('class' => 'form-control', 'required')) !!}
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('leaveTypes')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close() !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection