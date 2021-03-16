<!-- app/views/leave/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Leave Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Apply for Leave</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::open(array('route' => 'leave.store', 'method'=>'POST','files'=>true)) !!}

                    {!! Form::hidden('employee_id', Request::old('employee_id'), array('class' => 'form-control', 'required', 'id'=>'employee_id')) !!}

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('nameAuto', 'Name') !!}
                            {!! Form::text('nameAuto', Request::old('nameAuto'), array('class' => 'form-control', 'id'=> 'nameAuto')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('surname', 'Surname') !!}
                            {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control', 'id' => 'surname')) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::Label('leaveType_id', 'Leave Type') !!}
                            <select class="form-control" name="leaveType_id">
                                <option disabled selected hidden>Select Leave Type</option>
                                @foreach($leaveTypes as $leaveType)
                                    @if($leaveType['id'] == app('request')->input('leaveType'))
                                        <option value="{{$leaveType['id']}}" selected="{{$leaveType['id']}}">{{$leaveType['type']}}</option>
                                    @else
                                        <option value="{{$leaveType->id}}">{{$leaveType->type}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('start_date', 'Start Date') !!}
                                <input type="date" name="start_date" value="{{ old('start_date') }}" required id="start_date" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                {!! Form::label('end_date', 'End Date') !!}
                                <input type="date" name="end_date" value="{{ old('end_date') }}" required id="end_date" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('annualLeave')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $( function() {
            $( "#nameAuto" ).autocomplete({
                minLength: 2,
                dataType: 'text',
                source: function (request, response) {
                    $.ajax({
                        url: "{{URL('getNameData')}}",
                        data: {
                            nameAuto: jQuery("#nameAuto").val(),
                        },
                        error: function (data) { console.log('Error!'); },
                        success: function (data) {
                            response(JSON.parse(data));
                        }
                    });
                },
                focus: function( event, ui ) {
                    $( "#nameAuto" ).val( ui.item.label );
                    return false;
                },
                select: function( event, ui ) {
                    $( "#employee_id" ).val( ui.item.id );
                    $( "#nameAuto" ).val( ui.item.label );
                    $( "#surname" ).val( ui.item.name );
                    return false;
                }
            })
                    .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                        .append( "<div>" + item.label + " (t/a) " + item.name + "</div>" )
                        .appendTo( ul );
            };
        });
    </script>
@endsection