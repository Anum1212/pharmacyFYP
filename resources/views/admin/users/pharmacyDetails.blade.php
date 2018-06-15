@extends('layouts.adminDashboard')

@section('head')
    <link href="{{ asset('css/map.css') }}" rel="stylesheet">
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Pharmacy Details
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Pharmacy Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Address</th>
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
                <div id="map">
                </div>
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
                                <td data-label="Order Date">{{$order->created_at}}</td>
                                <td data-label="View">
                                    <a href="/admin/viewPharmacySpecificOrder/{{$order->id}}/{{$customer->id}}/{{Auth::user()->id}}">
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
        <div class="panel-footer">
        </div>
    </div>
</div>
<!--/.row-->
@endsection

@section('script')
<script type="text/javascript">
    var map;

    function initMap() {
        var latitude = {
            {
                $pharmacy - > latitude
            }
        }; // YOUR LATITUDE VALUE
        var longitude = {
            {
                $pharmacy - > longitude
            }
        }; // YOUR LONGITUDE VALUE

        var myLatLng = {
            lat: latitude,
            lng: longitude
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