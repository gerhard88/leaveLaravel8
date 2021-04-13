<!-- app/views/company/add.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create Company Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Add New Company</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::open(array('route' => 'storeCompany', 'method'=>'POST','files'=>true)) !!}

                <div class="col-sm-8">
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
                            <option value="{{$country['id']}}" selected="{{$country['id']}}">{{$country['name']}}
                            </option>
                            @else
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    @auth()
                    <a href="{!!URL::route('companies')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                    @else
                    <a href="{!!URL::previous()!!}" class="btn btn-sm btn-info" role="button">Back</a>
                    @endif
                    {!! Form::submit('Add', array('class' => 'btn btn-sm btn-primary')) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>


@endsection
