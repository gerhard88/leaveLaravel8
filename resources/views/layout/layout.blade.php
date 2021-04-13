<!-- app/views/layout/app.blade.php -->

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
    <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->

    @stack('plugin-styles')

    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}">
    <link href="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}">
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

    {!! HTML::style(URL::to('/').'/bootstrap-select/css/bootstrap-select.css') !!}
    {!! HTML::script(URL::to('/').'/bootstrap-select/js/bootstrap-select.js') !!}

    <link href={!! URL::to('/') !!} +"/fullcalendar/css/fullcalendar.print.css" rel="stylesheet" media="print">

    <!-- Nzuki code stop-->
    {!! HTML::script(URL::to('/').'//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') !!}
    {!! HTML::script(URL::to('/').'//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') !!}


</head>

<body data-base-url="{{url('/')}}">


    <script src="{{ asset('assets/js/spinner.js') }}"></script>

    <div class="main-wrapper" id="app">
        @include('layout.sidebar')
        <div class="page-wrapper">
            @include('layout.header')
            <div class="page-content">

                @if ( session()->has('success') )
                <div class="alert alert-success alert-dismissable" role="alert">{{ session()->get('success') }} <button
                        type="button" class="close" data-dismiss="alert" aria-label="close">&times;</button></div>
                @elseif ( session()->has('warning') )
                <div class="alert alert-warning alert-dismissable">{{ session()->get('warning') }}</div>
                @elseif ( session()->has('info') )
                <div class="alert alert-info alert-dismissable">{{ session()->get('info') }}</div>
                @elseif ( session()->has('danger') )
                <div class="alert alert-danger alert-dismissable">{{ session()->get('danger') }}</div>
                @endif


                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>






    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>

    <!-- end common js -->

    @stack('custom-scripts')




    <!-- Nzuki Body Code -->
    <script type='text/javascript'>
        //for editing companies on a selected country
    $("#country_id").on("change", function(e) { populateCompanies(); })
    function populateCompanies()
    {
        var val = $('#company_id').val();
        $('#company_id').find('option').remove().end();
        var country_id = $('#country_id option:selected').attr('value');
        var info = $.get("{{url('ajax-country-company')}}"+"/"+country_id);
        info.done(function(data) {
            $('#company_id').append('<option value="">None</option>');
            $.each(data,function(index,companyObj){
                $('#company_id').append('<option value="'+companyObj.id+'">'+companyObj.name+'</option>');
            });
            $('#company_id').val(val);
        });
        info.fail(function(){
        });
    }
    //for editing departments on a selected company
    $("#company_id").on("change", function(e) { populateDepartments(); })
    function populateDepartments()
    {
        var val = $('#dept_id').val();
        $('#dept_id').find('option').remove().end();
        var company_id = $('#company_id option:selected').attr('value');
        var info = $.get("{{url('ajax-company-department')}}"+"/"+company_id);
        info.done(function(data) {
            $('#dept_id').append('<option value="">None</option>');
            $.each(data,function(index,deptObj){
                $('#dept_id').append('<option value="'+deptObj.id+'">'+deptObj.name+'</option>');
            });
            $('#dept_id').val(val);
        });
        info.fail(function(){
        });
    }
    //for editing teams on a selected company
    $("#company_id").on("change", function(e) { populateTeams(); })
    function populateTeams()
    {
        var val = $('#team_id').val();
        $('#team_id').find('option').remove().end();
        var company_id = $('#company_id option:selected').attr('value');
        var info = $.get("{{url('ajax-company-team')}}"+"/"+company_id);
        info.done(function(data) {
            $('#team_id').append('<option value="">None</option>');
            $.each(data,function(index,teamObj){
                $('#team_id').append('<option value="'+teamObj.id+'">'+teamObj.name+'</option>');
            });
            $('#team_id').val(val);
        });
        info.fail(function(){
        });
    }
    </script>
    <!-- Nzuki Body Code End -->
</body>

</html>
