@extends('layouts.dashboard')

@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection

@section('style')
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
          <li >
            <a href="/index">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span>Pharmacy</span>
            </a>
          </li>
          <li>
            <a href="/pharmacist/dashboard">
              <i class="fa fa-tachometer" aria-hidden="true"></i>
              <span>DashBoard</span>
            </a>
          </li>
           <li>
            <a href="/pharmacist/editAccountDetailsForm">
              <i class="fa fa-cogs" aria-hidden="true"></i>
              <span>Account Details</span>
            </a>
          </li>
          <li class="active">
            <a href="/pharmacist/viewAllOrders">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <span>Orders</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users" aria-hidden="true"></i>
              <span>Product Management</span>
              <span class="pull-right-container">
               <i class="fa fa-database" aria-hidden="true"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="/pharmacist/viewProducts">
                    <i class="fa fa-sarch" aria-hidden="true"></i>
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
              <i class="fa fa-truck" aria-hidden="true"></i>
              <span>Contact Us</span>
            </a>
          </li>
          <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                           <i class="fa fa-sign-out" aria-hidden="true"></i>
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
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="container containerDashboardContent">

  <table>
  <caption>Your Orders</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    ?>
    @foreach($orders as $order)
    <tr>
      <td data-label="#">{{$i}}</td>
      @foreach($customers as $customer)
      @if($customer->id == $order->userId)
      <td data-label="Customer">{{$customer->name}}</td>
      <td data-label="View"><a href="viewSpecificOrder/{{$order->id}}/{{$customer->id}}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
      @endif
      @endforeach
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
