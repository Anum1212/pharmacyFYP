@extends('layouts.dashboard')

@section('body')

  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          <b>Pd</b>Mg</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <b>Product</b>Managment</span>
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
          <li>
            <a href="/pharmacist/viewAllOrders">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <span>Orders</span>
            </a>
          </li>
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-users" aria-hidden="true"></i>
              <span>Product Management</span>
              <span class="pull-right-container">
               <i class="fa fa-database" aria-hidden="true"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active">
                <a href="/pharmacist/viewProducts">
                    <i class="fa fa-search" aria-hidden="true"></i>
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
          View Products
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="/pharmacist/viewProducts">
              <i class="fa fa-database"></i> Product Managment</a>
          </li>
          <li class="active">View Products</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="container containerDashboardContent">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Name
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Dosage
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Type
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Price
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Quantity
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                Actions
            </div>
        </div>

        @foreach ($products as $product)
            
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->name}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->dosage}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->type}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->price}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                {{$product->quantity}}
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12">
                <a class="btn btn-success" href="editProduct/{{$product->id}}"><i class="fa fa-edit"></i></a>
                <form action="/pharmacist/deleteProduct/{{$product->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button class="btn btn-success" type="submit"><i class="fa fa-trash"></i></button>
                                </form>
            </div>
        </div>
        @endforeach
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

