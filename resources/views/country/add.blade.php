<!-- app/views/country/add.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create Country Form... -->


<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Add New Country</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model(new App\Models\Country, ['route' => ['storeCountry']]) !!}

                <div class="col-sm-8 pb-3">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                    </div>
                </div>
                @auth()
                <a href="{!!URL::route('countries')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                @else
                <a href="{!!URL::previous()!!}" class="btn btn-sm btn-info" role="button">Back</a>
                @endif
                {!! Form::submit('Add', array('class' => 'btn btn-sm btn-primary')) !!}
                {!! Form::close() !!}
            </div>

        </div>

    </div>

</div>



@endsection
