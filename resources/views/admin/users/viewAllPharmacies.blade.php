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
        <b>Dh</b>Bd</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <b>Dash</b>Board</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a class="sidebar-toggle" data-toggle="push-menu" role="button">
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
          <a href="/admin/dashboard">
            <i class="fas fa-tachometer-alt"></i>
            <span>DashBoard</span>
          </a>
        </li>
        {{-- <li>
          <a href="/admin/editAccountDetailsForm">
            <i class="fas fa-cogs"></i>
            <span>Account Details</span>
          </a>
        </li> --}}
        <li>
          <a href="/admin/viewAllOrders">
            <i class="fas fa-truck"></i>
            <span>Orders</span>
          </a>
        </li>
<li class="treeview active">
          <a href="#">
            <i class="fas fa-users"></i>
            <span>Mangage Users</span>
            <span class="pull-right-container">
              <i class="fas fa-caret-down"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="/admin/viewAllCustomers">
                <i class="fas fa-user"></i>
                Customers
              </a>
            </li>
            <li class="active">
              <a href="/admin/viewAllPharmacies">
                <i class="fas fa-user-md"></i>
                Pharmacies
              </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="/admin/viewAllMessages">
            <i class="fas fa-comment"></i>
            <span>Messages</span>
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
        Mangage Pharmacies
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
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">PharmacyName</th>
              <th scope="col">Contact</th>
              <th scope="col">Address</th>
              <th scope="col">View</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach($users as $user)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Customer">{{$user->name}}</td>
                <td data-label="Email">{{$user->email}}</td>
                <td data-label="Email">{{$user->pharmacyName}}</td>
                <td data-label="Contact">{{$user->contact}}</td>
                <td data-label="Address">{{$user->address.' '.$user->society.', '.$user->city}}</td>
                <td data-label="View">
                  <a href="/pharmacyDetails/{{$user->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </td>
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