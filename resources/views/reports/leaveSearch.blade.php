<!-- app/views/reports/leaveSearch.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create Leave Search Form... -->

<div class="row">
    <div class="col-md-8 stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Leave Search</h4>
            </div>
            <div class="card-body">


                {!! HTML::ul($errors->all()) !!}

                {!! Form::open(array('route' => 'leaveSummary', 'method'=>'GET','files'=>true)) !!}

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label('nameAuto', 'Name') !!}
                        {!! Form::text('nameAuto', Request::old('nameAuto'), array('class' => 'form-control',
                        'id'=>'nameAuto', 'autofocus'))
                        !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('surname', 'Surname') !!}
                        {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control',
                        'id'=>'surname'))
                        !!}
                    </div>

                    <div class="form-group">
                        {!! Form::Label('leaveType_id', 'Leave Type') !!}
                        <select class="form-control input-sm allLeaveOption" required name="leaveType_id"
                            id="leaveType_id">
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
    </div>
</div>


@endsection
