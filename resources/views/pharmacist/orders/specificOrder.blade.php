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
            <a href="/pharmacist/dashboard">
                <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li>
            <a href="/pharmacist/editAccountDetailsForm">
                <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
        </li>
        <li class="active">
            <a href="/pharmacist/viewAllOrders">
                <em class="fa fa-truck">&nbsp;</em> Orders</a>
        </li>
        <li class="parent ">
            <a data-toggle="collapse" href="#products">
                <em class="fa fa-database">&nbsp;</em> Product Management
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="products">
                <li>
                    <a class="" href="/pharmacist/viewProducts">
                        <span class="fa fa-search">&nbsp;</span> View Products
                    </a>
                </li>
                <li>
                    <a class="" href="/pharmacist/addProduct">
                        <span class="fa fa-plus">&nbsp;</span> Add Products
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="/pharmacist/contactUsForm">
                <em class="fa fa-comment">&nbsp;</em> Contact Admin</a>
        </li>
        <li>
            <a href="{{ route('pharmacist.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <em class="fa fa-power-off">&nbsp;</em> Logout</a>
            <form id="logout-form" action="{{ route('pharmacist.logout') }}" method="POST" style="display: none;">
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
                    Order#{{$order->id}}
        <small><b>Date</b> {{$order->created_at}}</small>
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                  <div style="min-width:200px; max-width:600px;">
          <table>
            <caption>Customer Details</caption>
            <tbody>
              <tr>
                <td data-label="#">Name</td>
                <td data-label="item">{{$customerDetails->name}}</td>
              </tr>
              <tr>
                <td data-label="#">Email</td>
                <td data-label="item">{{$customerDetails->email}}</td>
              </tr>
              <tr>
                <td data-label="#">Contact#</td>
                <td data-label="item">{{$customerDetails->contact}}</td>
              </tr>
              <tr>
                <td data-label="#">Address</td>
                <td data-label="item">{{$customerDetails->address.' '.$customerDetails->society.', '.$customerDetails->city}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        @if (!empty($prescriptions))
        <div style="min-width:200px; max-width:600px;">
          <table>
            <caption>Prescriptions</caption>
            <tbody>
              <?php $i = '1'; ?>
              @foreach ($prescriptions as $prescription)
              <tr>
              <td data-label="#">{{$i}}</td>
                <td data-label="item">
                  <a class="btn btn-default" href={{ asset('storage/myAssets/prescriptions/'.$prescription->filename) }} target="_blank">View</a>
                </td>
              </tr>
              <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
        <table>
          <caption>Order Details </caption>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">item</th>
              <th scope="col">type</th>
              <th scope="col">Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach($orderDetails as $orderDetail)
              <tr>
                <td data-label="#">{{$i}}</td>
                @foreach($productDetails as $productDetail) 
                
                @if($productDetail->id == $orderDetail->productId)
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
              <td data-label="quantity">{{$orderDetail->quantity}}</td>
              </tr>
              <?php
      $i++;
      ?>
                @endforeach
                <tr>
                  <td colspan="2"><b>Total</b></td>
                <td colspan="2">{{$order->cost}}</td>
                </tr>
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