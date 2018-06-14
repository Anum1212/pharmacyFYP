<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="{{ asset('css/dashboard/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('css/dashboard/datepicker3.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dashboard/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/table.css') }}" rel="stylesheet">
  @section('head') @show
  @section('style') @show

	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
  <![endif]-->
</head>
<body>
	@include('includes.error') @include('includes.message')
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					{{{ ucwords(trans(Auth::user()->name))  }}}
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		@section('searchBar')
			
		@show

		    <ul class="nav menu">
        <li class="{{{ (Request::is('dashboard') ? 'active' : '') }}}">
            <a href="/dashboard">
                <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li class="{{{ (Request::is('editAccountDetailsForm') ? 'active' : '') }}}">
            <a href="/editAccountDetailsForm">
                <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
        </li>
        <li class="{{{ (Request::is('viewAllOrders') ? 'active' : '') }}}">
            <a href="/viewAllOrders">
                <em class="fa fa-truck">&nbsp;</em> Orders</a>
        </li>
        <li class="{{{ (Request::is('viewCart') ? 'active' : '') }}}">
            <a href="/viewCart">
                <em class="fa fa-shopping-cart">&nbsp;</em> Cart</a>
        </li>
        <li class="{{{ (Request::is('contactUsForm') ? 'active' : '') }}}">
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
    </div><!--/.sidebar-->
    
    	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		@section('body') @show
		</div><!--/.row-->
  
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/chart.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/chart-data.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/easypiechart.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/easypiechart-data.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap-datepicker.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/custom.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/confirmDelete.js') }}"></script>
  
@section('script') @show
		
</body>
</html>