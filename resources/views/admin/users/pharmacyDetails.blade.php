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
        <b>Mng</b>Ph</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <b>Mng</b>Pharmacies</span>
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
              <span class="hidden-xs">{{Auth::guard('admin')->user()->name}}</span>
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
        <li class="treeview">
          <a href="#">
            <i class="fas fa-file"></i>
            <span>Mangage Files</span>
            <span class="pull-right-container">
              <i class="fas fa-caret-down"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
          <a href="/admin/viewAllFiles">
            <i class="fas fa-search"></i>
            <span>View Files</span>
          </a>
            </li>
            <li>
          <a href="/admin/uploadFileForm">
            <i class="fas fa-upload"></i>
            <span>Upload File</span>
          </a>
            </li>
          </ul>
        </li>
        <li>
          <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
          </a>

          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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
        DashBoard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="panel panel-default">
<div class="panel-heading">

    <table>
          <thead>
            <tr>
              <th scope="col">Pharmacy Name</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col">Address</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td data-label="Pharmacy Name">{{$pharmacy->pharmacyName}}</td>
                <td data-label="Email">{{$pharmacy->email}}</td>
                <td data-label="Contact">{{$pharmacy->contact}}</td>
                <td data-label="Address">{{$pharmacy->address .' '. $pharmacy->society .', '.$pharmacy->city}}</td>
              </tr>
          </tbody>
        </table>
</div>
<div class="panel-body">
    <div id="map">
    </div>
</div><!-- /panel-body -->
<div class="panel-footer">

  <table>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Order#</th>
              <th scope="col">Customer</th>
              <th scope="col">Cost</th>
              <th scope="col">Order Date</th>
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
                <td data-label="Order#">{{$order->id}}</td>
                @foreach($customers as $customer) 
                @if($customer->id == $order->userId)
                <td data-label="Customer">{{$customer->name}}</td>
                <td data-label="Cost">{{$order->cost}}</td>
                <td data-label="Order Date">{{$order->created_at}}</td>
                <td data-label="View">
                <a href="/admin/viewPharmacySpecificOrder/{{$order->id}}/{{$customer->id}}/{{Auth::user()->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </td>
                @endif @endforeach
              </tr>
              <?php
      $i++;
      ?>
                @endforeach
          </tbody>

    </div>
</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
@endsection


@section('script')
<script type="text/javascript">
    var map;

    function initMap() {
        var latitude = {{$pharmacy->latitude}}; // YOUR LATITUDE VALUE
        var longitude = {{$pharmacy->longitude}}; // YOUR LONGITUDE VALUE

        var myLatLng = {
            lat:latitude,
            lng:longitude
            };

        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 18
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdwAF58eIXQ7rb2cf2g20QFUVqy4b_MoU&callback=initMap" async
    defer></script>
@endsection