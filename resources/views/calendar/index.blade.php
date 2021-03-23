<!-- app/views/calendar/index.blade.php -->

@extends('layout/layout')

@section('content')
    <html lang="en">
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>

        <style>
            /* ... */
        </style>
        <div class="panel-heading">
            <h4>Leave Taken</h4>
        </div>
    </head>
    <body>
    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
    </body>
@endsection