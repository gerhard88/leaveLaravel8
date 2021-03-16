<!-- app/views/user/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit User Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-4 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update User {!! $user->name !!} {!! $user->surname !!}</h3>
                </div>

                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['updateUser', $user->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', $user->name, array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('surname', 'Surname') !!}
                        {!! Form::text('surname', $user->surname, array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('role_id', 'User role') !!}
                        <select class="form-control input-sm" required name="role_id" id="role_id">
                            @foreach($roles as $role)
                                @if($role['id'] == $user['role_id'])
                                    <option value="{{$user['role_id']}}" selected="{{$user['role_id']}}">{{$role['description']}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->description}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', $user->email, array('class' => 'form-control', 'required')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', 'Password') !!}
                        <input class = 'form-control input-sm' type = "password" required name="password" id="password" value= "{!!$user->password !!}" >
                    </div>
                    <a href="{!!URL::route('users')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection