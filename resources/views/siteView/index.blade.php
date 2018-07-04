@extends('layouts.siteLayout')

@section('tabTitle', 'Home')

@section('head')
    
@endsection

@section('style')
    
@endsection
@section('body')

	<!-- Slider -->
	<section class="slide1" style="margin-top: -100px">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(/themeAssets/images/sliderImage01.jpg); background-position:left 0px top -90px;">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown" style="color:black">
							{{-- Women Collection 2018 --}}
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp" style="color:#5A5A5B">
							Health Delivered <br> to <br> your DoorSteps
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="#searchBarWrapper" class="scrollToDiv flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4" style="background-color: #E65540;">
								<i class="fa fa-caret-down" style="color:#fff; font-size:45px"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(/themeAssets/images/sliderImage02.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
							{{-- Women Collection 2018 --}}
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn" style="color:#5A5A5B">
							Quick <br> Delivery
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="#searchBarWrapper" class="scrollToDiv flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4" style="background-color: #E65540;">
								<i class="fa fa-caret-down" style="color:#fff; font-size:45px"></i>
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-image: url(/themeAssets/images/sliderImage03.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rotateInDownLeft">
							{{-- Women Collection 2018 --}}
						</span>

						<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rotateInUpRight" style="color:#fff">
							Cash <br> On <br> Delivery
						</h2>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
							<!-- Button -->
							<a href="#searchBarWrapper" class="scrollToDiv flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4" style="background-color: #E65540;">
								<i class="fa fa-caret-down" style="color:#fff; font-size:45px"></i>
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

    <div id="searchBarWrapper" class="wrapper container">
		<div class="heading text-center"><h2>Find Pharmacies Nearby</h2></div>
		<br>
		<br>
		<br>

@include('includes.searchBar')
</div> {{-- searchBarWrapper --}} 

<hr>
	<!-- Banner -->
	<div class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
			<div class="heading text-center"><h2>Categories</h2></div>
		<br>
		<br>
		<br>
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="/themeAssets/images/medicine2.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<form action="searchMedicineByCategory/1" method="get">
							<!-- Button -->
							<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
							<button type="submit" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Medicine 
							</button>
						</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="/themeAssets/images/supplements.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<form action="searchMedicineByCategory/2" method="get">
							<!-- Button -->
							<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
							<button type="submit" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
							Suppliments 
							</button>
						</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="/themeAssets/images/baby.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<form action="searchMedicineByCategory/3" method="get">
							<!-- Button -->
							<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
							<button type="submit" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Baby and Mom 
							</button>
						</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="/themeAssets/images/beauty.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<form action="searchMedicineByCategory/4" method="get">
							<!-- Button -->
							<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
							<button type="submit" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Beauty 
							</button>
						</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="/themeAssets/images/household.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<form action="searchMedicineByCategory/5" method="get">
							<!-- Button -->
							<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
							<button type="submit" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								HouseHold 
							</button>
						</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="/themeAssets/images/others.png" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<form action="searchMedicineByCategory/6" method="get">
							<!-- Button -->
							<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
                        <input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
							<button type="submit" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
								Others
							</button>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb86GIW2pKc-uVB8LdJrP_YKsYj7LedUo">
</script>
<script type="text/javascript" src="{{ URL::asset('js/searchBar.js') }}"></script>

<script>
    $(document).ready(function () {
		if($('#address').val().length == 0)
		$('.medicineForm').hide();

		// get Location on window load
		getLocation();

		// Add smooth scrolling to all links
  $(".scrollToDiv").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
    });
</script>
@endsection