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
                    Products ({{$totalProducts}})
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
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
              @foreach ($products as $product)
              <tr>
                <td data-label="#">{{ (($products->currentPage() - 1 ) * $products->perPage() ) + $loop->iteration }}</td>
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
                <td data-label="Price">{{$product->price}}</td>
                <td data-label="Quantity">{{$product->quantity}}</td>
                <td data-label="Edit">
                <a class="btn btn-success" href="editProduct/{{$product->id}}">
                    <i class="fa fa-edit"></i>
                  </a>
                </td>
                <td data-label="Delete">
                <form class="confirm" action="/pharmacist/deleteProduct/{{$product->id}}" method="post">
              {{csrf_field()}} {{method_field('DELETE')}}
              <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash"></i>
              </button>
            </form>
                </td>
              </tr>
                @endforeach
          </tbody>
        </table>
        {{ $products->links() }}
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