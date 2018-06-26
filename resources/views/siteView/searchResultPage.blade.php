@extends('layouts.siteView') @section('body')

@include('includes.searchBar')

@section('searchBar')
                        <li class="dropdown">
                        <a href="#" type="botton" style="color:white" onclick="showSearchDiv()">
                            <em class="fa fa-search"></em>
                        </a>
                    </li>
@endsection

<div class="wrapper container">
<div class="row">
        <div class="searchResultHeading col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Search 
                @if(session()->has('medicineSearched')) 
                {{ session('medicineSearched') }}
                 @endif
        </div>
@foreach($searchedProductsMergeCollection as $product)
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
                        @foreach($nearByPharmacies as $nearByPharmacy) @if($product->pharmacistId == $nearByPharmacy->id)
                        <p class="title">Sold By:
                                <a href="/pharmacyDetails/{{$nearByPharmacy->id}}/{{$product->id}}">{{$nearByPharmacy->pharmacyName}} </a>
                        </p>
                        @endif
                        @endforeach
                       
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
 @endsection
@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb86GIW2pKc-uVB8LdJrP_YKsYj7LedUo">
</script>

<script>
    $(document).ready(function () {
        $('.searchDiv').hide();
    });

    function showSearchDiv(){
        $('.searchDiv').toggle();
    }
</script>
<script type="text/javascript" src="{{ URL::asset('js/searchBar.js') }}"></script>
@endsection