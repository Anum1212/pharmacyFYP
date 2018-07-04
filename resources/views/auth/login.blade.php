@extends('layouts.authCustomer') 

@section('tabTitle', 'Login') 

@section('body')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="fullPage panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="" id="loginForm">
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
                        <label for="password" class="col-md-5 control-label">Login as</label>

                        <div class="col-md-3">
                        <label class="radio-inline">
                            <input type="radio" name="radioButton" value="1" onclick="login()" required>Customer
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="radioButton" value="2" onclick="login()" required>Pharmacist
                        </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a href="" id="type" data-toggle="modal" data-target="#forgotPassword" style="color:red">Forgotten Password?</a>
                            <br>
                            <br>
                            <p>Don't have account ? <a href="" id = "signup" data-toggle="modal" data-target="#register"> Sign Up Here</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>




  <!-- forgotPassword Modal -->
  <div class="modal" id="forgotPassword">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
                <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Are you a</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <a href="{{ route('password.request') }}">Customer?</a>
           <br>
           <br>
                    <a href="{{ route('pharmacist.password.request') }}">Pharmacist?</a>
        </div>
        
      </div>
    </div>
  </div>

  <!-- register Modal -->
  <div class="modal" id="register">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
                <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Register as</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           <a href="{{ route('register') }}">Customer?</a>
           <br>
           <br>
                    <a href="{{ route('pharmacist.register') }}">Pharmacist?</a>
        </div>
        
      </div>
    </div>
  </div>






<script>
        function login(){
        var x = $('input[name=radioButton]:checked').val();
        if(x == '1')
        $('#loginForm').attr('action', '{{ route("login") }}');
        if(x == '2')
        $('#loginForm').attr('action', '{{ route("pharmacist.login.submit") }}');
    }
    </script>
@endsection