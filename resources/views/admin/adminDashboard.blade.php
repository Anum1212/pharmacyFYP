@extends('layouts.dashboard')

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
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">HEADER</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="active">
            <a href="#">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span>Pharmacy</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-tachometer" aria-hidden="true"></i>
              <span>DashBoard</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <span>Orders</span>
            </a>
          </li>
          <li>
            <a href="admin/viewAllMessages">
              <i class="fa fa-comments" aria-hidden="true"></i>
              <span>Messages</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-users" aria-hidden="true"></i>
              <span>Registered Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li>
                <a href="#">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Customers
                </a>
              </li>
              <li>
                <a href="#">
                    <i class="fa fa-user-md" aria-hidden="true"></i>
                    Pharmacists
                </a>
              </li>
            </ul>
          </li>
                    <li>
            <a href="#">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              <span>Logout</span>
            </a>
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
          Page Header
          <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Level</a>
          </li>
          <li class="active">Here</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->

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

@endsection
