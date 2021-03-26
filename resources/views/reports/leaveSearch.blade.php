<!-- app/views/reports/leaveSearch.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Leave Search Form... -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-6">
                    <h4>Leave Search</h4>
                </div>
            </div>
        </div>

        <div class="panel-body">

            {!! HTML::ul($errors->all()) !!}

            {!! Form::open(array('route' => 'leaveSummary', 'method'=>'GET','files'=>true)) !!}

            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {!! Form::label('nameAuto', 'Name') !!}
                    {!! Form::text('nameAuto', Request::old('nameAuto'), array('class' => 'form-control', 'id'=>'nameAuto')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('surname', 'Surname') !!}
                    {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control', 'id'=>'surname')) !!}
                </div>

                <div class = "form-group">
                    {!! Form::Label('leaveType_id', 'Leave Type') !!}
                    <select class="form-control input-sm allLeaveOption" required name="leaveType_id" id="leaveType_id">
                        <option disabled selected hidden>Select Leave Type</option>
                        @foreach($leaveTypes as $leaveType)
                            <option value="{{$leaveType->id}}"> {{$leaveType->type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection