@extends('layouts.dashboard') @section('head') @endsection @section('style') @endsection @section('body')
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index">
                <span>Lumino</span>Admin</a>
        </div>
    </div>
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <span class="capitalWord">{{Auth::user()->name}}</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">

        <li>
            <a href="/home">
                <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li class="active">
            <a href="/editAccountDetailsForm">
                <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
        </li>
        <li>
            <a href="/viewAllOrders">
                <em class="fa fa-truck">&nbsp;</em> Orders</a>
        </li>
        <li>
            <a href="/viewCart">
                <em class="fa fa-shopping-cart">&nbsp;</em> Cart</a>
        </li>
        <li>
            <a href="contactUsForm">
                <em class="fa fa-comment">&nbsp;</em> Contact Admin</a>
        </li>
        <li>
            <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <em class="fa fa-power-off">&nbsp;</em> Logout</a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!--/.row-->

    {{-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">File Managment</h1>
        </div>
    </div> --}}
    <!--/.row-->

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
										<input id="contact" name="contact" type="text" class="form-control" minlength="11" maxlength="11" value="{{ $customerDetails->contact }}" required autofocus>
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


</div>
<!--/.row-->
</div>
<!--/.main-->
@endsection @section('script') @endsection