<!-- app/views/country/edit.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Edit Country Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Update Department: {!! $country->name !!}</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model($country, ['method' => 'PATCH', 'route' => ['updateCountry', $country->id]]) !!}

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $country->name, array('class' => 'form-control', 'required')) !!}
                    </div>
                </div>

                <a href="{!!URL::route('countries')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                {!! Form::submit('Update', array('class' => 'btn btn-sm btn-primary')) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>


@endsection
