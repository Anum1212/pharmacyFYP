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
</div>
<div class="panel-body">
    <div id="map">
    </div>
</div><!-- /panel-body -->

@if(!empty($selectedProduct))
<div class="selectedProduct col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card col-md-4">
                @if($selectedProduct->type=='1')
                <!-- 1 = Tablet -->
                <img src={{ asset( 'storage/myAssets/tablet.png') }}> @elseif($selectedProduct->type=='2')
                <!-- 2 = Capsule -->
                <img src={{ asset( 'storage/myAssets/capsule.png') }}> @elseif($selectedProduct->type=='3')
                <!-- 3 = Syrup -->
                <img src={{ asset( 'storage/myAssets/syrup.png') }}> @elseif($selectedProduct->type=='4')
                <!-- 4 = Inhaler -->
                <img src={{ asset( 'storage/myAssets/inhaler.png') }}> @elseif($selectedProduct->type=='5')
                <!-- 5 = Drops -->
                <img src={{ asset( 'storage/myAssets/drops.png') }}> @elseif($selectedProduct->type=='6')
                <!-- 6 = Injection -->
                <img src={{ asset( 'storage/myAssets/injection.png') }}> @elseif($selectedProduct->type=='7')
                <!-- 7 = Cream -->
                <img src={{ asset( 'storage/myAssets/cream.png') }}> @endif

                <h3>{{$selectedProduct->name}}</h3>
                <p>Price: {{$selectedProduct->price}}</p>
                @if($selectedProduct->type=='1')
                <!-- 1 = Tablet -->
                <p class="title">Type: Tablet</p>
                @elseif($selectedProduct->type=='2')
                <!-- 2 = Capsule -->
                <p class="title">Type: Capsule </p>
                @elseif($selectedProduct->type=='3')
                <!-- 3 = Syrup -->
                <p class="title">Type: Syrup</p>
                @elseif($selectedProduct->type=='4')
                <!-- 4 = Inhaler -->
                <p class="title">Type: Inhaler</p>
                @elseif($selectedProduct->type=='5')
                <!-- 5 = Drops -->
                <p class="title">Type: Drops</p>
                @elseif($selectedProduct->type=='6')
                <!-- 6 = Injection -->
                <p class="title">Type: Injection</p>
                @elseif($selectedProduct->type=='7')
                <!-- 7 = Cream -->
                <p class="title">Type: Cream</p>
                @endif @if($selectedProduct->type=='1' || $selectedProduct->type=='2' || $selectedProduct->type=='7')
                <!-- 1 = Tablet -->
                <p class="title">Dosage: {{$selectedProduct->dosage}} mg</p>
                @else
                <p class="title">Dosage: {{$selectedProduct->dosage}} ml</p>
                @endif

                <a href="/addToCart/{{$selectedProduct->id}}">
                        <i class="fas fa-cart-plus"></i> Add to cart</a>
        </div>
</div>
@endif

<div class="allProducts col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @foreach($pharmacyProducts as $pharmacyProduct)
        <div class="card col-md-4">
                @if($pharmacyProduct->type=='1')
                <!-- 1 = Tablet -->
                <img src={{ asset( 'storage/myAssets/tablet.png') }}> @elseif($pharmacyProduct->type=='2')
                <!-- 2 = Capsule -->
                <img src={{ asset( 'storage/myAssets/capsule.png') }}> @elseif($pharmacyProduct->type=='3')
                <!-- 3 = Syrup -->
                <img src={{ asset( 'storage/myAssets/syrup.png') }}> @elseif($pharmacyProduct->type=='4')
                <!-- 4 = Inhaler -->
                <img src={{ asset( 'storage/myAssets/inhaler.png') }}> @elseif($pharmacyProduct->type=='5')
                <!-- 5 = Drops -->
                <img src={{ asset( 'storage/myAssets/drops.png') }}> @elseif($pharmacyProduct->type=='6')
                <!-- 6 = Injection -->
                <img src={{ asset( 'storage/myAssets/injection.png') }}> @elseif($pharmacyProduct->type=='7')
                <!-- 7 = Cream -->
                <img src={{ asset( 'storage/myAssets/cream.png') }}> @endif

                <h3>{{$pharmacyProduct->name}}</h3>
                <p>Price: {{$pharmacyProduct->price}}</p>
                @if($pharmacyProduct->type=='1')
                <!-- 1 = Tablet -->
                <p class="title">Type: Tablet</p>
                @elseif($pharmacyProduct->type=='2')
                <!-- 2 = Capsule -->
                <p class="title">Type: Capsule </p>
                @elseif($pharmacyProduct->type=='3')
                <!-- 3 = Syrup -->
                <p class="title">Type: Syrup</p>
                @elseif($pharmacyProduct->type=='4')
                <!-- 4 = Inhaler -->
                <p class="title">Type: Inhaler</p>
                @elseif($pharmacyProduct->type=='5')
                <!-- 5 = Drops -->
                <p class="title">Type: Drops</p>
                @elseif($pharmacyProduct->type=='6')
                <!-- 6 = Injection -->
                <p class="title">Type: Injection</p>
                @elseif($pharmacyProduct->type=='7')
                <!-- 7 = Cream -->
                <p class="title">Type: Cream</p>
                @endif @if($pharmacyProduct->type=='1' || $pharmacyProduct->type=='2' || $pharmacyProduct->type=='7')
                <!-- 1 = Tablet -->
                <p class="title">Dosage: {{$pharmacyProduct->dosage}} mg</p>
                @else
                <p class="title">Dosage: {{$pharmacyProduct->dosage}} ml</p>
                @endif

                <a href="/addToCart/{{$pharmacyProduct->id}}">
                        <i class="fas fa-cart-plus"></i> Add to cart</a>
        </div>

        @endforeach

        {{ $pharmacyProducts->links() }}
</div>



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