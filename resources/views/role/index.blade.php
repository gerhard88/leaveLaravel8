<!-- app/views/role/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Role Form... -->

    <!-- Current Roles -->

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>User Roles</h4>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="role/create" role="button" class="btn btn-default">Add User Role</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped" id="dataTable">
                @if (count($roles) > 0)

                    <!-- Table Headings -->
                        <thead>
                        <th width="25%">User Role</th>
                        <th width="*">Action</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <!-- Role Description -->
                                <td class="table-text">
                                    <div>{{ $role->description }}</div>
                                </td>

                                <td>
                                    <div>
                                        {!! Form::model($role, ['method' => 'GET', 'route' => ['edit', $role->id]]) !!}
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    @else
                        <div class="alert alert-info" role="alert">No user roles are available</div>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection