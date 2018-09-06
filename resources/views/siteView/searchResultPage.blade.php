@extends('layouts.siteLayout') @section('tabTitle', 'Search Result') @section('head') @endsection @section('style') @endsection
@section('body')

{{-- including medicine notify modal --}}
@include('includes.notifyModal');

<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
        <div class="container">
                <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                <div class="leftbar p-r-20 p-r-0-sm">
                                        <div class="search-product pos-relative bo4 of-hidden">
                                                <form action="/searchMedicine" method="get">
                                                        <input id="medicineSearched" class="s-text7 size6 p-l-23 p-r-50" type="text" name="medicineSearched" placeholder="Search Products..."
                                                                @if(session()->has('medicineSearched')) value="{{ session('medicineSearched') }}"
                                                        @endif required>
                                                        <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                                                <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                                                        </button>
                                                </form>
                                        </div>
                                        <br>
                                        <br>
                                        <!--  -->
                                        <h4 class="m-text14 p-b-7">
                                                Categories
                                        </h4>

                                        <ul class="p-b-54">
                                                <li class="p-t-4">
                                                        <form action="/searchMedicineByCategory/category1" id="categoryForm1" method="get">
                                                                <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif
                                                                style="display:none">
                                                                <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif
                                                                style="display:none">
                                                                <a href="" onClick="submitCategoryForm(event, 1)" class="s-text13 active1">
                                                                        Medicine
                                                                </a>
                                                        </form>
                                                </li>

                                                <li class="p-t-4">
                                                        <form action="/searchMedicineByCategory/category2" id="categoryForm2" method="get">
                                                                <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif
                                                                style="display:none">
                                                                <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif
                                                                style="display:none">
                                                                <a href="" onClick="submitCategoryForm(event, 2)" class="s-text13">
                                                                        Proteins and Suppliments
                                                                </a>
                                                        </form>
                                                </li>

                                                <li class="p-t-4">
                                                        <form action="/searchMedicineByCategory/category3" id="categoryForm3" method="get">
                                                                <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif
                                                                style="display:none">
                                                                <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif
                                                                style="display:none">
                                                                <a href="" onClick="submitCategoryForm(event, 3)" class="s-text13">
                                                                        Baby and Mom
                                                                </a>
                                                        </form>
                                                </li>

                                                <li class="p-t-4">
                                                        <form action="/searchMedicineByCategory/category4" id="categoryForm4" method="get">
                                                                <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif
                                                                style="display:none">
                                                                <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif
                                                                style="display:none">
                                                                <a href="" onClick="submitCategoryForm(event, 4)" class="s-text13">
                                                                        Beauty
                                                                </a>
                                                        </form>
                                                </li>

                                                <li class="p-t-4">
                                                        <form action="/searchMedicineByCategory/category5" id="categoryForm5" method="get">
                                                                <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif
                                                                style="display:none">
                                                                <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif
                                                                style="display:none">
                                                                <a href="" onClick="submitCategoryForm(event, 5)" class="s-text13">
                                                                        HouseHold
                                                                </a>
                                                        </form>
                                                </li>

                                                <li class="p-t-4">
                                                        <form action="/searchMedicineByCategory/category6" id="categoryForm6" method="get">
                                                                <input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif
                                                                style="display:none">
                                                                <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif
                                                                style="display:none">
                                                                <a href="" onClick="submitCategoryForm(event, 6)" class="s-text13">
                                                                        Others
                                                                </a>
                                                        </form>
                                                </li>
                                        </ul>
                                </div>
                        </div>

                        <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">

                                <!-- Product -->
                                <div class="row">
                                        @foreach($productsCollection as $product)
                                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50 m-t-60">
                                                <!-- Block2 -->
                                                <div class="block2">
                                                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                                                @if($product->type=='1')
                                                                <!-- 1 = Tablet -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/tablet.png') }}> @elseif($product->type=='2')
                                                                <!-- 2 = Capsule -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/capsule.png') }}> @elseif($product->type=='3')
                                                                <!-- 3 = Syrup -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/syrup.png') }}> @elseif($product->type=='4')
                                                                <!-- 4 = Inhaler -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/inhaler.png') }}> @elseif($product->type=='5')
                                                                <!-- 5 = Drops -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/drops.png') }}> @elseif($product->type=='6')
                                                                <!-- 6 = Injection -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/injection.png') }}> @elseif($product->type=='7')
                                                                <!-- 7 = Cream -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/cream.png') }}> @elseif($product->type=='8')
                                                                <!-- 8 = Others -->
                                                                <img class="img-responsive" style="height:150px; width:150px" src={{ asset( 'storage/myAssets/others.png') }}> @endif

                                                                <div class="block2-overlay trans-0-4">

                                                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                                                                @if($product->quantity == 0)
                                                                                <!-- Button out of stock -->
                                                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" disabled>Out of stock</button>
                                                                                @else
                                                                                <!-- Button add to cart-->
                                                                                <a href="/addToCart/{{ $product->id }}/{{ $product->pharmacistId }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">Add to cart</a>
                                                                                @endif
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="block2-txt p-t-20">
                                                                @if($product->quantity == 0)
                                                                <span style="color:#F15540">
                                                                        <b>Out of stock</b>
                                                                </span>
                                                                @endif
                                                                <br>
                                                                <a href="/medicineDetails/{{ $product->id }}/{{ $product->pharmacistId }}" class="block2-name dis-block s-text3 p-b-5">
                                                                        <b>{{ $product->name }}
                                                                                <br> {{ $product->genericName }}
                                                                        </b>
                                                                </a>
                                                                @if($product->type=='1')
                                                                <!-- 1 = Tablet -->
                                                                Type: Tablet {{ $product->tablets }} tbs @elseif($product->type=='2')
                                                                <!-- 2 = Capsule -->
                                                                Type: Capsule {{ $product->tablets }} tbs @elseif($product->type=='3')
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
                                                                <!-- 7 = Cream -->
                                                                Type: Others @endif
                                                                <br> @if($product->type=='1' || $product->type=='2' || $product->type=='7')
                                                                <!-- 1 = Tablet -->
                                                                Dosage: {{$product->dosage}} mg @elseif($product->type=='8')
                                                                <!-- 8 = Others -->
                                                                Dosage/Weight: {{ $product->dosage }} @else Dosage: {{$product->dosage}} ml @endif
                                                                <br> @if($product->prescription=='1')
                                                                <span style="color:red"> Prescription Required </span>
                                                                @endif
                                                                <br> Manufacturer:
                                                                <span style="color:brown; font-weight:bold">{{ $product->manufacturer }}</span>
                                                                <br> @foreach($nearByPharmacies as $nearByPharmacy) @if($product->pharmacistId
                                                                == $nearByPharmacy->id) Sold By:
                                                                <a href="/pharmacyDetails/{{ $nearByPharmacy->id }}/{{ $product->id }}">
                                                                        <span style="color:brown; font-weight:bold">{{ $nearByPharmacy->pharmacyName }} </span>
                                                                </a>
                                                                @endif @endforeach
                                                                <br>
                                                                <span class="block2-price m-text6 p-r-5">
                                                                        <b> Rs {{ $product->price }} </b>
                                                                </span>
                                                        </div>
                                                </div>
                                        </div>
                                        @endforeach
                                </div>

                                <!-- Pagination -->
                                <div class="pagination flex-m flex-w p-t-26">
                                        {{--
                                        <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
                                        <a href="#" class="item-pagination flex-c-m trans-0-4">2</a> --}}
                                </div>
                        </div>
                </div>
        </div>
</section>
@endsection @section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb86GIW2pKc-uVB8LdJrP_YKsYj7LedUo">
</script>

<script type="text/javascript" src="{{ URL::asset('js/searchBar.js') }}"></script>
@endsection
