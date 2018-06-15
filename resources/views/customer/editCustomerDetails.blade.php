@extends('layouts.customerDashboard')

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Account
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/editAccountDetails">
                    {{ csrf_field() }}
                    <fieldset>
                        <!-- Customer Name -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text" class="form-control" value="{{ $customerDetails->name }}" required>
                            </div>
                        </div>

                        <!-- Customer Email -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">E-mail</label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="email" class="form-control" value="{{ $customerDetails->email }}" required>
                            </div>
                        </div>

                        <!-- Customer Contact -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="contact">Contact#</label>
                            <div class="col-md-9">
                                <input id="contact" name="contact" type="text" class="form-control" minlength="11" maxlength="11" value="{{ $customerDetails->contact }}"
                                    required autofocus>
                            </div>
                        </div>

                        <!-- Customer House Address -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="address">House#-Block</label>
                            <div class="col-md-9">
                                <input id="address" name="address" type="text" class="form-control" value="{{ $customerDetails->address }}" required autofocus>
                            </div>
                        </div>

                        <!-- Customer Society -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="society">Society</label>
                            <div class="col-md-9">
                                <input id="society" name="society" type="text" class="form-control" value="{{ $customerDetails->society }}" required autofocus>
                            </div>
                        </div>

                        <!-- Customer City -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="city">City</label>
                            <div class="col-md-9">
                                <input id="city" name="city" type="text" class="form-control" value="{{ $customerDetails->city }}" required autofocus>
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 widget-right">
                                <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection