<!-- app/views/employeeType/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Employee Types Form... -->

<!-- Current Countries -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Employee Types</h4>
                <a href="employeeType/add" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add Employee Type</a>
            </div>

            <div class="card-body">
                <table class="table" id="dataTable">
                    @if (count($employeeTypes) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th width="50%">Employee Type</th>
                        <th width="*">Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($employeeTypes as $type)
                        <tr>
                            <!-- Employee Type -->
                            <td class="table-text">
                                <div>{{ $type->employee_type }}</div>
                            </td>

                            <td>
                                <div class="row">
                                    {!! Form::model($type, ['method' => 'GET', 'route' => ['editEmployeeType',
                                    $type->id]]) !!}
                                    <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                                    <a href="{!!URL::route('destroyEmployeeType', ['id' => $type->id])!!}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure about deleting the employee type?')">Delete</a>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <div class="alert alert-info" role="alert">No employee types are available</div>
                    @endif
                </table>
            </div>

        </div>
    </div>
</div>



@endsection
