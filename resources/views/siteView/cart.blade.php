@extends('layouts.dashboard') 

@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> 
@endsection 

@section('body')

<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini">
				<b>H</b>OME</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg">
				<b>Dash</b>Board</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- User Account Menu -->
					<li class="user user-menu">
						<!-- Menu Toggle Button -->
						<a>
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{Auth::user()->name}}</span>
						</a>
					</li>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu" data-widget="tree">
				<!-- Optionally, you can add icons to the links -->
				<li>
					<a href="/index">
						<i class="fas fa-home"></i>
						<span>Pharmacy</span>
					</a>
				</li>
				<li class="active">
					<a href="/home">
						<i class="fas fa-tachometer-alt"></i>
						<span>DashBoard</span>
					</a>
				</li>
				<li>
					<a href="/editAccountDetailsForm">
						<i class="fas fa-cogs"></i>
						<span>Account Details</span>
					</a>
				</li>
				<li>
					<a href="/viewAllOrders">
						<i class="fas fa-truck"></i>
						<span>Orders</span>
					</a>
				</li>
				<li class="active">
					<a href="/viewCart">
						<i class="fas fa-shopping-cart"></i>
						<span>Cart</span>
					</a>
				</li>
				<li>
					<a href="contactUsForm">
						<i class="fas fa-comment"></i>
						<span>Contact Admin</span>
					</a>
				</li>
				<li>
					<a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="fas fa-sign-out-alt"></i>
						<span>Logout</span>
					</a>

					<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		@if(Cart::count()==0)
		<section class="content-header">
			<h1>
				No Items in Cart
			</h1>
		</section>

		@else
		<section class="content-header">
			<h1>
				Your Cart
			</h1>
		</section>
		<!-- Main content -->
		<section class="content container-fluid">

			<!--------------------------
        | Your Page Content Here |
		-------------------------->
			<div class="container containerDashboardContent">
				<form action="/updateCart" method="post">
					{{csrf_field()}}
					<table>
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Product</th>
								<th scope="col">Seller</th>
								<th scope="col">Price</th>
								<th scope="col">Prescription</th>
								<th scope="col">Quantity</th>
								<th scope="col">Subtotal</th>
								<th scope="col">Remove</th>
							</tr>
						</thead>
						<tbody>
							<?php
    $i=1;
	?>
								@foreach(Cart::content() as $row)
								<tr>
									<td data-label="#">{{$i}}</td>
									<td data-label="Product">{{$row->name}}</td>
									<td data-label="Seller">
										<a href="{{'/pharmacyDetails/'.$row->options->pharmacistId}}">{{$row->options->pharmacistName}}</td>
									<td data-label="Price">{{$row->price}}</td>
									@if($row->options->prescription==0)
                						<!-- 0 = Not Required -->
                						<td data-label="prescription">Not Required</td>
                						@elseif($row->options->prescription==1)
                						<!-- 1 = Required -->
                						<td data-label="prescription">Required</td>
                					@endif
									<td data-label="Quantity">
										<input type="number" name="qty[]" max="99" min="1" maxlength="2" value="{{$row->qty}}" />
									</td>
									<td data-label="Subtotal">{{$row->total}}</td>
									<td data-label="Remove">
										<a href="{{'/removeFromCart/'.$row->rowId}}">
											<i class="fas fa-trash-alt" style="color:red"></i>
										</a>
									</td>
								</tr>
								<?php
      $i++;
      ?>
									@endforeach

									<tr>
										<td>
											<b>Total</b>
										</td>
										<td colspan="7">{{Cart::total()}}</td>
									</tr>

									<tr>
										<td colspan="2">
											<a href="/" class="btn btn-warning btn-block">
												<i class="fas fa-caret-left"></i> Continue Shopping</a>
										</td>
										<td colspan="4">
											<button type="submit" class="btn btn-info btn-block">
												<i class="fas fa-sync-alt"></i> UpdateCart</button>
										</td>
										<td colspan="2">
											<a href="{{'/prescriptionUploadForm'}}" class="btn btn-success btn-block">Checkout
												<i class="fas fa-caret-right"></i>
											</a>
										</td>
									</tr>
						</tbody>
					</table>
				</form>
			</div>
		</section>
		@endif
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2016
			<a href="#">Company</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->
@endsection