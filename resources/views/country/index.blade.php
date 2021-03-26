<!-- app/views/country/index.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Country Form... -->

    <!-- Current Countries -->
    <div class="row">
        @if (!app('request')->input('country_id') )
            <div id = "countryDiv" class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Countries</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="country/add" role="button" class="btn btn-default">Add Country</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" id="dataTable">
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
                                                {!! Form::model($country, ['method' => 'GET', 'route' => ['editCountry', $country->id]]) !!}
                                                <button type="submit" class="btn btn-warning">Edit</button>
                                                <a href="{!!URL::route('destroyCountry', ['id' => $country->id])!!}" class="btn btn-danger"
                                                   onclick="return confirm('Are you sure about deleting the country?')">Delete</a>
                                                <a href="?country_id={{$country->id}}" role="button" class="btn btn-warning">Companies</a>
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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                @foreach ($countries as $country)
                                    @if($country->id == app('request')->query('country_id'))
                                        @php
                                            $name = $country->name;
                                        @endphp
                                    @endif
                                @endforeach
                                <h4 class="panel-title">Companies in  {{ $name }}</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{!!URL::route('countries') !!}" role="button" class="btn btn-default">Countries</a>
                                <a href="{!!URL::route('addCompany',array('country_id' => app('request')->input('country_id') )) !!}" role="button" class="btn btn-default">Add Company</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped" id="dataTable">
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
                                                {!! Form::model($company, ['method' => 'GET', 'route' => ['editCompany', $company->id]]) !!}
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i> Edit </button>
                                                <a href="{!!URL::route('destroyCompany', ['id' => $company->id])!!}" class="btn btn-danger"
                                                   onclick="return confirm('Are you sure about deleting the company?')">Delete</a>
                                                @auth()
                                                    <a href="{!!URL::route('deptsCompany', ['id' => $company->id])!!}" class="btn btn-info">Departments</a>
                                                    <a href="{!!URL::route('teamsCompany', ['id' => $company->id])!!}" class="btn btn-info">Teams</a>
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
                </div>
            </div>
        @endif
    </div>
@endsection