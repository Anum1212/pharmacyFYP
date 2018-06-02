@extends('layouts.dashboard') @section('head') @endsection @section('style') @endsection @section('body')
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index">
                <span>Lumino</span>Admin</a>
        </div>
    </div>
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <span class="capitalWord">{{Auth::user()->name}}</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li>
            <a href="/home">
                <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li>
            <a href="/editAccountDetailsForm">
                <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
        </li>
        <li class="active">
            <a href="/viewAllOrders">
                <em class="fa fa-truck">&nbsp;</em> Orders</a>
        </li>
        <li>
            <a href="/viewCart">
                <em class="fa fa-shopping-cart">&nbsp;</em> Cart</a>
        </li>
        <li>
            <a href="contactUsForm">
                <em class="fa fa-comment">&nbsp;</em> Contact Admin</a>
        </li>
        <li>
            <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <em class="fa fa-power-off">&nbsp;</em> Logout</a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!--/.row-->

    {{-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">File Managment</h1>
        </div>
    </div> --}}
    <!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @foreach($orderDetails as $orderDetail)
                    Order# {{$orderDetail->id}}
                    @endforeach
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                  <table>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">item</th>
              <th scope="col">type</th>
              <th scope="col">quantity</th>
              <th scope="col">pharmacy</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach($orderDetails as $orderDetail)
              <tr>
                <td data-label="#">{{$i}}</td>
                @foreach($productDetails as $productDetail) @if($productDetail->id == $orderDetail->id)
                <td data-label="item">{{$productDetail->name}}</td>
                @if($productDetail->type=='1')
                <!-- 1 = Tablet -->
                <td data-label="type">Tablet</td>
                @elseif($productDetail->type=='2')
                <!-- 2 = Capsule -->
                <td data-label="type">Capsule</td>
                @elseif($productDetail->type=='3')
                <!-- 3 = Syrup -->
                <td data-label="type">Syrup</td>
                @elseif($productDetail->type=='4')
                <!-- 4 = Inhaler -->
                <td data-label="type">Inhaler</td>
                @elseif($productDetail->type=='5')
                <!-- 5 = Drops -->
                <td data-label="type">Drops</td>
                @elseif($productDetail->type=='6')
                <!-- 6 = Injection -->
                <td data-label="type">Injection</td>
                @elseif($productDetail->type=='7')
                <!-- 7 = Cream -->
                <td data-label="type">Cream</td>
                @endif @endif @endforeach
                <td data-label="item">{{$orderDetail->quantity}}</td>
                @foreach($pharmacyDetails as $pharmacyDetail) @if($productDetail->pharmacistId == $pharmacyDetail->id)
                <td data-label="item">
                  <a href="/pharmacyDetails/{{$pharmacyDetail->id}}">{{$pharmacyDetail->pharmacyName}}</a>
                </td>
                @endif @endforeach
              </tr>
              <?php
      $i++;
      ?>
                @endforeach
          </tbody>
        </table>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->


</div>
<!--/.row-->
</div>
<!--/.main-->
@endsection @section('script') @endsection