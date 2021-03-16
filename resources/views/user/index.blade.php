<!-- app/views/users/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Users Form... -->

    <!-- Current users -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Users</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="user/add" role="button" class="btn btn-default">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="dataTable">
                    @if (count($users) > 0)

                        <!-- Table Headings -->
                            <thead>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>User Role</th>
                            <th>Email Address</th>
                            <th>Action</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <!-- Name -->
                                    <td class="table-text">
                                        <div>{{ $user->name }}</div>
                                    </td>

                                    <!-- Surname -->
                                    <td class="table-text">
                                        <div>{{ $user->surname }}</div>
                                    </td>

                                    <!-- User Role -->
                                    <td class="table-text">
                                        @foreach($roles as $role)
                                            @if($role['id'] == $user->role_id)
                                                <option value="{{$role->id}}">{{$role->description}}</option>
                                            @endif
                                        @endforeach
                                    </td>

                                    <!-- User Email Address -->
                                    <td class="table-text">
                                        <div>{{ $user->email }}</div>
                                    </td>

                                    <td>
                                        <div>
                                            {!! Form::model($user, ['method' => 'GET', 'route' => ['editUser', $user->id]]) !!}
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else
                            <div class="alert alert-info" role="alert">No users are available</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection