@extends('layouts.auth') 

@section('tabTitle', 'Register') 

@section('body')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="fullPage panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('pharmacist.register.store') }}">
                    {{ csrf_field() }} {{-- ---------------------------- Name ----------------------------- --}}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-5">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- Email ----------------------------- --}}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-5">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- Contact ----------------------------- --}}
                    <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                        <label for="contact" class="col-md-4 control-label">Contact</label>

                        <div class="col-md-5">
                            <input id="contact" type="text" class="form-control" name="contact" minlength="11" maxlength="11" value="{{ old('contact') }}"
                                required autofocus> @if ($errors->has('contact'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- Pharmacy Name ----------------------------- --}}
                    <div class="form-group{{ $errors->has('pharmacyName') ? ' has-error' : '' }}">
                        <label for="pharmacyName" class="col-md-4 control-label">Pharmacy Name</label>

                        <div class="col-md-5">
                            <input id="pharmacyName" type="text" class="form-control" name="pharmacyName" value="{{ old('pharmacyName') }}" required
                                autofocus> @if ($errors->has('pharmacyName'))
                            <span class="help-block">
                                <strong>{{ $errors->first('pharmacyName') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- Address ----------------------------- --}}
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">Address</label>

                        <div class="col-md-5">
                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus> @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- Society ----------------------------- --}}
                    <div class="form-group{{ $errors->has('society') ? ' has-error' : '' }}">
                        <label for="society" class="col-md-4 control-label">Society</label>

                        <div class="col-md-5">
                            <input id="society" type="text" class="form-control" name="society" value="{{ old('society') }}" required autofocus> @if ($errors->has('society'))
                            <span class="help-block">
                                <strong>{{ $errors->first('society') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- City ----------------------------- --}}
                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city" class="col-md-4 control-label">City</label>

                        <div class="col-md-5">
                            <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus> @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    {{-- ---------------------------- Max Purchase for Free Delivery ----------------------------- --}}
                    <div class="form-group{{ $errors->has('freeDeliveryPurchase') ? ' has-error' : '' }}">
                        <label for="freeDeliveryPurchase" class="col-md-4 control-label">Max Purchase for Free Delivery</label>

                        <div class="col-md-5">
                            <input id="freeDeliveryPurchase" type="text" class="form-control" name="freeDeliveryPurchase" value="{{ old('freeDeliveryPurchase') }}"
                                required autofocus> @if ($errors->has('freeDeliveryPurchase'))
                            <span class="help-block">
                                <strong>{{ $errors->first('freeDeliveryPurchase') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    {{-- ---------------------------- Password ----------------------------- --}}
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-5">
                            <input id="password" type="password" class="form-control" name="password" required> @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- ---------------------------- Confirm Password ----------------------------- --}}
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-5">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection