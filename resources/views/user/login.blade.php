<!-- app/views/user/login.blade.php -->

@extends('layout/app')

@section('content')

<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="mt-4 col-md-4 pr-md-4">
                        <img src="{{ url('assets\images\bmlogosm.png') }}" class="" alt=" 404">
                    </div>
                </div>
                <div class=" col-md-8 pl-md-0">
                    <div class="auth-form-wrapper px-4 py-3">
                        <h5 class="text-muted font-weight mb-4">Welcome back! Log in to your account.
                        </h5>
                        <div class="row ">
                            <div class="col-md-12">
                                @if ( session()->has('success') )
                                <div class="alert alert-success alert-dismissable" role="alert">
                                    {{ session()->get('success') }} <button type="button" class="close"
                                        data-dismiss="alert" aria-label="close">&times;</button></div>
                                @elseif ( session()->has('warning') )
                                <div class="alert alert-warning alert-dismissable">{{ session()->get('warning') }}</div>
                                @elseif ( session()->has('info') )
                                <div class="alert alert-info alert-dismissable">{{ session()->get('info') }}</div>
                                @elseif ( session()->has('danger') )
                                <div class="alert alert-danger alert-dismissable">{{ session()->get('danger') }}</div>
                                @endif
                                @yield('login')
                            </div>
                        </div>
                        <div class="form-group my-2">
                            {!! Form::open(array('url' => 'login')) !!}
                            {!! Form::label('email', 'Email Address') !!}
                            {{ Form::text('email', Request::old('email'), array('class' => 'form-control ', 'placeholder' => 'Email Address', 'autofocus')) }}
                        </div>
                        <div class="form-group my-2">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', array('class' => 'form-control input-sm',
                            'placeholder' =>
                            'Password')) !!}
                        </div>

                        <div class="mt-3">
                            {!! Form::submit('Login', array('class' => 'btn btn-primary mr-2 mb-2 mb-md-0')) !!}

                            {!! Form::close() !!}
                        </div>
                        <a href="{{ url('/auth/register') }}" class="d-block mt-3 pb-3 text-muted">Not a user?
                            Sign
                            up</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
