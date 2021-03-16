<!-- app/views/layout/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LEAVE</title>

    {!! HTML::script(URL::to('/').'/js/custom.js') !!}

    {!! HTML::script(URL::to('/').'/jquery/jquery-1.12.4.js') !!}
    {!! HTML::script(URL::to('/').'/jquery/jquery-ui-1.12.1/jquery-ui.min.js') !!}
    {!! HTML::style(URL::to('/').'/jquery/jquery-ui-1.12.1/jquery-ui.min.css') !!}

    {!! HTML::script(URL::to('/').'/bootstrap/js/bootstrap.js') !!}
    {!! HTML::style(URL::to('/').'/bootstrap/css/bootstrap.min.css') !!}

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

    <link href= {!! URL::to('/') !!} +"/fullcalendar/css/fullcalendar.print.css" rel="stylesheet" media="print">

    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            bottom: 0;
            background-color: #fffff;
            overflow-x: hidden;
            transition: 0.2s;
            padding-top: 40px;
        }
        .sidenav a {
            padding: 5px 5px 5px 20px;
            text-decoration: none;
            font-size: 12px;
            color: #818181;
            display: inline;
            transition: 0.3s;
        }
        .sidenav a:hover {
            color: #f1f1f1;
        }
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        .settbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 12px;
            border: none;
        }
        .settings {
            position: relative;
            display: inline-block;
        }
        .settings-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 140px;
            box-shadow: 0px 6px 12px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .settings-content a {
            color: black;
            padding: 10px 10px;
            text-decoration: none;
            display: block;
        }
        .settings-content a:hover {background-color: #ddd;}
        .settings:hover .settings-content {display: block;}
        .settings:hover .settbtn {background-color: #3e8e41;}
    </style>
</head>
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }
</script>
<body>
<div class="container-fluid">
    @if(!Auth::guest())
        <div class="row">
            <div class="col-md-12">
                <div style = "position: absolute;top: 0;left: 0;z-index: 1000;">
                    <!-- sidebar content -->
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        @include('layout.sidebar')
                    </div>
                    <div id="main">

                        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
                    </div>
                </div>

                <div class="header navbar">
                    @include('layout.header')
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            @if ( session()->has('success') )
                <div class="alert alert-success alert-dismissable" role="alert">{{ session()->get('success') }} <button type="button" class="close" data-dismiss="alert" aria-label="close">&times;</button></div>
            @elseif ( session()->has('warning') )
                <div class="alert alert-warning alert-dismissable">{{ session()->get('warning') }}</div>
            @elseif ( session()->has('info') )
                <div class="alert alert-info alert-dismissable">{{ session()->get('info') }}</div>
            @elseif ( session()->has('danger') )
                <div class="alert alert-danger alert-dismissable">{{ session()->get('danger') }}</div>
            @endif
            @yield('content')
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="footer">
                @include('layout.footer')
            </div>
        </div>
    </div>
</div>

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
</body>
</html>