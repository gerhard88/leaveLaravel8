<!-- app/views/company/teams.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Teams linked to Company Form... -->

    <!-- Current Teams -->

    <div class="row">
        @if (!app('request')->input('company_id') )
            <div id = "companyDiv" class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Teams at {{ $company->name }}</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{!!URL::route('companies') !!}" role="button" class="btn btn-default">Companies</a>
                                <a href="{!!URL::route('addTeam')!!}" role="button" class="btn btn-default">Add Team</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped" id="dataTable">
                        @if (count($teams) > 0)

                            <!-- Table Headings -->
                                <thead>
                                <th width="25%">Team</th>
                                <th width="*">Action</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                @foreach ($teams as $team)
                                    <tr>
                                        <!-- Team Name -->
                                        <td class="table-text">
                                            <div>{{ $team->name }}</div>
                                        </td>

                                        <td>
                                            <div>
                                                {!! Form::model($team, ['method' => 'GET', 'route' => ['editTeam', $team->id]]) !!}
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i> Edit </button>
                                                <a href="{!!URL::route('destroyTeam', ['id' => $team->id])!!}" class="btn btn-danger"
                                                   onclick="return confirm('Are you sure about deleting the team?')">Delete</a>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <div class="alert alert-info" role="alert">No teams are available</div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection