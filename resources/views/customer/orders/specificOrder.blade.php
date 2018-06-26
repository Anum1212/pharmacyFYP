@extends('layouts.customerDashboard') 

@section('body')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        @foreach($orderDetails as $orderDetail) Order# {{$orderDetail->id}} @endforeach
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

              @foreach($orderDetails as $orderDetail) {{-- loop 1 --}}
              <tr>
                <td data-label="#">{{ $loop->iteration }}</td>
                @foreach($productDetails as $productDetail) {{-- loop 2 --}}
                @if($productDetail->id == $orderDetail->productId) {{-- product detail if 1 --}}
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
                @endif 
                <td data-label="item">{{$orderDetail->quantity}}</td>
                @foreach($pharmacyDetails as $pharmacyDetail) {{-- loop 3 --}}
                @if($productDetail->pharmacistId == $pharmacyDetail->id) {{-- product detail if 2 --}}
                <td data-label="item">
                  <a href="/pharmacyDetails/{{$pharmacyDetail->id}}">{{$pharmacyDetail->pharmacyName}}</a>
                </td>
                @endif {{-- product detail if 2 end --}}
                @endforeach {{-- loop 3 end --}}
                @endif {{-- product deatil if 1 end --}}
                @endforeach {{-- loop 2 end --}}
              </tr>
                @endforeach {{-- loop 1 end --}}
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!--/.row-->
@endsection