<!-- app/views/reports/sickLeave.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Sick Leave Form... -->

<!-- Sick Leave Balances -->

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Summary of Leave Request</h4>


            </div>

            <div class="card-body">
                <table class="table table-striped" id="dataTable">
                    @if (count($leaveSummaries) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Employee No</th>
                        <th>Surname</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration</th>
                        <th>Leave Type</th>
                        <th>Status</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($leaveSummaries as $summary)
                        <tr>
                            <!-- Employee No -->
                            <td class="table-text">
                                <div>{{ $summary->employeeNo }}</div>
                            </td>
                            <!-- Surname -->
                            <td class="table-text">
                                <div>{{ $summary->employeeSurname }}</div>
                            </td>
                            <!-- Name -->
                            <td class="table-text">
                                <div>{{ $summary->employeeName }}</div>
                            </td>
                            <!-- Start Date -->
                            <td class="table-text">
                                <div>{{ $summary->leaveStart }}</div>
                            </td>
                            <!-- End Date -->
                            <td class="table-text">
                                <div>{{ $summary->leaveEnd }}</div>
                            </td>
                            <!-- Duration -->
                            <td class="table-text">
                                <div>{{ $summary->duration }}</div>
                            </td>
                            <!-- Leave Type -->
                            <td class="table-text">
                                <div>{{ $summary->leaveType }}</div>
                            </td>
                            <!-- Leave Status -->
                            <td class="table-text">
                                <div>{{ $summary->leaveStatus }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <div class="alert alert-info" role="alert">No leave summaries are available</div>
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
