<!-- app/views/employee/index.blade.php -->

@extends('layout/layout')

<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css" type="text/javascript"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js" type="text/javascript"></script>

@section('content')
    <!-- List Employee Form... -->

    <!-- Current Employees -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Current Employees</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="employee/add" role="button" class="btn btn-default">Add Employee</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="display nowrap" id="dataTable">
                    @if (count($employeesArray) > 0)

                        <!-- Table Headings -->
                        <thead>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Employee No</th>
                            <th>Date of Birth</th>
                            <th>ID No</th>
                            <th>Gender</th>
                            <th>Contact No</th>
                            <th>Email Address</th>
                            <th>Start Date</th>
                            <th>Occupation</th>
                            <th>Employee Type</th>
                            <th width="*">Action</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($employeesArray as $employee)
                                <tr>
                                    <!-- Name -->
                                    <td class="table-text">
                                        <div>{{ $employee->name }}</div>
                                    </td>
                                    <!-- Surname -->
                                    <td class="table-text">
                                        <div>{{ $employee->surname }}</div>
                                    </td>
                                    <!-- Employee No -->
                                    <td class="table-text">
                                        <div>{{ $employee->employeeNo }}</div>
                                    </td>
                                    <!-- Date of Birth -->
                                    <td class="table-text">
                                        <div>{{ $employee->dateOfBirth }}</div>
                                    </td>
                                    <!-- ID No -->
                                    <td class="table-text">
                                        <div>{{ $employee->idNo }}</div>
                                    </td>
                                    <!-- Gender -->
                                    <td class="table-text">
                                        <div>{{ $employee->gender }}</div>
                                    </td>
                                    <!-- Contact No -->
                                    <td class="table-text">
                                        <div>{{ $employee->contactNo }}</div>
                                    </td>
                                    <!-- Email Address -->
                                    <td class="table-text">
                                        <div>{{ $employee->emailAddress }}</div>
                                    </td>
                                    <!-- Start Date -->
                                    <td class="table-text">
                                        <div>{{ $employee->startDate }}</div>
                                    </td>
                                    <!-- Occupation -->
                                    <td class="table-text">
                                        <div>{{ $employee->occupation }}</div>
                                    </td>
                                    <!-- Type of Worker -->
                                    <td class="table-text">
                                        <div>{{ $employee->employeeType }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::model($employee, ['method' => 'GET', 'route' => ['editEmployee', $employee->id]]) !!}
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                            <a href="{!!URL::route('addLeave', ['id' => $employee->id])!!}" class="btn btn-warning">Apply Leave</a>
                                            <a href="{!!URL::route('destroyEmployee', ['id' => $employee->id])!!}" class="btn btn-danger"
                                               onclick="return confirm('Are you sure about terminating the employee?')">Terminate</a>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <div class="alert alert-info" role="alert">No employees are available</div>
                    @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "scrollX": true,
                "fixedColumns": true
            });
        });
    </script>
@endsection