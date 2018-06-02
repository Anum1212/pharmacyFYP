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
    <li>
      <a href="/pharmacist/viewAllOrders">
        <em class="fa fa-truck">&nbsp;</em> Orders</a>
    </li>
    <li class="parent active">
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

  {{--
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">File Managment</h1>
    </div>
  </div> --}}
  <!--/.row-->

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">

          <span class="pull-right clickable panel-toggle panel-button-tab-left">
            <em class="fa fa-toggle-up"></em>
          </span>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" action="/pharmacist/editProduct/{{$product->id}}" method="POST">
          {{ csrf_field() }} {{ method_field('PUT') }}
            <fieldset>
              <!-- Product Name-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="productName">Product Name</label>
                <div class="col-md-9">
                  <input id="productName" name="productName" type="text" class="form-control" value="{{$product->name}}" required>
                </div>
              </div>

              <!-- Product Dosage-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="dosage">Dosage</label>
                <div class="col-md-9">
                  <input id="dosage" name="dosage" type="number" class="form-control" value="{{$product->dosage}}" required>
                </div>
              </div>

              {{-- possible types of medicine 1) tablet 2) capsule 3) syrup 4) inhaler 5) drops 6) injection 7) cream --}}
              <!-- Product Dosage-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="dosage">Product Type:</label>
                <div class="col-md-9">
                  <select class="form-control" id="drugType" name="drugType" required>
                    <option value="1" <?php if($product->type=="1") echo 'selected="selected"'; ?>>Tablet</option>
              <option value="2" <?php if($product->type=="2") echo 'selected="selected"'; ?>>Capsule</option>
              <option value="3" <?php if($product->type=="3") echo 'selected="selected"'; ?>>Syrup</option>
              <option value="4" <?php if($product->type=="4") echo 'selected="selected"'; ?>>Inhaler</option>
              <option value="5" <?php if($product->type=="5") echo 'selected="selected"'; ?>>Drops</option>
              <option value="6" <?php if($product->type=="6") echo 'selected="selected"'; ?>>Injection</option>
              <option value="7" <?php if($product->type=="7") echo 'selected="selected"'; ?>>Cream</option>
                  </select>
                </div>
              </div>

              {{-- possible types of medicine 0) Not Required 1) Required--}}
              <!-- Product prescription-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="prescription">Prescription:</label>
                <div class="col-md-9">
                  <select class="form-control" id="prescription" name="prescription" required>
                    <option value="">----</option>
              <option value="0"<?php if($product->prescription=="0") echo 'selected="selected"'; ?>>Not Required</option>
              <option value="1"<?php if($product->prescription=="1") echo 'selected="selected"'; ?>>Required</option>
                  </select>
                </div>
              </div>

              <!-- Product Price-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="price">Price</label>
                <div class="col-md-9">
                  <input id="price" name="price" type="number" class="form-control" value="{{$product->price}}" required>
                </div>
              </div>

              <!-- Product Quantity-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="quantity">Quantity</label>
                <div class="col-md-9">
                  <input id="quantity" name="quantity" type="number" class="form-control" value="{{$product->quantity}}" required>
                </div>
              </div>

              <!-- Form actions -->
              <div class="form-group">
                <div class="col-md-12 widget-right">
                  <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
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