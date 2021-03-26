<!-- app/views/user/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Create User Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New User</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model(new App\Models\User, ['route' => ['storeUser']]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', Request::old('name'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('surname', 'Surname') !!}
                        {!! Form::text('surname', Request::old('surname'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('role_id', 'User role') !!}
                        <select class="form-control input-sm" required name="role_id" id="role_id">
                            <option value="">Select User Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('company_id', 'Company Name') !!}
                        <select class="form-control input-sm" required name="company_id" id="company_id">
                            <option value="">Select Company Name</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', Request::old('email'), array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        {!! Form::password('password', array('class' => 'form-control input-sm', 'required')) !!}
                    </div>

                    @auth()
                        <a href="{!!URL::route('users')!!}" class="btn btn-info" role="button">Cancel</a>
                    @else
                        <a href="{!!URL::previous()!!}" class="btn btn-info" role="button">Back</a>
                    @endif
                    {!! Form::submit('Create', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection