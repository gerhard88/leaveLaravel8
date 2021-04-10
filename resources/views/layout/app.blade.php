<!-- app/views/layout/layout.blade.php -->

<!DOCTYPE html>


<html lang="en">

<head>
    <title>Laravel Leave Web Application</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- end common css -->

    @stack('style')

    <!--Nzuki code-->
    {!! HTML::script(URL::to('/').'/js/custom.js') !!}

    {!! HTML::script(URL::to('/').'/jquery/jquery-1.12.4.js') !!}
    {!! HTML::script(URL::to('/').'/jquery/jquery-ui-1.12.1/jquery-ui.min.js') !!}
    {!! HTML::style(URL::to('/').'/jquery/jquery-ui-1.12.1/jquery-ui.min.css') !!}



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

    {!! HTML::script(URL::to('/').'/DataTables/media/js/jquery.dataTables.js') !!}
    {!! HTML::style(URL::to('/').'/DataTables/media/css/jquery.dataTables.min.css') !!}

    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') !!}
    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/buttons.print.min.js') !!}
    {!! HTML::style(URL::to('/').'/DataTables/extensions/Buttons/css/buttons.dataTables.min.css') !!}
    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/buttons.html5.js') !!}
    {!! HTML::script(URL::to('/').'/DataTables/extensions/Buttons/js/buttons.flash.js') !!}
    {!! HTML::script(URL::to('/').'/cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js') !!}

    {!! HTML::style(URL::to('/').'/bootstrap-select/css/bootstrap-select.css') !!}
    {!! HTML::script(URL::to('/').'/bootstrap-select/js/bootstrap-select.js') !!}

    <link href={!! URL::to('/') !!} +"/fullcalendar/css/fullcalendar.print.css" rel="stylesheet" media="print">

    <!-- Nzuki code stop-->

</head>

<body data-base-url="{{url('/')}}">

    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">
            @yield('content')
        </div>
    </div>



    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')
</body>

</html>
