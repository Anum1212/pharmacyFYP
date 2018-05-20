@extends('layouts.siteView') @section('body')
<div class="wrapper">
        @foreach($searchedProducts as $searchedProduct) @foreach($searchedProduct as $product)
        <div class="card col-md-4">
                @if($product->type=='1')
                <!-- 1 = Tablet -->
                <img src={{ asset( 'storage/myAssets/tablet.png') }}> @elseif($product->type=='2')
                <!-- 2 = Capsule -->
                <img src={{ asset( 'storage/myAssets/capsule.png') }}> @elseif($product->type=='3')
                <!-- 3 = Syrup -->
                <img src={{ asset( 'storage/myAssets/syrup.png') }}> @elseif($product->type=='4')
                <!-- 4 = Inhaler -->
                <img src={{ asset( 'storage/myAssets/inhaler.png') }}> @elseif($product->type=='5')
                <!-- 5 = Drops -->
                <img src={{ asset( 'storage/myAssets/drops.png') }}> @elseif($product->type=='6')
                <!-- 6 = Injection -->
                <img src={{ asset( 'storage/myAssets/injection.png') }}> @elseif($product->type=='7')
                <!-- 7 = Cream -->
                <img src={{ asset( 'storage/myAssets/cream.png') }}> @endif

                <h3>{{$product->name}}</h3>
                <p>Price: {{$product->price}}</p>
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
                @endif @foreach($nearByPharmacies as $nearByPharmacy) @if($product->pharmacistId == $nearByPharmacy->id)
                <p class="title">Sold By:
                        <a href="/pharmacyDetails/{{$nearByPharmacy->id}}/{{$product->id}}">{{$nearByPharmacy->pharmacyName}} </a>
                </p>
                @endif @endforeach

                <a href="/addToCart/{{$product->id}}">
                        <i class="fas fa-cart-plus"></i> Add to cart</a>
        </div>

        @endforeach @endforeach
</div>
@endsection