<!-- app/views/attendanceRegister/search.blade.php -->

@extends('layout/layout')

@section('content')


<div class="row">
    <div class="col-md-8 stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Attendance Register Search</h4>
                <a href="add" class="btn btn-primary btn-sm mt-3 float-right" role="button"><i
                        data-feather="plus-circle" class="mr-2 icon-md"></i>Add</a>
            </div>
            <div class="card-body">

                <!-- Row 1 Begin - Multiple Department Select -->
                <div class="row">
                    <!--Row Department Col -->
                    <div class="col-sm-6">
                        {!! Form::open(array('route' => 'addAttRegister', 'method'=>'GET')) !!}
                        <div class="form-group">
                            <label>Departments</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple">
                                @foreach($departments as $dept)
                                <option value="{{$dept->id}}">{{$dept->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Row 1 End -->

                <!-- Row 2 Begin - Multiple Teams Select -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::Label('team_id', 'Teams') !!}
                            <select class="js-example-basic-multiple w-100" multiple="multiple">
                                @foreach($teams as $team)
                                <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Row 2 End -->

                <!-- Row 3 Begin Employee Types -->
                <div class="row">
                    <!--Name Col -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::Label('employeeType_id', 'Employee Types') !!}
                            <select class="form-control" required id="employeeType_id" name="employeeType_id">
                                <option value="">Select Employee Type</option>
                                @foreach($employeeTypes as $type)
                                <option value="{{$type->id}}" @if(old('employeeType_id')==$type->id)
                                    selected="selected"@endif>{{$type->employee_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Row 3 End -->

                <!-- Row 3 Begin Date Select -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::Label('start_date', 'Date Select') !!}
                            <input type="date" name="start_date" style="width:100px !important cursor:hand !important"
                                value="{{ old('start_date') }}" required id="start_date" class='form-control' />
                        </div>
                    </div>
                </div>
                <!-- Row 3 End -->





                {!! Form::submit('Search', array('class' => 'btn btn-sm btn-primary')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


<script>
    jQuery('.selectpicker').selectpicker({
            noneSelectedText:'Select All'
        });
</script>
@endsection



@push('plugin-scripts')
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush

@push('plugin-styles')
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush
