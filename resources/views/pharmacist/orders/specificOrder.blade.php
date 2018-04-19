@extends('layouts.dashboard') @section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> @endsection @section('style') @endsection @section('body')

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <b>O</b>rder</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <b>O</b>rders</span>
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
        <li>
          <a href="/pharmacist/editAccountDetailsForm">
            <i class="fas fa-cogs"></i>
            <span>Account Details</span>
          </a>
        </li>
        <li class="active">
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
        Orders
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="/pharmacist/viewAllOrders">
            <i class="fa fa-dashboard"></i> Orders</a>
        </li>
        <li class="active">{{$customerDetails->name}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="container containerDashboardContent">
        <div style="min-width:200px; max-width:600px;">
          <table>
            <caption>Customer Details</caption>
            <tbody>
              <tr>
                <td data-label="#">Name</td>
                <td data-label="item">{{$customerDetails->name}}</td>
              </tr>
              <tr>
                <td data-label="#">Email</td>
                <td data-label="item">{{$customerDetails->email}}</td>
              </tr>
              <tr>
                <td data-label="#">Contact#</td>
                <td data-label="item">{{$customerDetails->contact}}</td>
              </tr>
              <tr>
                <td data-label="#">Address</td>
                <td data-label="item">{{$customerDetails->address.' '.$customerDetails->society.', '.$customerDetails->city}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <table>
          <caption>Order Details</caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">item</th>
              <th scope="col">type</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach($orderDetails as $orderDetail)
              <tr>
                <td data-label="#">{{$i}}</td>
                @foreach($productDetails as $productDetail) @if($productDetail->id == $orderDetail->id)
                <td data-label="item">{{$productDetail->name}}</td>
                @if($productDetail->type=='1')
                <!-- 1 = Tablet -->
                <td data-label="type">Tablet</td>
                @elseif($productDetail->type=='2')
                <!-- 2 = Capsule -->
                <td data-label="type">Capsule</td>
                @elseif($productDetail->type=='3')
                <!-- 3 = Syrup -->
                <td data-label="type">Syrup</td>
                @elseif($productDetail->type=='4')
                <!-- 4 = Inhaler -->
                <td data-label="type">Inhaler</td>
                @elseif($productDetail->type=='5')
                <!-- 5 = Drops -->
                <td data-label="type">Drops</td>
                @elseif($productDetail->type=='6')
                <!-- 6 = Injection -->
                <td data-label="type">Injection</td>
                @elseif($productDetail->type=='7')
                <!-- 7 = Cream -->
                <td data-label="type">Cream</td>
                @endif @endif @endforeach
              </tr>
              <?php
      $i++;
      ?>
                @endforeach
          </tbody>
        </table>
      </div>

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