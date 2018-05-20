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
        <li class="active">
          <a href="/admin/dashboard">
            <i class="fas fa-tachometer-alt"></i>
            <span>DashBoard</span>
          </a>
        </li>
        {{--
        <li>
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
<li class="treeview">
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
            <li>
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
{{-- |---------------------------------- Search Bar ----------------------------------| --}}
<div class="searchForm" id="searchForm">
  <form action="/admin/searchFile" method="POST" role="search" target="_blank">
    {{ csrf_field() }}
    <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Search for file">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <i class="fas fa-search"></i>
        </button>
      </span>
    </div>
  </form>
</div>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
      <div class="container containerDashboardContent">
        <table>
          <caption>Enabled Files ({{count($enabledFiles)}})</caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">View</th>
              <th scope="col">Disable</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach ($enabledFiles as $enabledFile)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Name">{{$enabledFile->title}}</td>
                <td data-label="View">
                  <a href="{{'/admin/editFileForm/'.$enabledFile->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </td>
                <td data-label="Mark as read">
                  <form style="margin-top:15px;" action="{{'/admin/disableFile/'.$enabledFile->id}}" method="post">
                    {{csrf_field()}} {{method_field('PUT')}}
                    <button type="submit" class="btn btn-warning">Disable</button>
                  </form>
                </td>
                <td data-label="Delete">
                  <form style="margin-top:15px;" action="{{'/admin/deleteFile/'.$enabledFile->id}}" method="post">
                    {{csrf_field()}} {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              <?php
      $i++;
      ?>
                @endforeach
          </tbody>
        </table>
 {{ $enabledFiles->appends(['readTable' => $disabledFiles->currentPage()])->links() }}
 <hr>
 {{--  |---------------------------------- Read Messages Table ----------------------------------|--}}
 <table>
          <caption>Disabled Files ({{count($disabledFiles)}})
    </caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">View</th>
              <th scope="col">Enable</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach ($disabledFiles as $disabledFile)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Name">{{$disabledFile->title}}
</td>
                <td data-label="View">
                  <a href="{{'/admin/editFileForm/'.$disabledFile->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </td>
                <td data-label="Enable File">
                  <form style="margin-top:15px;" action="{{'/admin/enableFile/'.$disabledFile->id}}" method="post">
            {{csrf_field()}} {{method_field('PUT')}}
            <button type="submit" class="btn btn-warning">Enable</button>
          </form>
                </td>
                <td data-label="Delete">
                  <form style="margin-top:15px;" action="{{'/admin/deleteFile/'.$disabledFile->id}}" method="post">
            {{csrf_field()}} {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
                </td>
              </tr>
              <?php
      $i++;
      ?>
                @endforeach
          </tbody>
        </table>
  {{ $disabledFiles->appends(['unreadTable' => $enabledFiles->currentPage()])->links() }}
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