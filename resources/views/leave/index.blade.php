<!-- app/views/leave/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Pending Leave Form... -->

    <!-- Current Pending leave -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Pending Leave Applications</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="display nowrap" id="dataTable">
                    @if (count($employees) > 0)

                        <!-- Table Headings -->
                            <thead>
                            <th>Employee No</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Days</th>
                            <th width="*">Action</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <!-- Employee No -->
                                    <td class="table-text">
                                        <div>{{ $employee->name }}</div>
                                    </td>
                                    <!-- Name -->
                                    <td class="table-text">
                                        <div>{{ $employee->surname }}</div>
                                    </td>
                                    <!-- Surname -->
                                    <td class="table-text">
                                        <div>{{ $employee->employeeNo }}</div>
                                    </td>
                                    <!-- Start Date -->
                                    <td class="table-text">
                                        <div>{{ $employee->dateOfBirth }}</div>
                                    </td>
                                    <!-- End Date -->
                                    <td class="table-text">
                                        <div>{{ $employee->idNo }}</div>
                                    </td>
                                    <!-- Total Leave Days -->
                                    <td class="table-text">
                                        <div>{{ $employee->idNo }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::model($employee, ['method' => 'GET', 'route' => ['editLeave', $employee->id]]) !!}
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                            <a href="{!!URL::route('approveLeave', $employee->id)!!}" class="btn btn-warning">Approve</a>
                                            <a href="{!!URL::route('destroyEmployee', ['id' => $employee->id])!!}" class="btn btn-danger"
                                               onclick="return confirm('Are you sure about cancelling leave?')">Cancel</a>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else
                            <div class="alert alert-info" role="alert">No employees with pending leave applications are available</div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection