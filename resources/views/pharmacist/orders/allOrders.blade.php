@extends('layouts.pharmacistDashboard')

@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Orders
        <span class="pull-right clickable panel-toggle panel-button-tab-left">
          <em class="fa fa-toggle-up"></em>
        </span>
      </div>
      <div class="panel-body">
        <table>
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Order#</th>
              <th scope="col">Customer</th>
              <th scope="col">Cost</th>
              <th scope="col">Order Date</th>
              <th scope="col">View</th>
            </tr>
          </thead>
          <tbody>
            <?php
    $i=1;
    ?>
              @foreach($orders as $order)
              <tr>
                <td data-label="#">{{$i}}</td>
                <td data-label="Order#">{{$order->id}}</td>
                @foreach($customers as $customer) @if($customer->id == $order->userId)
                <td data-label="Customer">{{$customer->name}}</td>
                <td data-label="Cost">{{$order->cost}}</td>
                <td data-label="Order Date">{{$order->created_at->format('d/m/Y')}}</td>
                <td data-label="View">
                  <a href="viewSpecificOrder/{{$order->id}}/{{$customer->id}}/{{Auth::user()->id}}">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </a>
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
@endsection