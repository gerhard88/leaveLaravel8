<!-- app/views/employeeType/add.blade.php -->

@extends('layout/layout')

@section('content')
<!-- Create Employee Type Form... -->

<div class="row my-6 mx-6">
    <div class="col-md-8 grid-margin  stretch-card">
        <div class="card">
            <div class="container-fluid mt-2 w-100">
                <h4 class="float-left mt-4 ml-2">Add New Employee Type</h4>
            </div>

            <div class="card-body">
                <!-- if there are creation errors, they will show here -->
                {!! HTML::ul($errors->all()) !!}

                {!! Form::model(new App\Models\EmployeeType, ['route' => ['storeEmployeeType']]) !!}

                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('employee_type', 'Employee Type') !!}
                        {!! Form::text('employee_type', Request::old('employee_type'), array('class' => 'form-control',
                        'required', 'autofocus')) !!}
                    </div>
                </div>

                <a href="{!!URL::route('employeeTypes')!!}" class="btn btn-sm btn-info" role="button">Cancel</a>
                {!! Form::submit('Add', array('class' => 'btn btn-sm btn-primary')) !!}
                {!! Form::close() !!}


            </div>

        </div>
    </div>
</div>


@endsection
