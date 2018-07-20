@extends('layouts.auth') 

@section('tabTitle', 'Login') 

@section('body')


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="fullPage panel panel-default">
            <div class="panel-heading">Admin Login</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-5 control-label">E-Mail Address</label>

                        <div class="col-md-3">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-5 control-label">Password</label>

                        <div class="col-md-3">
                            <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old( 'remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection