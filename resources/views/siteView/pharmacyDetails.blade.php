@extends('layouts.siteView')
@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> 
@endsection

@section('body')
<div class="wrapper">
    <div class="row">

<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
<div class="panel panel-default">
<div class="panel-heading">

    <table>
          <thead>
            <tr>
              <th scope="col">Pharmacy Name</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col"><Address></Address></th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td data-label="Pharmacy Name">{{$pharmacy->pharmacyName}}</td>
                <td data-label="Email">{{$pharmacy->email}}</td>
                <td data-label="Contact">{{$pharmacy->contact}}</td>
                <td data-label="Address">{{$pharmacy->address .' '. $pharmacy->society .', '.$pharmacy->city}}</td>
              </tr>
          </tbody>
        </table>
</div>
<div class="panel-body">
    <div id="map">
    </div>
</div><!-- /panel-body -->
@if(Auth::guard('admin')->check())
<div class="panel-footer">
    <table>
        <caption>Orders Received</caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Customer</th>
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
                  @foreach($customers as $customer) @if($customer->id == $order->userId)
                  <td data-label="Customer">{{$customer->name}}</td>
                  <td data-label="View">
                      <a href="/pharmacist/viewSpecificOrder/{{$order->id}}/{{$customer->id}}">
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
    @endif
</div>
</div>
</div>
</div>


@endsection @section('script')
<script type="text/javascript">
    var map;

    function initMap() {
        var latitude = {{$pharmacy->latitude}}; // YOUR LATITUDE VALUE
        var longitude = {{$pharmacy->longitude}}; // YOUR LONGITUDE VALUE

        var myLatLng = {
            lat:latitude,
            lng:longitude
            };

        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 18
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdwAF58eIXQ7rb2cf2g20QFUVqy4b_MoU&callback=initMap" async
    defer></script>
@endsection