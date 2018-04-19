@extends('layouts.dashboard') @section('body')

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <b>Ac</b>Dt</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <b>Account</b>Details</span>
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
        <li>
          <a href="/pharmacist/dashboard">
            <i class="fas fa-tachometer-alt"></i>
            <span>DashBoard</span>
          </a>
        </li>
        <li class="active">
          <a href="/pharmacist/editAccountDetailsForm">
            <i class="fas fa-cogs"></i>
            <span>Account Details</span>
          </a>
        </li>
        <li>
          <a href="/pharmacist/viewAllOrders">
            <i class="fas fa-truck"></i>
            <span>Orders</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-database"></i>
            <span>Product Management</span>
            <span class="pull-right-container">
              <i class="fas fa-caret-down"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="/pharmacist/viewProducts">
                <i class="fas fa-search"></i>
                View Products
              </a>
            </li>
            <li>
              <a href="/pharmacist/addProduct">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Add Products
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="/pharmacist/contactUsForm">
            <i class="fas fa-comment"></i>
            <span>Contact Us</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <section class="content-header">
      <h1>
        Account Details
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->


      <form class="form-horizontal" role="form" method="POST" action="/pharmacist/editAccountDetails">
        {{ csrf_field() }} {{-- ---------------------------- Name ----------------------------- --}}
        <div class="form-group">
          <label for="name" class="col-md-4 control-label">Name</label>
          <div class="col-md-6">
            <input id="name" type="name" class="form-control" name="name" value="{{ $pharmacyDetails->name }}" required>
          </div>
        </div>

        {{-- ---------------------------- Email ----------------------------- --}}
        <div class="form-group">
          <label for="email" class="col-md-4 control-label">E-Mail Address</label>

          <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ $pharmacyDetails->email }}" required>
          </div>
        </div>

        {{-- ---------------------------- Contact ----------------------------- --}}
        <div class="form-group">
          <label for="contact" class="col-md-4 control-label">Contact</label>

          <div class="col-md-6">
            <input id="contact" type="text" class="form-control" name="contact" minlength="11" maxlength="11" value="{{ $pharmacyDetails->contact }}"
              required autofocus>
          </div>
        </div>

        {{-- ---------------------------- Pharmacy Name ----------------------------- --}}
        <div class="form-group">
          <label for="pharmacyName" class="col-md-4 control-label">Pharmacy Name</label>

          <div class="col-md-6">
            <input id="pharmacyName" type="text" class="form-control" name="pharmacyName" value="{{ $pharmacyDetails->pharmacyName }}"
              required autofocus>
          </div>
        </div>

        {{-- ---------------------------- Address ----------------------------- --}}
        <div class="form-group">
          <label for="address" class="col-md-4 control-label">Address</label>

          <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" value="{{ $pharmacyDetails->address }}" required autofocus>
          </div>
        </div>

        {{-- ---------------------------- Society ----------------------------- --}}
        <div class="form-group">
          <label for="society" class="col-md-4 control-label">Society</label>

          <div class="col-md-6">
            <input id="society" type="text" class="form-control" name="society" value="{{ $pharmacyDetails->society }}" required autofocus>
          </div>
        </div>

        {{-- ---------------------------- City ----------------------------- --}}
        <div class="form-group">
          <label for="city" class="col-md-4 control-label">City</label>

          <div class="col-md-6">
            <input id="city" type="text" class="form-control" name="city" value="{{ $pharmacyDetails->city }}" required autofocus>
          </div>
        </div>

        {{-- ---------------------------- Max Purchase for Free Delivery ----------------------------- --}}
        <div class="form-group">
          <label for="freeDeliveryPurchase" class="col-md-4 control-label">Max Purchase for Free Delivery</label>

          <div class="col-md-6">
            <input id="freeDeliveryPurchase" type="text" class="form-control" name="freeDeliveryPurchase" value="{{ $pharmacyDetails->freeDeliveryPurchase }}"
              required autofocus>
          </div>
        </div>

        {{-- ---------------------------- Password ----------------------------- --}} {{--
        <div class="form-group">
          <label for="password" class="col-md-4 control-label">Password</label>

          <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" required>
          </div>
        </div> --}}

        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
              Save Changes
            </button>
          </div>
        </div>
      </form>


    </section>
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