@extends('layouts.siteView')
@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> 
@endsection

@section('body')





<div class="wrapper container">
<div class="row">

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
</div><!-- /panel -->
        <div class="gap col-lg-12 col-md-12 col-sm-12 col-xs-12">
              
        </div>
@if(!empty($selectedProduct))
<div class="selectedProduct col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="thumbnail">
                @if($selectedProduct->type=='1')
                <!-- 1 = Tablet -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/tablet.png') }}> @elseif($selectedProduct->type=='2')
                <!-- 2 = Capsule -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/capsule.png') }}> @elseif($selectedProduct->type=='3')
                <!-- 3 = Syrup -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/syrup.png') }}> @elseif($selectedProduct->type=='4')
                <!-- 4 = Inhaler -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/inhaler.png') }}> @elseif($selectedProduct->type=='5')
                <!-- 5 = Drops -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/drops.png') }}> @elseif($selectedProduct->type=='6')
                <!-- 6 = Injection -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/injection.png') }}> @elseif($selectedProduct->type=='7')
                <!-- 7 = Cream -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/cream.png') }}> @endif
                <div class="caption text-center">
                        <div class="row">
                                <div class="col-lg-12">
                                        <h3>{{$selectedProduct->name}}</h3>
                                </div>
                        </div>
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
                        {{-- @foreach($nearByPharmacies as $nearByPharmacy) @if($selectedProduct->pharmacistId == $nearByPharmacy->id)
                        <p class="title">Sold By:
                                <a href="/pharmacyDetails/{{$nearByPharmacy->id}}/{{$selectedProduct->id}}">{{$nearByPharmacy->pharmacyName}} </a>
                        </p>
                        @endif
                        @endforeach
                        --}}
                         @if($selectedProduct->prescription=='1')
                        <!-- 0 = prescription not required -->
                        <!-- 1 = prescription required -->
                        <p class="title">
                                <span style="color:red"> Prescription Required </span>
                        </p>
                        @endif
                        <div class="row">

                                <div class="col-lg-12 price">
                                        <h3>
                                                <label>{{$selectedProduct->price}} Rs</label>
                                        </h3>
                                </div>
                                <div class="col-lg-12">
                                <a href="/addToCart/{{$selectedProduct->id}}/{{$selectedProduct->selectedProductSource}}" class="btn btn-success btn-product" style="width: 100%">
                                                <i class="fa fa-cart-plus"></i> Add to cart</a>

                                </div>
                        </div>
                </div>
        </div>
</div>
@endif

        <div class="searchResultHeading col-lg-12 col-md-12 col-sm-12 col-xs-12">
                All Products
        </div>

@foreach($pharmacyProducts as $product)
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <div class="thumbnail">
                @if($product->type=='1')
                <!-- 1 = Tablet -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/tablet.png') }}> @elseif($product->type=='2')
                <!-- 2 = Capsule -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/capsule.png') }}> @elseif($product->type=='3')
                <!-- 3 = Syrup -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/syrup.png') }}> @elseif($product->type=='4')
                <!-- 4 = Inhaler -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/inhaler.png') }}> @elseif($product->type=='5')
                <!-- 5 = Drops -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/drops.png') }}> @elseif($product->type=='6')
                <!-- 6 = Injection -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/injection.png') }}> @elseif($product->type=='7')
                <!-- 7 = Cream -->
                <img class="img-responsive" src={{ asset( 'storage/myAssets/cream.png') }}> @endif
                <div class="caption text-center">
                        <div class="row">
                                <div class="col-lg-12">
                                        <h3>{{$product->name}}</h3>
                                </div>
                        </div>
                        @if($product->type=='1')
                        <!-- 1 = Tablet -->
                        <p class="title">Type: Tablet</p>
                        @elseif($product->type=='2')
                        <!-- 2 = Capsule -->
                        <p class="title">Type: Capsule </p>
                        @elseif($product->type=='3')
                        <!-- 3 = Syrup -->
                        <p class="title">Type: Syrup</p>
                        @elseif($product->type=='4')
                        <!-- 4 = Inhaler -->
                        <p class="title">Type: Inhaler</p>
                        @elseif($product->type=='5')
                        <!-- 5 = Drops -->
                        <p class="title">Type: Drops</p>
                        @elseif($product->type=='6')
                        <!-- 6 = Injection -->
                        <p class="title">Type: Injection</p>
                        @elseif($product->type=='7')
                        <!-- 7 = Cream -->
                        <p class="title">Type: Cream</p>
                        @endif @if($product->type=='1' || $product->type=='2' || $product->type=='7')
                        <!-- 1 = Tablet -->
                        <p class="title">Dosage: {{$product->dosage}} mg</p>
                        @else
                        <p class="title">Dosage: {{$product->dosage}} ml</p>
                        @endif 
                        {{-- @foreach($nearByPharmacies as $nearByPharmacy) @if($product->pharmacistId == $nearByPharmacy->id)
                        <p class="title">Sold By:
                                <a href="/pharmacyDetails/{{$nearByPharmacy->id}}/{{$product->id}}">{{$nearByPharmacy->pharmacyName}} </a>
                        </p>
                        @endif
                        @endforeach
                        --}}
                         @if($product->prescription=='1')
                        <!-- 0 = prescription not required -->
                        <!-- 1 = prescription required -->
                        <p class="title">
                                <span style="color:red"> Prescription Required </span>
                        </p>
                        @endif
                        <div class="row">

                                <div class="col-lg-12 price">
                                        <h3>
                                                <label>{{$product->price}} Rs</label>
                                        </h3>
                                </div>
                                <div class="col-lg-12">
                                <a href="/addToCart/{{$product->id}}/{{$product->productSource}}" class="btn btn-success btn-product" style="width: 100%">
                                                <i class="fa fa-cart-plus"></i> Add to cart</a>

                                </div>
                        </div>
                </div>
        </div>
</div>
@endforeach
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