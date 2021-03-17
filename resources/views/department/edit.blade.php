<!-- app/views/department/edit.blade.php -->

@extends('layout/layout')

@section('content')
    <!-- Edit Department Form... -->

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Update Department {!! $department->name !!}</h3>
                </div>
                <div class="panel-body">
                    <!-- if there are creation errors, they will show here -->
                    {!! HTML::ul($errors->all()) !!}

                    {!! Form::model($department, array('route' => array('updateDepartment', $department->id), 'files'=>true, 'method' => 'PATCH')) !!}

                    <div class="col-sm-4 col-md-4">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', $department->name, array('class' => 'form-control', 'required')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::Label('company_id', 'Company Name') !!}
                            <select class="form-control input-sm" name="company_id">
                                @foreach($companies as $company)
                                    @if($company['id'] == $did)
                                        <option value="{{$company['id']}}" selected="{{$did}}">{{$company['name']}}</option>
                                    @else
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="{!!URL::route('departments')!!}" class="btn btn-info" role="button">Cancel</a>
                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection