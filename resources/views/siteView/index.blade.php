@extends('layouts.app') @section('style') @endsection @section('content')
<div class="wrapper">

    <!--
  ********************************************************************
                        Detect Location Div
  ********************************************************************
  -->

    <div id="detectLocationWrapper" class="menuItem">
        <a class="btn btn-primary" id="showDetectLocationForm" onclick="javascript:showDiv('detectLocation');" href="#detectLocation">Detect My Location</a>


        <div class="showForm" id="detectLocation" style="display: none;">

            <!--
  ********************************************************************
                        Detect Location Form
  ********************************************************************
  -->
            <div class="form">
                detect location
                <form class="form-horizontal" method="POST" action="/detectPharmacy">
                    {{ csrf_field() }}

                    <div class="col-md-6">
                        Medicine: <input id="searchBar" type="text" class="form-control" name="medicineSearched" placeholder="search medicine" required>
                        Distance(km):<input id="distance" type="number" class="form-control" name="distance" value="1" placeholder="enter distance" required>
                        <input id="latitude" type="text" name="latitude" hidden>
                        <input id="longitude" type="text" name="longitude" hidden>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Search Medicine
                                </button>
                            </div>
                        </div>
                </form>

                </div>
            </div>
        </div>

            <!--
                ********************************************************************
                Enter A Location Div
                ********************************************************************
  -->
            <div id="enterALocationWrapper" class="menuItem">
                <div class="menuItemHeading">
                    <a class="btn btn-primary" id="showEnterALocationForm" onclick="javascript:showDiv('enterALocation');" href="#enterALocation">
                        Enter a Location</a>
                </div>
                <div class="showForm" id="enterALocation" style="display: none;">

                    <!--
  ********************************************************************
                        Enter A Location Form
  ********************************************************************
  -->
                    <div class="form">
                        <form class="form-horizontal" method="POST" action="/convertAddress">
                            {{ csrf_field() }}

                            <div class="col-md-6">
                                Medicine: <input id="searchBar" type="text" class="form-control" name="medicineSearched" placeholder="search medicine" required>
                                @if (Auth::check())
                                Address:<input id="address" type="text" class="form-control" name="address" placeholder="enter address" required value="{{Auth::user()->address.' '.Auth::user()->society.' '.Auth::user()->city}}">
                                @else
                                Address:<input id="address" type="text" class="form-control" name="address" placeholder="enter address" required>
                                @endif
                                Distance(km):<input id="distance" type="number" class="form-control" name="distance" value="1" placeholder="enter distance" required>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Search Medicine
                                        </button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection @section('script')
<script>
    var latitude = document.getElementById("latitude");
    var longitude = document.getElementById("longitude");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        latitude.value = position.coords.latitude;
        longitude.value = position.coords.longitude;
    }

    // Show Div
    function showDiv(selectedOne) {
        $('.showForm').each(function (index) {
            if ($(this).attr("id") == selectedOne) {
                $(this).toggle(200);
                if(selectedOne == 'detectLocation'){
                    getLocation();
                }
            } else {
                $(this).hide(400);
            }
        });
    }
</script>
@endsection