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
            <i class="fa fa-home" aria-hidden="true"></i>
            <span>Pharmacy</span>
          </a>
        </li>
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
            <li class="active">
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

        <table>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Dosage</th>
              <th scope="col">Type</th>
              <th scope="col">Prescription</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach ($products as $product)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Name">{{$product->name}}</td>
                <td data-label="Dosage">{{$product->dosage}}</td>
                @if($product->type=='1')
                <!-- 1 = Tablet -->
                <td data-label="Type">Tablet</td>
                @elseif($product->type=='2')
                <!-- 2 = Capsule -->
                <td data-label="Type">Capsule</td>
                @elseif($product->type=='3')
                <!-- 3 = Syrup -->
                <td data-label="Type">Syrup</td>
                @elseif($product->type=='4')
                <!-- 4 = Inhaler -->
                <td data-label="Type">Inhaler</td>
                @elseif($product->type=='5')
                <!-- 5 = Drops -->
                <td data-label="Type">Drops</td>
                @elseif($product->type=='6')
                <!-- 6 = Injection -->
                <td data-label="Type">Injection</td>
                @elseif($product->type=='7')
                <!-- 7 = Cream -->
                <td data-label="Type">Cream</td>
                @endif
                @if($product->prescription=='0')
                <!-- 0 = Not Required -->
                <td data-label="prescription">Not Required</td>
                @elseif($product->prescription=='1')
                <!-- 1 = Required -->
                <td data-label="Type">Required</td>
                @endif
                <td data-label="Price">{{$product->id}}</td>
                <td data-label="Quantity">{{$product->quantity}}</td>
                <td data-label="Edit">
                <a class="btn btn-success" href="editProduct/{{$product->id}}">
                    <i class="fas fa-edit"></i>
                  </a>
                </td>
                <td data-label="Delete">
                <form action="/pharmacist/deleteProduct/{{$product->id}}" method="post">
              {{csrf_field()}} {{method_field('DELETE')}}
              <button class="btn btn-danger" type="submit">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
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