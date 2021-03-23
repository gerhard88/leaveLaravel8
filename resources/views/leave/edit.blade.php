<!-- app/views/leave/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Leave Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Leave for {!! $employee->name !!} {!! $employee->surname !!}</h3>
                </div>

                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($leave, array('route' => array('updateLeave', $leave->id), 'files'=>true, 'method' => 'PATCH')) !!}

                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', $employee->name, array('class' => 'form-control', 'readonly')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('surname', 'Surname') !!}
                                {!! Form::text('surname', $employee->surname, array('class' => 'form-control', 'readonly')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::Label('leaveType_id', 'Leave Type') !!}
                                <select class="form-control input-sm" name="leaveType_id">
                                    @foreach($leaveTypes as $leaveType)
                                        @if($leaveType['id'] == $lid)
                                            <option value="{{$leaveType['id']}}" selected="{{$lid}}">{{$leaveType['type']}}</option>
                                        @else
                                            <option value="{{$leaveType->id}}">{{$leaveType->type}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('start_date', 'Start Date') !!}
                                    {!! Form::date('start_date', $leave->start_date, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {!! Form::label('end_date', 'End Date') !!}
                                    {!! Form::date('end_date', $leave->end_date, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('leaves')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection