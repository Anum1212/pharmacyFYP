@extends('layouts.dashboard') @section('body')

<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <b>M</b>sg</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <b>M</b>essage</span>
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
        <li class="active">
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
        Message
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row">
	<!-- Contenedor Principal -->
    <div class="comments-container">
		<ul id="comments-list" class="comments-list">
      @for ($i=0; $i<count($visitorPrevMessage) ; $i++)
      <li>
				<div class="comment-main-level">
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><a href="http://creaticode.com/blog">{{$visitorPrevMessage[$i]->name}}</a></h6>
							<span>{{$visitorPrevMessage[$i]->created_at}}</span>
							<i class="fa fa-reply"></i>
						</div>
						<div class="comment-content">
							{{$visitorPrevMessage[$i]->message}}
						</div>
					</div>
				</div>
        
				<!-- Respuestas de los comentarios -->
				<ul class="comments-list reply-list">
          @for ($j=0; $j<count($adminResponse) ; $j++) 
    @if($visitorPrevMessage[$i]->id == $adminResponse[$j]->repliedToId)
					<li>
						<!-- Contenedor del Comentario -->
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name">You</h6>
								<span>{{$adminResponse[$j]->created_at}}</span>
							</div>
							<div class="comment-content">
								{{$adminResponse[$j]->message}}
							</div>
						</div>
          </li>
          @endif
          @endfor
				</ul>
			</li>
  @endfor
		</ul>
	</div>
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