<!-- app/views/reports/sickLeave.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Sick Leave Form... -->

<!-- Sick Leave Balances -->

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Employee Sick Leave Balances</h4>

                <a href="../leave/add" class="btn btn-primary btn-sm mt-3 float-right" role="button"><i
                        data-feather="plus-circle" class="mr-2 icon-md"></i>Capture Leave</a>
            </div>
            <div class="card-body">

                <table class="table table-striped" id="dataTable">
                    @if (count($annualLeaveBalances) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Employee No</th>
                        <th>Surname</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>Accumulated Leave Days</th>
                        <th>Days Taken</th>
                        <th>Days Remaining</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($annualLeaveBalances as $employee)
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
                            <!-- Start Date -->
                            <td class="table-text">
                                <div>{{ $employee->startDate }}</div>
                            </td>
                            <!-- Accumulated Leave Days -->
                            <td class="table-text">
                                <div>{{ $employee->accumulatedLeave }}</div>
                            </td>
                            <!-- Leave Days Taken -->
                            <td class="table-text">
                                <div>{{ $employee->daysTaken }}</div>
                            </td>
                            <!-- Leave Days Remaining -->
                            <td class="table-text">
                                <div>{{ $employee->daysRemaining }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <div class="alert alert-info" role="alert">No sick leave balances are available</div>
                    @endif
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
            $('#dataTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'print', 'excel',
                ],
            });
        });
</script>
@endsection
