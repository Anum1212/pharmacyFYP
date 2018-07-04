@extends('layouts.siteLayout') 

@section('tabTitle', 'Cart')

@section('head') @endsection 

@section('style')
<style>
	input[type=date]::-webkit-inner-spin-button, 
input[type=date]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
@endsection @section('body')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/themeAssets/images/cartBackground.jpg);">
	<h2 class=" t-center">
		Cart
	</h2>
</section>
<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
	<div class="container">
		@if(Cart::count()==0) No Items in Cart @else
		<!-- Cart item -->
		<div class="container-table-cart pos-relative">
			<div class="wrap-table-shopping-cart bgwhite">
				<table class="table-shopping-cart">
					<tr class="table-head">
						<th class="column-1">#</th>
						<th class="column-2">Product</th>
						<th class="column-3">Price</th>
						<th class="column-4 p-l-70">Quantity</th>
						<th class="column-5 p-3">Seller</th>
						<th class="column-6 p-3">Prescription</th>
						<th class="column-7 p-3">Total</th>
						<th class="column-8 p-3">Remove</th>
					</tr>
					<form action="/updateCart" method="post">
						{{ csrf_field() }} @foreach(Cart::content() as $row)
						<tr class="table-row">
							<td class="column-1">
								{{ $loop->iteration }}
							</td>
							<td class="column-2">{{$row->name}}</td>
							<td class="column-3">RS {{$row->price}}</td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="qty[]" max="99" min="1" maxlength="2" value="{{$row->qty}}">

									<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
									</button>
								</div>
							</td>
							<td class="column-5">
								<a href="{{'/pharmacyDetails/'.$row->options->pharmacistId}}">{{$row->options->pharmacistName}}</a>
							</td>
							<td class="column-6">@if($row->options->prescription==0)
								<!-- 0 = Not Required -->
								Not Required @elseif($row->options->prescription==1)
								<!-- 1 = Required -->
								<span style="color:red"> Required </span>@endif
							</td>
							<td class="column-7">{{$row->total}}</td>
							<td class="column-8">
								<a href="{{'/removeFromCart/'.$row->rowId}}">
									<i class="fa fa-trash" style="color:red"></i>
								</a>
							</td>
						</tr>
						@endforeach
				</table>
			</div>
		</div>

		<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">

			<div class="size10 trans-0-4 m-t-10 m-b-10">
				<!-- Button -->
				<button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
					Update Cart
				</button>
				</form>
			</div>
		</div>

		<!-- Total -->
		<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
			<h5 class="m-text20 p-b-24">
				Cart Totals
			</h5>

			<!--  -->
			<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
				<span class="s-text18 w-size19 w-full-sm">
					Shipping:
				</span>

				{{-- <div class="w-size20 w-full-sm">
					<p class="s-text8 p-b-23">
						There are no shipping methods available. Please double check your address, or contact us if you need any help.
					</p>
				</div> --}}
			</div>

			<!--  -->
			<div class="flex-w flex-sb-m p-t-26 p-b-30">
				<span class="m-text22 w-size19 w-full-sm">
					Total:
				</span>

				<span class="m-text21 w-size20 w-full-sm">
					{{Cart::total()}}
				</span>
			</div>

			<form action="prescriptionUploadForm" method="POST">
				{{ csrf_field() }}
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Delivery Date:
					</span>

					<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="date" name="deliveryDate" id="deliveryDate" required>
					</div>
				</div>
						<div class="size15 trans-0-4">
							<!-- Button -->
							<input type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" value="Proceed to Checkout">
						</div>
			</form>

		</div>
	</div>
	@endif
	</div>
</section>

<div style="display: none">
	<form class="hiddenForm" action="/detectPharmacy" method="get">
		<div class="form-group">
			<input id="medicineSearched" name="medicineSearched" type="text" class="form-control" placeholder="Medicine" @if(session()->has('medicineSearched')) value="{{ session('medicineSearched') }}" @endif required>
		</div>
		<div class="form-group">
			<input id="distance" name="distance" type="number" class="form-control" placeholder="Search Radius" @if(session()->has('distance')) value="{{ session('distance') }}" @else value="10" @endif required>
		</div>
		<button type="submit" class="btn btn-primary search">Search</button>
		<br>
		<br>
		<input type="text" name="formatedAddress" id="formatedAddress" @if(session()->has('formatedAddress')) value="{{ session('formatedAddress') }}" @endif>
		<input type="text" name="latitude" id="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif>
		<input type="text" name="longitude" id="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif>
	</form>
</div>
@endsection 


@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb86GIW2pKc-uVB8LdJrP_YKsYj7LedUo">
</script>

<script>
	$(document).ready(function () {
		$('.medicineForm').hide();

		// disbale previous dates
		var today = new Date().toISOString().split('T')[0];
		 $("#deliveryDate").attr('min', today);
	});

	// disable keyboard input on date
	$(function() {
   $('#deliveryDate').keypress(function(event) {
       event.preventDefault();
       return false;
   });
});

</script>
<script type="text/javascript" src="{{ URL::asset('js/searchBar.js') }}"></script>
@endsection