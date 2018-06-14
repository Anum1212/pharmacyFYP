@extends('layouts.adminDashboard')

@section('head')
    <link href="{{ asset('css/map.css') }}" rel="stylesheet">
@endsection

@section('panelHeading', 'panelHeadingHere') 

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Customer Details
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Name">{{$customer->name}}</td>
                            <td data-label="Email">{{$customer->email}}</td>
                            <td data-label="Contact">{{$customer->contact}}</td>
                            <td data-label="Address">{{$customer->address .' '. $customer->society .', '.$customer->city}}</td>
                        </tr>
                    </tbody>
                </table>
                <div id="map">
                </div>
                <table>
                    <caption>Customer Orders</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order</th>
                            <th scope="col">Cost</th>
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
                                <td data-label="Customer">{{$order->id}}</td>
                                <td data-label="Customer">{{$order->cost}}</td>
                                <td data-label="View">
                                    <a href="/viewSpecificOrder/{{$order->id}}">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </td>
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
                $customer - > latitude
            }
        }; // YOUR LATITUDE VALUE
        var longitude = {
            {
                $customer - > longitude
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