<!-- app/views/leaveType/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Leave type Form... -->

    <!-- Current Leave types -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Leave Types</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="leaveType/add" role="button" class="btn btn-default">Add Leave type</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="dataTable">
                    @if (count($leaveTypes) > 0)

                        <!-- Table Headings -->
                        <thead>
                            <th width="25%">Leave type</th>
                            <th width="25%">Cycle length</th>
                            <th width="25%">Days Per Cycle</th>
                            <th width="*">Action</th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($leaveTypes as $leaveType)
                                <tr>
                                    <!-- Leave Type -->
                                    <td class="table-text">
                                        <div>{{ $leaveType->type }}</div>
                                    </td>

                                    <!-- Cycle Length -->
                                    <td class="table-text">
                                        <div>{{ $leaveType->cycle_length }}</div>
                                    </td>

                                    <!-- Days Per Cycle -->
                                    <td class="table-text">
                                        <div>{{ $leaveType->daysPerCycle }}</div>
                                    </td>

                                    <td>
                                        <div>
                                            {!! Form::model($leaveType, ['method' => 'GET', 'route' => ['editLeaveType', $leaveType->id]]) !!}
                                            <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                            <a href="{!!URL::route('destroyLeaveType', ['id' => $leaveType->id])!!}" class="btn btn-danger"
                                               onclick="return confirm('Are you sure about deleting the leave type?')">Delete</a>
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <div class="alert alert-info" role="alert">No leave types are available</div>
                    @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection