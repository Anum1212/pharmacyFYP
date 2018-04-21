{{-- @extends('layouts.siteView') @section('style')

<style media="screen">
	.table>tbody>tr>td,
	.table>tfoot>tr>td {
		vertical-align: middle;
	}

	@media screen and (max-width: 600px) {
		table#cart tbody td .form-control {
			width: 20%;
			display: inline !important;
		}
		.actions .btn {
			width: 36%;
			margin: 1.5em 0;
		}

		.actions .btn-info {
			float: left;
		}
		.actions .btn-danger {
			float: right;
		}

		table#cart thead {
			display: none;
		}
		table#cart tbody td {
			display: block;
			padding: .6rem;
			min-width: 320px;
		}
		table#cart tbody tr td:first-child {
			background: #333;
			color: #fff;
		}
		table#cart tbody td:before {
			content: attr(data-th);
			font-weight: bold;
			display: inline-block;
			width: 8rem;
		}



		table#cart tfoot td {
			display: block;
		}
		table#cart tfoot td .btn {
			display: block;
		}

	}
</style>

@endsection @section('body')
<div class="container col-md-7" id="myWrapper">
	<div class="row">
		<div class="container col-md-6 col-md-offset-2" id="myWrapper3">
			<form action="/updateCart" method="post">
				<table id="cart" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:50%">Seller</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
						@foreach(Cart::content() as $row)
						<tr>
							<td data-th="Product">
								<div class="row">

									<h4 class="nomargin">{{$row->name}}</h4>
								</div>
		</div>
		</td>
		<td data-th="Seller">
			<h4 class="nomargin">
				<a href="{{'/pharmacyDetails/'.$row->options->pharmacistId}}">{{$row->options->pharmacistName}}</h4>
	</div>
	</td>
	<td data-th="Price">{{$row->price}}</td>
	<td data-th="Quantity">
		{{csrf_field()}}
		<input type="number" name="qty[]" max="99" min="1" maxlength="2" value="{{$row->qty}}" />
	</td>
	<td data-th="Subtotal" class="text-center">{{$row->total}}</td>

	</td>
	</tr>
	@endforeach
	</tbody>
	<tfoot>
		<tr class="visible-xs">
			<td class="text-center">
				<strong>Total {{Cart::total()}}</strong>
			</td>
		</tr>
		<tr>
			<td class="hidden-xs text-center">
				<strong>Total</strong>
			</td>
			<td colspan="2" class="hidden-xs"></td>
			<td class="hidden-xs text-center">
				<strong>{{Cart::total()}}</strong>
			</td>
		</tr>

		<tr>
			<td>
				<a href="/" class="btn btn-warning">
					<i class="fa fa-angle-left"></i> Continue Shopping</a>
			</td>
			<td>
				<button type="submit" class="btn btn-info btn-block">
					<i class="fa fa-refresh"></i> UpdateCart</button>
			</td>
			<td>
				<a href="{{'/CheckOutCart'}}" class="btn btn-success btn-block">Checkout
					<i class="fa fa-angle-right"></i>
				</a>
			</td>
			<td colspan="1" class="hidden-xs"></td>

		</tr>
	</tfoot>
	</table>
	</form>
</div>

<div class="container col-md-2" id="myWrapper4">
	<table id="cart" class="table table-hover table-condensed">
		<thead>
			<tr>
				<th style="width:10%">Remove</th>
			</tr>
		</thead>
		<tbody>
			@foreach(Cart::content() as $row)
			<tr style="height:50px;">
				<td data-th="Remove">
					<form action="{{'/removeFromCart/'.$row->rowId}}" method="post">
						{{csrf_field()}} {{method_field('DELETE')}}
						<button class="btn btn-danger btn-sm">
							<i class="fa fa-trash-o"></i>
						</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2" class="hidden-xs"></td>
			</tr>
		</tfoot>
	</table>
</div>
</div>
</div>
@endsection --}} @extends('layouts.dashboard') @section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> @endsection @section('body')

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
										<td colspan="6">{{Cart::total()}}</td>
									</tr>

									<tr>
										<td colspan="2">
											<a href="/" class="btn btn-warning btn-block">
												<i class="fas fa-caret-left"></i> Continue Shopping</a>
										</td>
										<td colspan="3">
											<button type="submit" class="btn btn-info btn-block">
												<i class="fas fa-sync-alt"></i> UpdateCart</button>
										</td>
										<td colspan="2">
											<a href="{{'/CheckOutCart'}}" class="btn btn-success btn-block">Checkout
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