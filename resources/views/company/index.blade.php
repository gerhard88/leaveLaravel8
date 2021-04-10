<!-- app/views/company/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Company Form... -->

<!-- Current Companies -->

<div class="row my-6 mx-6">

    <div class="col-md-12 grid-margin  stretch-card">
        @if (!app('request')->input('company_id') )
        <div id="companyDiv" class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Companies</h4>
                <a href="company/add" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add Company</a>
            </div>

            <div class="card-body">
                <table class="table" id="dataTable">
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
                                    {!! Form::model($company, ['method' => 'GET', 'route' => ['editCompany',
                                    $company->companyId]]) !!}
                                    <button type="submit" class="btn btn-sm btn-warning">Edit </button>
                                    <a href="{!!URL::route('destroyCompany', ['id' => $company->companyId])!!}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure about deleting the company?');">Delete</a>
                                    @auth()
                                    <a href="{!!URL::route('deptsCompany', ['id' => $company->companyId])!!}"
                                        class="btn btn-sm btn-secondary">Departments</a>
                                    <a href="{!!URL::route('teamsCompany', ['id' => $company->companyId])!!}"
                                        class="btn btn-sm btn-info">Teams</a>
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
        @endif
    </div>
</div>


@endsection
