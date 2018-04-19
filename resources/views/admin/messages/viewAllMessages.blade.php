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
        DashBoard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
{{-- |---------------------------------- Search Bar ----------------------------------| --}}
<div class="searchForm" id="searchForm">
  <form action="/admin/searchSender" method="POST" role="search" target="_blank">
    {{ csrf_field() }}
    <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Search for message by">
      <span class="input-group-btn">
        <button type="submit" class="btn btn-default">
          <span class="glyphicon glyphicon-search"></span>
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
          <caption>Unread Messages ({{count($unreadMessages)}})
             <span style="font-size:13px"> @if (count($unreadMessages)==0)
    <p><span style="color:green">Wow no Messages</span></p>
    @endif @if (count($unreadMessages)==1)
    <p>Admin there is only <span style="color:red">1</span> Message. Lets see what it says</p>
    @endif @if (count($unreadMessages)>1 && count($unreadMessages)
    <=10) <p>Come On Admin its only a few messages. Lets finish them</p>
      @endif
      </span>
    </caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">View</th>
              <th scope="col">Mark as Read</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach ($unreadMessages as $unreadMessage)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Name">{{$unreadMessage->name}}</td>
                <td data-label="View">
                  <a href="{{'/admin/viewMessage/'.$unreadMessage->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </td>
                <td data-label="Mark as read">
                  <form style="margin-top:15px;" action="{{'/admin/markAsReadMessage/'.$unreadMessage->id}}" method="post">
                    {{csrf_field()}} {{method_field('PUT')}}
                    <button type="submit" class="btn btn-warning">Mark as Read</button>
                  </form>
                </td>
                <td data-label="Delete">
                  <form style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$unreadMessage->id}}" method="post">
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
 {{ $unreadMessages->appends(['readTable' => $readMessages->currentPage()])->links() }}
 <hr>
 {{--  |---------------------------------- Read Messages Table ----------------------------------|--}}
 <table>
          <caption>Read Messages ({{count($readMessages)}})
    </caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">View</th>
              <th scope="col">Mark as Read</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach ($readMessages as $readMessage)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Name">{{$readMessage->name}} @if($readMessage->status == '1')
          <p>
            <span style="color:red">(Only Read)</span>
          </p>
          @endif @if($readMessage->status == '2')
          <p>
            <span style="color:green">(Replied)</span>
          </p>
          @endif
</td>
                <td data-label="View">
                  <a href="{{'/admin/viewMessage/'.$readMessage->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
                </td>
                <td data-label="Mark as read">
                  <form style="margin-top:15px;" action="{{'/admin/markAsUnreadMessage/'.$readMessage->id}}" method="post">
            {{csrf_field()}} {{method_field('PUT')}}
            <button type="submit" class="btn btn-warning">Mark as Unread</button>
          </form>
                </td>
                <td data-label="Delete">
                  <form style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$readMessage->id}}" method="post">
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
  {{ $readMessages->appends(['unreadTable' => $unreadMessages->currentPage()])->links() }}
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