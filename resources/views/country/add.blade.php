<!-- app/views/country/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create Country Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New Country</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model(new App\Models\Country, ['route' => ['storeCountry']]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    @auth()
                        <a href="{!!URL::route('countries')!!}" class="btn btn-info" role="button">Cancel</a>
                    @else
                        <a href="{!!URL::previous()!!}" class="btn btn-info" role="button">Back</a>
                    @endif
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection