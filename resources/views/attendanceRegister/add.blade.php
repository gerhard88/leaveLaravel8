<!-- app/views/attendanceRegister/add.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- List Employee Register Form... -->

    <!-- Add hours for an employee -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h4>Employees Attendance Register</h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::open(array('route' => 'storeAttRegister', 'method'=>'POST','files'=>true), array('employeesRegisterArray' => $employeesRegisterArray)) !!}

                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <a href="{!!URL::route('paginateLeft', ['employeesRegisterArray' => $employeesRegisterArray, 'day1' => $day1, 'day2' => $day2,
                             'day3' => $day3, 'day4' => $day4, 'day5' => $day5, 'day6' => $day6, 'day7' => $day7])!!}" class="btn btn-default">&laquo;</a>
                            @if($paginateRight == 'Yes')
                                <td><input type="submit" value="&raquo;"/></td>
                            @endif
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ url('attendanceRegister/search') }}" role="button" class="btn btn-default">Filter</a>
                        </div>
                    </div>

                    <table class="table table-striped" id="dataTable">
                    @if (count($employeesRegisterArray) > 0)

                        <!-- Table Headings -->
                        <thead>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>Employee No</th>
                            <th>Employee Surname</th>
                            <th>Employee Name</th>
                            <th>Type of worker</th>
                            @if($day1 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day1)) }}</strong></th>
                            @endif
                            @if($day2 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day2)) }}</strong></th>
                            @endif
                            @if($day3 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day3)) }}</strong></th>
                            @endif
                            @if($day4 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day4)) }}</strong></th>
                            @endif
                            @if($day5 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day5)) }}</strong></th>
                            @endif
                            @if($day6 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day6)) }}</strong></th>
                            @endif
                            @if($day7 != null)
                                <th><strong>{{ date('D d-m-Y', strtotime($day7)) }}</strong></th>
                            @endif
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                            @foreach ($employeesRegisterArray as $employee)

                                <tr>
                                    <td><input type="checkbox"></td>

                                    <!-- Employee No -->
                                    <td class="table-text">
                                        <div>{{ $employee->employeeNo }}</div>
                                    </td>

                                    <!-- Employee Surname -->
                                    <td class="table-text">
                                        <div>{{ $employee->surname }}</div>
                                    </td>

                                    <!-- Employee Name -->
                                    <td class="table-text">
                                        <a href="{!!URL::route('editEmployee', ['id' => $employee->id])!!}">{{ $employee->name }}</a>
                                    </td>

                                    <!-- Employee Type -->
                                    <td class="table-text">
                                        <div>{{ $employee->employeeType }}</div>
                                    </td>

                                    <!-- Day1 -->
                                    @if($day1)
                                        <td class="table-text">
                                            <input type="text" required name="day1Register[]" value="{{ $employee->day1Reg }}" id="day1" class="form-control">
                                        </td>
                                    @endif

                                <!-- Day2 -->
                                    @if($day2)
                                        <td class="table-text">
                                            <input type="text" required name="day2Register[]" value="{{ $employee->day2Reg }}" id="day2" class="form-control">
                                        </td>
                                    @endif

                                <!-- Day3 -->
                                    @if($day3)
                                        <td class="table-text">
                                            <input type="text" required name="day3Register[]" value="{{ $employee->day3Reg }}" id="day3" class="form-control">
                                        </td>
                                    @endif

                                <!-- Day4 -->
                                    @if($day4)
                                        <td class="table-text">
                                            <input type="text" required name="day4Register[]" value="{{ $employee->day4Reg }}" id="day4" class="form-control">
                                        </td>
                                    @endif

                                <!-- Day5 -->
                                    @if($day5)
                                        <td class="table-text">
                                            <input type="text" required name="day5Register[]" value="{{ $employee->day5Reg }}" id="day5" class="form-control">
                                        </td>
                                    @endif

                                <!-- Day6 -->
                                    @if($day6)
                                        <td class="table-text">
                                            <input type="text" required name="day6Register[]" value="{{ $employee->day6Reg }}" id="day6" class="form-control">
                                        </td>
                                    @endif

                                <!-- Day7 -->
                                    @if($day7)
                                        <td class="table-text">
                                            <input type="text" required name="day7Register[]" value="{{ $employee->day7Reg }}" id="day7" class="form-control">
                                        </td>
                                    @endif
                                </tr>
                                {{ Form::hidden('employee_id[]', $employee->id) }}
                            @endforeach
                            {{ Form::hidden('day1', $day1) }}
                            {{ Form::hidden('day2', $day2) }}
                            {{ Form::hidden('day3', $day3) }}
                            {{ Form::hidden('day4', $day4) }}
                            {{ Form::hidden('day5', $day5) }}
                            {{ Form::hidden('day6', $day6) }}
                            {{ Form::hidden('day7', $day7) }}
                            <input type="hidden" id="empType" value="{{ $type }}">
                        </tbody>
                    @else
                        <div class="alert alert-info" role="alert">No employees are available</div>
                    @endif
                    </table>
                    <a href="{!!URL::route('searchAttRegister')!!}" class="btn btn-info" role="button">Cancel</a>
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#selectAll').click(function() {
            $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
            var x = document.getElementById("empType").value;
            if (x.toUpperCase() == 'SHIFT WORKER')
                var value = 'P';
            else
                var value = '8';
            if ($(this).prop("checked") == true) {
                $('#dataTable td:nth-child(6)').children("input").val(value);
                $('#dataTable td:nth-child(7)').children("input").val(value);
                $('#dataTable td:nth-child(8)').children("input").val(value);
                $('#dataTable td:nth-child(9)').children("input").val(value);
                $('#dataTable td:nth-child(10)').children("input").val(value);
                $('#dataTable td:nth-child(11)').children("input").val(value);
                $('#dataTable td:nth-child(12)').children("input").val(value);
            }
            else if ($(this).prop("checked") == false) {
                $('#dataTable td:nth-child(6)').children("input").val("");
                $('#dataTable td:nth-child(7)').children("input").val("");
                $('#dataTable td:nth-child(8)').children("input").val("");
                $('#dataTable td:nth-child(9)').children("input").val("");
                $('#dataTable td:nth-child(10)').children("input").val("");
                $('#dataTable td:nth-child(11)').children("input").val("");
                $('#dataTable td:nth-child(12)').children("input").val("");
            }
        });
    </script>
@endsection