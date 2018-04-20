@extends('layouts.dashboard') @section('body')

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
        <li>
          <a href="/pharmacist/viewAllOrders">
            <i class="fas fa-truck"></i>
            <span>Orders</span>
          </a>
        </li>
        <li class="treeview active">
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
            <li class="active">
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
          <a href="{{ route('pharmacist.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </a>

          <form id="logout-form" action="{{ route('pharmacist.logout') }}" method="POST" style="display: none;">
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
        Add Product
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="/pharmacist/viewProducts">
            <i class="fa fa-database"></i> Product Managment</a>
        </li>
        <li class="active">Add Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

      <div class="container containerDashboardContent">
        <form action="addProduct" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" class="form-control" id="productName" placeholder="Enter productName" name="productName" required>
          </div>
          <div class="form-group">
            <label for="dosage">Dosage(mg/ml):</label>
            <input type="number" class="form-control" id="dosage" placeholder="Enter dosage" name="dosage" required>
          </div>
          {{-- possible types of medicine 1) tablet 2) capsule 3) syrup 4) inhaler 5) drops 6) injection 7) cream --}}
          <div class="form-group">
            <label for="drugType">Product Type:</label>
            <select class="form-control" id="drugType" name="drugType" required>
              <option value="">----</option>
              <option value="1">Tablet</option>
              <option value="2">Capsule</option>
              <option value="3">Syrup</option>
              <option value="4">Inhaler</option>
              <option value="5">Drops</option>
              <option value="6">Injection</option>
              <option value="7">Cream</option>
            </select>
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required>
          </div>
          <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" required>
          </div>
          <button type="submit" class="btn btn-success">Add Product</button>
        </form>
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