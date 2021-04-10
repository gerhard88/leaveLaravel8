<!-- app/views/country/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Country Form... -->

<!-- Current Countries -->

<div class="row my-6 mx-6">
    @if (!app('request')->input('country_id') )
    <div class="col-md-8 grid-margin  stretch-card">
        <div id="countryDiv" class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Countries</h4>
                <a href="country/add" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add Country</a>
            </div>

            <div class="card-body">
                <table class="table table" id="dataTable">
                    @if (count($countries) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th>Country</th>
                        <th width="*">Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($countries as $country)
                        <tr>
                            <!-- Country Name -->
                            <td class="table-text">
                                <div>{{ $country->name }}</div>
                            </td>

                            <td>
                                <div class="row">
                                    {!! Form::model($country, ['method' => 'GET', 'route' => ['editCountry',
                                    $country->id]]) !!}
                                    <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                                    <a href="{!!URL::route('destroyCountry', ['id' => $country->id])!!}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure about deleting the country?')">Delete</a>
                                    <a href="?country_id={{$country->id}}" role="button"
                                        class="btn btn-sm btn-warning">Companies</a>
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <div class="alert alert-info" role="alert">No countries are available</div>
                    @endif
                </table>
            </div>

        </div>
    </div>
    @endif
    @if ( app('request')->input('country_id'))
    <div class="col-md-8 grid-margin  stretch-card">
        <div id="countryDiv" class="card">
            <div class="container-fluid mt-2 w-100">
                @foreach ($countries as $country)
                @if($country->id == app('request')->query('country_id'))
                @php
                $name = $country->name;
                @endphp
                @endif
                @endforeach
                <h4 class="float-left mt-4 ml-2">Companies in {{ $name }}</h4>
                <a href="{!!URL::route('addCompany',array('country_id' => app('request')->input('country_id') )) !!}"
                    class="btn btn-primary btn-xs mt-4 float-right" role="button"><i data-feather="user-plus"
                        class="mr-2 icon-md"></i>Add Company</a>
                <a href="{!!URL::route('countries')!!}" class="btn btn-outline-primary btn-xs mt-4 mr-5 float-right"
                    role="button"><i data-feather="user-plus" class="mr-2 icon-md"></i>Countries</a>
            </div>

            <div class="card-body">
                <table class="table" id="dataTable">
                    @if (count($companies) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th width="50%">Company</th>
                        <th width="*">Action</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($companies as $company)
                        <tr>
                            <!-- Company Name -->
                            <td class="table-text">
                                <div>{{ $company->name }}</div>
                            </td>

                            <td>
                                <div>
                                    {!! Form::model($company, ['method' => 'GET', 'route' => ['editCompany',
                                    $company->id]]) !!}
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        Edit
                                    </button>
                                    <a href="{!!URL::route('destroyCompany', ['id' => $company->id])!!}"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure about deleting the company?')">Delete</a>
                                    @auth()
                                    <a href="{!!URL::route('deptsCompany', ['id' => $company->id])!!}"
                                        class="btn btn-sm btn-info">Departments</a>
                                    <a href="{!!URL::route('teamsCompany', ['id' => $company->id])!!}"
                                        class="btn btn-sm btn-info">Teams</a>
                                    @endauth
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
            <div class="col-md-12 pb-3">
                <a href="{!!URL::route('countries')!!}" class="btn btn-sm btn-primary" role="button">Back</a>
            </div>
        </div>

    </div>
    @endif


</div>


@endsection
