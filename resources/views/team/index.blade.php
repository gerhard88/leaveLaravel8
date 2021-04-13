<!-- app/views/team/index.blade.php -->

@extends('layout/layout')

@section('content')
<!-- List Team Form... -->

<!-- Current Teams -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Current Teams</h4>
                <a href="team/add" class="btn btn-primary btn-xs mt-4 float-right" role="button"><i
                        data-feather="user-plus" class="mr-2 icon-md"></i>Add Team</a>
            </div>

            <div class="card-body">

                <table class="table" id="dataTable">
                    @if (count($teams) > 0)

                    <!-- Table Headings -->
                    <thead>
                        <th width="50%">Team</th>
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
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4 col-md-2">
                                        {!! Form::model($team, ['method' => 'GET', 'route' => ['editTeam', $team->id]])
                                        !!}
                                        <button type="submit" class="btn btn-sm btn-warning">
                                            Edit
                                        </button>
                                        <a href="{!!URL::route('destroyTeam', ['id' => $team->id])!!}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure about deleting the team?')">Delete</a>
                                        {!! Form::close() !!}
                                    </div>
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
</div>


@endsection
