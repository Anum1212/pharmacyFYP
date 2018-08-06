@extends('layouts.siteLayout') 
@section('tabTitle', $pharmacy->pharmacyName .' Details') 
@section('head')
<link href="{{ asset('css/map.css') }}" rel="stylesheet">
<link href="{{ asset('css/siteView/rated.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection
 
@section('style')
@endsection
 
@section('body')
<!-- Pharmacy Details -->
<div class="container bgwhite p-t-35 p-b-80">
        <div class="flex-w flex-sb">
                <div class="w-size13 p-t-30 respon5">
                        <div class="wrap-slick3 flex-sb flex-w">
                                <div></div>

                                <div class="slick3">
                                        <div class="item-slick3" data-thumb="/themeAssets/images/thumb-item-01.jpg">
                                                <div id="map">
                                                </div>
                                        </div>

                                </div>
                        </div>
                </div>

                <div class="w-size14 p-t-30 respon5">
                        <h4 class="product-detail-name m-text16 p-b-13">
                                {{ $pharmacy->pharmacyName }}
                        </h4>

                        <p class="s-text8 p-t-10">
                                <b>Email</b> &emsp;&emsp; {{$pharmacy->email}}
                                <br>
                                <b>Contact</b> &emsp; {{$pharmacy->contact}}
                                <br>
                                <b>Address</b> &emsp; {{$pharmacy->address .' '. $pharmacy->society .', '.$pharmacy->city}}
                        </p>

                        <!--  -->
                        <div class="bo6 p-t-15 p-b-14">
                                <h5 class="flex-sb-m m-text19 trans-0-4">
                                        <fieldset class="rating">
                                                <input disabled <?php if($pharmacyRating->rating=="5") echo 'checked="checked"';
                                                ?> type="radio" id="star5" name="rating" value="5" />
                                                <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="4.5") echo 'checked="checked"';
                                                ?> type="radio" id="star4half" name="rating" value="4.5" />
                                                <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="4") echo 'checked="checked"';
                                                ?> type="radio" id="star4" name="rating" value="4" />
                                                <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="3.5") echo 'checked="checked"';
                                                ?> type="radio" id="star3half" name="rating" value="3.5" />
                                                <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="3") echo 'checked="checked"';
                                                ?> type="radio" id="star3" name="rating" value="3" />
                                                <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="2.5") echo 'checked="checked"';
                                                ?> type="radio" id="star2half" name="rating" value="2.5" />
                                                <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="2") echo 'checked="checked"';
                                                ?> type="radio" id="star2" name="rating" value="2" />
                                                <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="1.5") echo 'checked="checked"';
                                                ?> type="radio" id="star1half" name="rating" value="1.5" />
                                                <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="1") echo 'checked="checked"';
                                                ?> type="radio" id="star1" name="rating" value="1" />
                                                <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                <input disabled <?php if($pharmacyRating->rating=="0.5") echo 'checked="checked"';
                                                ?> type="radio" id="starhalf" name="rating" value="0.5" />
                                                <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                        </fieldset>


                                </h5>
                        </div>
                </div>
        </div>
</div>


<!-- Pharmacy Products -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
        <div class="container">
                <div class="sec-title p-b-60">
                        <h3 class="m-text5 t-center">
                                Available Products
                        </h3>
                </div>

                <!-- Slide2 -->
                <div class="row t-center">

                        {{-- Selected Product --}} @if(!empty($selectedProduct))
                        <div class="col-6 col-md-3 m-t-60">
                                <!-- Block2 -->
                                <div class="block2">
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                                @if($selectedProduct->type=='1')
                                                <!-- 1 = Tablet -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/tablet.png') }}>                                                @elseif($selectedProduct->type=='2')
                                                <!-- 2 = Capsule -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/capsule.png') }}>                                                @elseif($selectedProduct->type=='3')
                                                <!-- 3 = Syrup -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/syrup.png') }}>                                                @elseif($selectedProduct->type=='4')
                                                <!-- 4 = Inhaler -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/inhaler.png') }}>                                                @elseif($selectedProduct->type=='5')
                                                <!-- 5 = Drops -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/drops.png') }}>                                                @elseif($selectedProduct->type=='6')
                                                <!-- 6 = Injection -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/injection.png') }}>                                                @elseif($selectedProduct->type=='7')
                                                <!-- 7 = Cream -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/injection.png') }}>                                                @elseif($selectedProduct->type=='8')
                                                <!-- 8 = Others -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/others.png') }}>                                                @endif

                                                <div class="block2-overlay trans-0-4">

                                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                                                @if($selectedProduct->quantity == 0)
                                                                <!-- Button out of stock -->
                                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" disabled>Out of stock</button>                                                                @else
                                                                <!-- Button add to cart-->
                                                                <a href="/addToCart/{{ $selectedProduct->id }}/{{ $selectedProduct->pharmacistId }}"
                                                                        class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>                                                                @endif
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                                @if($selectedProduct->quantity == 0)
                                                <span style="color:#F15540"><b>Out of stock</b></span> @endif
                                                <br>
                                                <a href="/medicineDetails/{{ $selectedProduct->id }}" class="block2-name dis-block s-text3 p-b-5">
                                                        <b>{{ $selectedProduct->name }}
                                                                <br> {{ $selectedProduct->genericName }}
                                                        </b>
                                                </a> @if($selectedProduct->type=='1')
                                                <!-- 1 = Tablet -->
                                                Type: Tablet {{ $selectedProduct->tablets }} tbs @elseif($selectedProduct->type=='2')
                                                <!-- 2 = Capsule -->
                                                Type: Capsule {{ $selectedProduct->tablets }} tbs @elseif($selectedProduct->type=='3')
                                                <!-- 3 = Syrup -->
                                                Type: Syrup @elseif($selectedProduct->type=='4')
                                                <!-- 4 = Inhaler -->
                                                Type: Inhaler @elseif($selectedProduct->type=='5')
                                                <!-- 5 = Drops -->
                                                Type: Drops @elseif($selectedProduct->type=='6')
                                                <!-- 6 = Injection -->
                                                Type: Injection @elseif($selectedProduct->type=='7')
                                                <!-- 7 = Cream -->
                                                Type: Cream @elseif($selectedProduct->type=='8')
                                                <!-- 8 = Others -->
                                                Type: Others @endif
                                                <br> @if($selectedProduct->type=='1' || $selectedProduct->type=='2'
                                                || $selectedProduct->type=='7')
                                                <!-- 1 = Tablet -->
                                                Dosage: {{ $selectedProduct->dosage }} mg @elseif($selectedProduct->type=='1' || $selectedProduct->type=='2' ||
                                                $selectedProduct->type=='7') Dosage/Weight: {{ $selectedProduct->dosage
                                                }} @else Dosage: {{ $selectedProduct->dosage }} ml @endif
                                                <br> @if($selectedProduct->prescription=='1')
                                                <span style="color:red"> Prescription Required </span> @endif
                                                <br> Manufacturer:
                                                <span style="color:brown; font-weight:bold">{{ $selectedProduct->manufacturer }}</span>
                                                <br>
                                                <span class="block2-price m-text6 p-r-5">
                                                        <b> Rs {{ $selectedProduct->price }} </b>
                                                </span>
                                        </div>
                                </div>
                        </div>
                        @endif {{-- all pharmacy products --}} @foreach($pharmacyProducts as $product)
                        <div class="col-6 col-md-3 m-t-60">
                                <!-- Block2 -->
                                <div class="block2">
                                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                                @if($product->type=='1')
                                                <!-- 1 = Tablet -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/tablet.png') }}>                                                @elseif($product->type=='2')
                                                <!-- 2 = Capsule -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/capsule.png') }}>                                                @elseif($product->type=='3')
                                                <!-- 3 = Syrup -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/syrup.png') }}>                                                @elseif($product->type=='4')
                                                <!-- 4 = Inhaler -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/inhaler.png') }}>                                                @elseif($product->type=='5')
                                                <!-- 5 = Drops -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/drops.png') }}>                                                @elseif($product->type=='6')
                                                <!-- 6 = Injection -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/injection.png') }}>                                                @elseif($product->type=='7')
                                                <!-- 7 = Cream -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/cream.png') }}>                                                @elseif($product->type=='8')
                                                <!-- 7 = Cream -->
                                                <img class="img-responsive" style="height:160px; max-width:160px" src={{ asset( 'storage/myAssets/others.png') }}>                                                @endif

                                                <div class="block2-overlay trans-0-4">

                                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                                                @if($product->quantity == 0)
                                                                <!-- Button out of stock -->
                                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" disabled>Out of stock</button>                                                                @else
                                                                <!-- Button add to cart-->
                                                                <a href="/addToCart/{{ $product->id }}/{{ $product->pharmacistId }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>                                                                @endif
                                                        </div>
                                                </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                                @if($product->quantity == 0)
                                                <span style="color:#F15540"><b>Out of stock</b></span> @endif
                                                <br>
                                                <a href="/medicineDetails/{{ $product->id }}" class="block2-name dis-block s-text3 p-b-5">
                                                        <b>{{ $product->name }}
                                                                <br> {{ $product->genericName }}
                                                        </b>
                                                </a> @if($product->type=='1')
                                                <!-- 1 = Tablet -->
                                                Type: Tablet {{$product->tablets}} tbs @elseif($product->type=='2')
                                                <!-- 2 = Capsule -->
                                                Type: Capsule {{$product->tablets}} tbs @elseif($product->type=='3')
                                                <!-- 3 = Syrup -->
                                                Type: Syrup @elseif($product->type=='4')
                                                <!-- 4 = Inhaler -->
                                                Type: Inhaler @elseif($product->type=='5')
                                                <!-- 5 = Drops -->
                                                Type: Drops @elseif($product->type=='6')
                                                <!-- 6 = Injection -->
                                                Type: Injection @elseif($product->type=='7')
                                                <!-- 7 = Cream -->
                                                Type: Cream @elseif($product->type=='8')
                                                <!-- 8 = Others -->
                                                Type: Others @endif
                                                <br> @if($product->type=='1' || $product->type=='2' || $product->type=='7')
                                                <!-- 1 = Tablet -->
                                                Dosage: {{$product->dosage}} mg @elseif($product->type=='8') Dosage/Weight: {{$product->dosage}} mg @else Dosage: {{$product->dosage}}
                                                ml @endif
                                                <br> @if($product->prescription=='1')
                                                <span style="color:red"> Prescription Required </span> @endif
                                                <br> Manufacturer:
                                                <span style="color:brown; font-weight:bold">{{ $product->manufacturer }}</span>
                                                <br>
                                                <span class="block2-price m-text6 p-r-5">
                                                        <b> Rs {{ $product->price }} </b>
                                                </span>
                                        </div>
                                </div>
                        </div>
                        @endforeach
                </div>

        </div>
</section>
@endsection
 
@section('script')
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