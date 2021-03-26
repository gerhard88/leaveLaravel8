<!-- app/views/company/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Company Form... -->

    <!-- Current Companies -->

    <div class="row">
        @if (!app('request')->input('company_id') )
            <div id = "companyDiv" class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Companies</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="company/add" role="button" class="btn btn-default">Add Company</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" id="dataTable">
                        @if (count($currentCompanies) > 0)

                            <!-- Table Headings -->
                                <thead>
                                <th width="25%">Company</th>
                                <th width="25%">Country</th>
                                <th width="*">Action</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                @foreach ($currentCompanies as $company)
                                    <tr>
                                        <!-- Company Name -->
                                        <td class="table-text">
                                            <div>{{ $company->companyName }}</div>
                                        </td>

                                        <!-- Country Name -->
                                        <td class="table-text">
                                            <div>{{ $company->countryName }}</div>
                                        </td>

                                        <td>
                                            <div>
                                                {!! Form::model($company, ['method' => 'GET', 'route' => ['editCompany', $company->companyId]]) !!}
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></i> Edit </button>
                                                <a href="{!!URL::route('destroyCompany', ['id' => $company->companyId])!!}" class="btn btn-danger"
                                                   onclick="return confirm('Are you sure about deleting the company?');">Delete</a>
                                                @auth()
                                                    <a href="{!!URL::route('deptsCompany', ['id' => $company->companyId])!!}" class="btn btn-info">Departments</a>
                                                    <a href="{!!URL::route('teamsCompany', ['id' => $company->companyId])!!}" class="btn btn-info">Teams</a>
                                                @endauth()
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <div class="alert alert-info" role="alert">No companies are available</div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection