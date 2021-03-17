<!-- app/views/company/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Company Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Company {!! $company->name !!}</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($company, array('route' => array('updateCompany', $company->id), 'files'=>true, 'method' => 'PATCH')) !!}

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', $company->name, array('class' => 'form-control', 'required')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('country_id', 'Country Name') !!}
                            <select class="form-control input-sm" name="country_id">
                                @foreach($countries as $country)
                                    @if($country['id'] == $cid)
                                        <option value="{{$country['id']}}" selected="{{$cid}}">{{$country['name']}}</option>
                                    @else
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('companies')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                        {!! Form::close() !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection