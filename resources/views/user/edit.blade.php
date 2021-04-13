<!-- app/views/user/edit.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Edit User Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Update User: {!! $user->name !!} {!! $user->surname !!}</h4>
            </div>

            <div class="card-body">

                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['updateUser', $user->id]]) !!}

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $user->name, array('class' => 'form-control', 'required')) !!}
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('surname', 'Surname') !!}
                        {!! Form::text('surname', $user->surname, array('class' => 'form-control', 'required')) !!}
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('role_id', 'User role') !!}
                        <select class="form-control input-sm" required name="role_id" id="role_id">
                            @foreach($roles as $role)
                            @if($role['id'] == $user['role_id'])
                            <option value="{{$user['role_id']}}" selected="{{$user['role_id']}}">
                                {{$role['description']}}
                            </option>
                            @else
                            <option value="{{$role->id}}">{{$role->description}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('company_id', 'Company Name') !!}
                        <select class="form-control input-sm" required name="company_id" id="company_id">
                            @foreach($companies as $company)
                            @if($company['id'] == $user['company_id'])
                            <option value="{{$user['company_id']}}" selected="{{$user['company_id']}}">
                                {{$company['name']}}
                            </option>
                            @else
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', $user->email, array('class' => 'form-control', 'required')) !!}
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        <input class='form-control input-sm' type="password" required name="password" id="password"
                            value="{!!$user->password !!}">
                    </div>
                </div>
                <a href="{!!URL::route('users')!!}" class="btn btn-info" role="button">Cancel</a>
                {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                {!! Form::close() !!}

            </div>

        </div>
    </div>
</div>
@endsection
