<!-- app/views/users/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Users Form... -->

<!-- Current users -->

<!-- test users -->

<div class="row my-6 mx-6">
    <div class="col-md-12 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Current Users</h4>
                <a href="user/add" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add User</a>
            </div>


            <div class="card-body">

                <div class="table-responsive mt-5">
                    <table id="dataTableExample" class="table">

                        @if (count($users) > 0)
                        <!-- Table Headings -->
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>User Role</th>
                                <th>Email Address</th>
                                <th>Action</th>
                            </tr>
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
                                        {!! Form::model($user, ['method' => 'GET', 'route' => ['editUser',
                                        $user->id]]) !!}
                                        <button type="submit" class="btn btn-warning btn-sm"><i
                                                class="fa fa-trash"></i></i>
                                            Edit
                                        </button>
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
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
