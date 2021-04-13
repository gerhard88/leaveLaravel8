<!-- app/views/leaveType/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Leave type Form... -->

<!-- Current Leave types -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Leave Types</h4>
                <a href="leaveType/add" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add Leave type</a>
            </div>

            <div class="card-body">
                <table class="table" id="dataTable">
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
                                    {!! Form::model($leaveType, ['method' => 'GET', 'route' => ['editLeaveType',
                                    $leaveType->id]]) !!}
                                    <button type="submit" class="btn  btn-sm btn-warning">
                                        Edit
                                    </button>
                                    <a href="{!!URL::route('destroyLeaveType', ['id' => $leaveType->id])!!}"
                                        class="btn btn-sm btn-danger"
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



<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            fixedColumns:   {
                leftColumns: 3,
                rightColumns: 1
            }
        });
    });
</script>

@endsection



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
<link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
