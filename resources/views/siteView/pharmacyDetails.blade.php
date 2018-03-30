@extends('layouts.app') 

@section('style') 
<style>
    .map{
        width: 100%;
        height: 90vh;
        padding-top: 15%;
        border: 2px solid black;
        text-align:center;
        font-size: 2em;
        color: green;

    }
</style>
@endsection 

@section('content')
<div class="wrapper">
<div class="map">
    <p>
    Map will be displayed here
    </p>
</div>
<div class="details">
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