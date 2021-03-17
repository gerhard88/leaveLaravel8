<!-- app/views/employeeType/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Employee Types Form... -->

    <!-- Current Countries -->
    <div class="row">
        <div id = "countryDiv" class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Employee Types</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="employeeType/add" role="button" class="btn btn-default">Add Employee Type</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="dataTable">
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
                                            {!! Form::model($type, ['method' => 'GET', 'route' => ['editEmployeeType', $type->id]]) !!}
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                            <a href="{!!URL::route('destroyEmployeeType', ['id' => $type->id])!!}" class="btn btn-danger"
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