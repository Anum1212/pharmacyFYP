@extends('layouts.siteView') @section('style') @endsection @section('body')

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 colxs-12">
                    <div id="imaginary_container">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control" id="address" placeholder="Enter an Address">
                            <span class="detectLocationAddon input-group-addon">
                                <button type="button" onclick="getLocation()" class="detectLocation">
                                    <span class="fa fa-bullseye"></span>
                                </button>
                            </span>
                            <span class="input-group-addon">
                                <button type="botton" onclick="addressToCoOrdinates()">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 medicineForm">
                <div class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <form class="form-horizontal" action="/detectPharmacy" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input id="medicineSearched" name="medicineSearched" type="text" class="form-control" placeholder="Medicine" required>
                        </div>
                        <div class="form-group">
                            <input id="distance" name="distance" type="number" class="form-control" placeholder="Search Radius" required>
                        </div>
                        <button type="submit" class="btn btn-primary search">Search</button>
                        <br>
                        <br>
                        <input type="text" name="latitude" id="lat" value="" style="display:none">
                        <input type="text" name="longitude" id="lng" value="" style="display:none">
                    </form>
                </div> {{-- medicineForm --}}
            </div> {{-- medicineForm --}}
        </div> {{-- row --}}
    </div> {{-- Container --}}
</div> {{-- Wrapper --}} @endsection @section('script') {{--
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb86GIW2pKc-uVB8LdJrP_YKsYj7LedUo">
</script>

<script>
    $(document).ready(function () {
        $('.medicineForm').hide();
    });


    function getLocation() {
        if (navigator.geolocation) {
            var x = navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        $('#lat').val(position.coords.latitude);
        $('#lng').val(position.coords.longitude);

        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        var geocoder = new google.maps.Geocoder;
        geocoder.geocode({
            'latLng': latlng
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $('#address').val(results[0].formatted_address);
            }
        });
        if ($('#lat').val() != "") {
            $('.medicineForm').show();
        }
    }


    function addressToCoOrdinates() {
        var geocoder = new google.maps.Geocoder();
        var address = jQuery('#address').val();

        geocoder.geocode({
            'address': address
        }, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                $('#lat').val(latitude);
                $('#lng').val(longitude);
                if ($('#lat').val() != "") {
                    $('.medicineForm').show();
                }
            }
        });
    }
</script>
@endsection