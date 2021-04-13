<!-- app/views/calendar/index.blade.php -->

@extends('layout/layout')

@section('content')

<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css" />

    <style>
        /* ... */
    </style>

</head>

<body>

    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="container-fluid mt-2 w-100">
                    <h4 class="float-left mt-4 ml-2">Leave Taken</h4>
                    <a href="{!!URL::route('employees')!!}" class="btn btn-primary btn-sm mt-3 float-right"
                        role="button"><i data-feather="corner-up-left" class="mr-2 icon-md"></i>Leave App</a>
                </div>

                <div class="card-body">

                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}

                </div>

            </div>
        </div>
    </div>


</body>



@endsection
