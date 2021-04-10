<!-- app/views/department/add.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create Department Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Add New Department</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::open(array('route' => 'storeDepartment', 'method'=>'POST','files'=>true)) !!}

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('company_id', 'Company Name') !!}
                        <select class="form-control" name="company_id">
                            <option disabled selected hidden>Select Company</option>
                            @foreach($companies as $company)
                            @if($company['id'] == app('request')->input('company_id'))
                            <option value="{{$company['id']}}" selected="{{$company['id']}}">{{$company['name']}}
                            </option>
                            @else
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <a href="{!!URL::route('departments')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-sm btn-primary')) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>


@endsection
