<!-- app/views/company/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Company Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Company</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::open(array('route' => 'storeCompany', 'method'=>'POST','files'=>true)) !!}

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('country_id', 'Country Name') !!}
                            <select class="form-control" name="country_id">
                                <option disabled selected hidden>Select Country</option>
                                @foreach($countries as $country)
                                    @if($country['id'] == app('request')->input('country_id'))
                                        <option value="{{$country['id']}}" selected="{{$country['id']}}">{{$country['name']}}</option>
                                    @else
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('companies')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection