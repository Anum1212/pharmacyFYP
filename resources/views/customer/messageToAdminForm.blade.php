@extends('layouts.dashboard')

@section('body')

  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          <b>Ct</b>Us</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <b>Contact</b>Us</span>
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
              <span class="hidden-xs">
                {{Auth::guard('web')->user()->name}}</span>
            </a>
          </li>
      </div>
      </nav>
    </header>

    @if(Auth::guard('web')->check())
    {{-- Customer NavBar --}}
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <!-- Optionally, you can add icons to the links -->
          <li>
            <a href="index">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span>Pharmacy</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-tachometer " aria-hidden="true"></i>
              <span>DashBoard</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-cogs" aria-hidden="true"></i>
              <span>Account Details</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <span>Orders</span>
            </a>
          </li>
          <li>
            <a href="contactUsForm">
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
    @endif
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Contact Us
        </h1>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">

        <!--------------------------
        | Your Page Content Here |
        -------------------------->


        <div class="container containerDashboardContent">
          <form action="/contactUs" method="POST">
            {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" id="name" class="form-control" name="name" value="{{ Auth::user()->name }}" required autofocus></input>
    </div>
    <div class="form-group">
      <label for="dosage">Email:</label>
      <input type="text" id="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required autofocus></input>
    </div>
    <div class="form-group">
      <label for="price">Message:</label>
      <textarea rows="5" id="message" class="form-control" name="message" value="{{ old('message') }}" required autofocus></textarea>
    </div>
    <button type="submit" class="btn btn-success">Send Message</button>
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

