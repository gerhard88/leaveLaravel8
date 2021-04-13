<!-- app/views/company/depts.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Departments linked to Company Form... -->

<!-- Current Department -->

<div class="row my-6 mx-6">
    @if (!app('request')->input('company_id') )
    <div class="col-md-12 grid-margin stretch-card">
        <div id="companyDiv" class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Departments at {{ $company->name }}</h4>
                <a href="{!!URL::route('addDepartment')!!}" class="btn btn-primary btn-xs mt-4 float-right"
                    role="button"><i data-feather="user-plus" class="mr-2 icon-md"></i>Add Department</a>
                <a href="{!!URL::route('companies')!!}" class="btn btn-outline-primary btn-xs mt-4 mr-5 float-right"
                    role="button"><i data-feather="user-plus" class="mr-2 icon-md"></i>Companies</a>
            </div>

            <div class="card-body">
                <table class="table" id="dataTable">
                    @if (count($departments) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th width="25%">Department</th>
                        <th width="*">Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($departments as $department)
                        <tr>
                            <!-- Department Name -->
                            <td class="table-text">
                                <div>{{ $department->name }}</div>
                            </td>
                            <td>
                                <div>
                                    {!! Form::model($department, ['method' => 'GET', 'route' => ['editDepartment',
                                    $department->id]]) !!}
                                    <button type="submit" class="btn btn-sm btn-warning">Edit
                                    </button>
                                    <a href="{!!URL::route('destroyDepartment', ['id' => $department->id])!!}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure about deleting the department?')">Delete</a>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <div class="alert alert-info" role="alert">No departments are available</div>
                    @endif
                </table>
            </div>
            <div class="col-md-12 pb-3">
                <a href="{!!URL::route('companies')!!}" class="btn btn-sm btn-primary" role="button">Back</a>
            </div>

        </div>
    </div>
    @endif
</div>

@endsection
