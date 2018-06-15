@extends('layouts.siteView') @section('head')
<script src="{{asset('customFiles/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('customFiles/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('customFiles/js/bootstrap-confirmation.min.js')}}"></script>
<script src="{{asset('js/dataTableTop.js')}}"></script>
<link rel="stylesheet" href="{{asset('customFiles/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('customFiles/css/custom_app.css')}}"> @endsection @section('style')
<style>

  #distance{
    width: 55px;
  }
.form-group{
  margin: 0 25px 0 25px;
}
  div.dataTables_wrapper div.dataTables_length label {
    display: none;
  }

  div.dataTables_wrapper div.dataTables_filter input {
    display: none;
  }

  div.dataTables_wrapper div.dataTables_filter label {
    display: none;
  }
</style>
@endsection @section('body')


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
        <form class="form-inline" role="form">

          <div class="form-group">
            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Results/Page:</label>
            <select id="pref-perpage" class="form-control">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>



          <div class="form-group">
            <label class="filter-col" for="pref-perpage">Distance:</label>
            <div class="input-group">
              <span class="input-group-btn">
                <button type="button" class="quantity-left-minus btn btn-danger btn-number btn-sm" data-type="minus" data-field="">
                  <span class="fa fa-minus"></span>
                </button>
              </span>
              <input type="text" id="distance" name="distance" class="form-control input-number" value="10" min="1" max="100">
              <span class="input-group-btn">
                <button type="button" class="quantity-right-plus btn btn-success btn-number btn-sm" data-type="plus" data-field="">
                  <span class="fa fa-plus"></span>
                </button>
              </span>
            </div>
          </div>


          <!-- form group [order by] -->
          <div class="form-group">
            <label class="filter-col" for="pref-search">Search:</label>
            <input type="text" class="form-control input-sm" id="search" placeholder="Search here" onkeypress="getMedicineDetails()">
          </div>
          <!-- form group [search] -->

          <form>
            {{csrf_field()}}

            <div class="form-group">
              <label class="filter-col" style="margin-right:0;" for="pref-perpage">Sort By:</label>
              <select id="pref-perpage" class="form-control">
                <option value="1">Name</option>
                <option value="2">Generic Name</option>
              </select>
            </div>
            <button type="button" class="btn btn-danger btn-sm filter-col" onclick="getVal()">
              Search
            </button>
          </form>
    </form>
    <table class="table table-striped" id="patientCategory">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Generic</th>
      <th>Action</th>

    </tr>
  </thead>
</table>
  </div>
</div>
</div>
</div>

</form>
</div> {{-- medicineForm --}}
</div> {{-- medicineForm --}}
</div> {{-- row --}}
</div> {{-- Container --}}
</div> {{-- Wrapper --}}

<form name="searchMedicneForm" id="searchMedicneForm" method="post" action="searchAskMed" /> {{ csrf_field() }}
<input type="hidden" name="medId" id="medId" />
<input type="hidden" name="distance" id="distance" />
<input type="hidden" name="latitude" id="lat" value="">
<input type="hidden" name="longitude" id="lng" value="">
</form>


@endsection @section('script')
<script src="{{asset('js/dataTableBottom.js')}}"></script>
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