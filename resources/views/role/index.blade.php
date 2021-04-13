<!-- app/views/role/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Role Form... -->

<!-- Current Roles -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">User Roles</h4>
                <a href="role/create" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add User Role</a>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="dataTable">
                    @if (count($roles) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th width="100%">User Role</th>
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
                                    <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-trash"></i></i>
                                        Edit
                                    </button>
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
</div>

@endsection
