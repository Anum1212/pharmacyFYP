@extends('layouts.adminDashboard')

@section('panelHeading', 'panelHeadingHere') 

@section('searchBar')
<form role="search" action="/admin/searchOrder" method="get" role="search">
  <div class="form-group">
    <input type="number" class="form-control" name="search" placeholder="Search for order" required>
  </div>
</form>
@endsection

@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Upload File
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
        <table>
          <caption>Order Details </caption>
          <thead>
            <tr>
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
                @foreach($productDetails as $productDetail) @if($productDetail->id == $orderDetail->productId)
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
                  <td colspan="2">
                    <b>Total</b>
                  </td>
                  <td colspan="2">{{$order->cost}}</td>
                </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--/.row-->
@endsection