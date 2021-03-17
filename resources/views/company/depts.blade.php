<!-- app/views/company/depts.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Departments linked to Company Form... -->

    <!-- Current Department -->

    <div class="row">
        @if (!app('request')->input('company_id') )
            <div id = "companyDiv" class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Departments at {{ $company->name }}</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{!!URL::route('companies') !!}" role="button" class="btn btn-default">Companies</a>
                                <a href="{!!URL::route('addDepartment')!!}" role="button" class="btn btn-default">Add Department</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" id="dataTable">
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
                                                {!! Form::model($department, ['method' => 'GET', 'route' => ['editDepartment', $department->id]]) !!}
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i> Edit </button>
                                                <a href="{!!URL::route('destroyDepartment', ['id' => $department->id])!!}" class="btn btn-danger"
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
                </div>
            </div>
        @endif
    </div>
@endsection