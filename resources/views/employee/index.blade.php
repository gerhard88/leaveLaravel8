<!-- app/views/employee/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Employee Form... -->

<!-- Current Employees -->



<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Current Employees</h4>

                <a href="employee/add" class="btn btn-primary btn-sm mt-3 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add Employee</a>
            </div>
            <div class="card-body">

                <table class="display nowrap" id="dataTable" style="width:100%">
                    @if (count($employeesArray) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Employee No</th>
                        <th>Surname</th>
                        <th>Name</th>
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
                            <!-- Employee No -->
                            <td class="table-text">
                                <div>{{ $employee->employeeNo }}</div>
                            </td>
                            <!-- Surname -->
                            <td class="table-text">
                                <div>{{ $employee->surname }}</div>
                            </td>
                            <!-- Name -->
                            <td class="table-text">
                                <div>{{ $employee->name }}</div>
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
                                    {!! Form::model($employee, ['method' => 'GET', 'route' => ['editEmployee',
                                    $employee->id]]) !!}
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        Edit
                                    </button>
                                    <a href="{!!URL::route('addLeave', ['id' => $employee->id])!!}"
                                        class="btn btn-sm btn-warning">Apply Leave</a>
                                    <a href="{!!URL::route('destroyEmployee', ['id' => $employee->id])!!}"
                                        class="btn btn-sm btn-danger"
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
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            fixedColumns:   {
                leftColumns: 0,
                rightColumns: 1,
            }
        });
    });
</script>

@endsection


@push('plugin-scripts')


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
