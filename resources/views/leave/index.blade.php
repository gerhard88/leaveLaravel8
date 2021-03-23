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
                    <table class="table table-striped" id="dataTable">
                    @if (count($leaveApplications) > 0)

                        <!-- Table Headings -->
                            <thead>
                            <th>Employee No</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th width="*">Action</th>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                            @foreach ($leaveApplications as $leave)
                                <tr>
                                    <!-- Employee No -->
                                    <td class="table-text">
                                        <div>{{ $leave->employeeNo }}</div>
                                    </td>
                                    <!-- Name -->
                                    <td class="table-text">
                                        <div>{{ $leave->name }}</div>
                                    </td>
                                    <!-- Surname -->
                                    <td class="table-text">
                                        <div>{{ $leave->surname }}</div>
                                    </td>
                                    <!-- Leave Type -->
                                    <td class="table-text>">
                                        <div>{{ $leave->leaveType }}</div>
                                    </td>
                                    <!-- Start Date -->
                                    <td class="table-text">
                                        <div>{{ $leave->start_date }}</div>
                                    </td>
                                    <!-- End Date -->
                                    <td class="table-text">
                                        <div>{{ $leave->end_date }}</div>
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            {!! Form::model($leave, ['method' => 'GET', 'route' => ['editLeave', $leave->leaveId]]) !!}
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                            <a href="{!!URL::route('approveLeave', $leave->leaveId)!!}" class="btn btn-warning">Approve</a>
                                            <a href="{!!URL::route('destroyLeave', ['id' => $leave->leaveId])!!}" class="btn btn-danger"
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