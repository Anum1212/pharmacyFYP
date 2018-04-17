@extends('layouts.siteView') 

@section('style') 
@endsection 

@section('body')
<div class="wrapper">
    <div class="map col-lg-8 col-md-8 col-sm-8 col-xs-12">
<div id="map">
</div>
</div>
<div class="details col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-12">
    <p> 
    <b>Pharmacy Name:</b> {{$pharmacy->pharmacyName}} <br>
    <b>Contact:</b> {{$pharmacy->contact}} <br>
    <b>Email:</b> {{$pharmacy->email}} <br>
    <b>Address:</b> {{$pharmacy->address}} {{$pharmacy->society}} {{$pharmacy->city}} <br>
    <b>Free Delivery Distance:</b> {{$pharmacy->freeDeliveryDistance}} <br>
    <b>Max Free Delivery Purchase:</b> {{$pharmacy->freeDeliveryPurchase}} <br>
    </p>
</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
        var map;
        
        function initMap() {                            
            var latitude = {{$pharmacy->latitude}}; // YOUR LATITUDE VALUE
            var longitude = {{$pharmacy->longitude}}; // YOUR LONGITUDE VALUE
            
            var myLatLng = {lat: latitude, lng: longitude};
            
            map = new google.maps.Map(document.getElementById('map'), {
              center: myLatLng,
              zoom: 16                    
            });
                    
            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map 
            });            
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdwAF58eIXQ7rb2cf2g20QFUVqy4b_MoU&callback=initMap"
        async defer></script>
@endsection