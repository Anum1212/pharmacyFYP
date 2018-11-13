<!DOCTYPE html>
<html lang="en">

<head>

	<title>
@yield('tabTitle')
	</title>

	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{asset('/themeAssets/css/searchBar.css')}}">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/themeAssets/images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/fonts/themify/themify-icons.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/fonts/elegant-font/html-css/style.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/vendor/lightbox2/css/lightbox.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/themeAssets/css/util.css">
	<link rel="stylesheet" type="text/css" href="/themeAssets/css/main.css">
	<!--===============================================================================================-->
	<script type="text/javascript" src="{{ URL::asset('js/dashboard/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap.min.js') }}"></script>
	<!--===============================================================================================-->
@section('head')

@show

@section('style')

@show
</head>

<body class="animsition">

<div class="gap" style="margin-top: 75px">
	@include('includes.message') @include('includes.error')
</div>



<!-- Header -->
<header class="header1">
	<!-- Header desktop -->
	<div class="container-menu-header">
		<div class="topbar" style="width:0; height:0">

			{{--
			<span class="topbar-child1">
				Free shipping for standard order over $100
			</span> --}}

		</div>

		<div class="wrap_header">
			<!-- Logo -->
			<a href="/" class="logo">
				<img src="/themeAssets/images/icons/lifeLine.png" alt="IMG-LOGO"> <i class="fa fa-heartbeat" style="font-size: 40px; color:#E65641"></i>
			</a>

			<!-- Menu -->
			<div class="wrap_menu">
				<nav class="menu">
					<ul class="main_menu">
						<li>
							<a href="/">Home</a>
						</li>

						<li>
							<a href="#">Categories</a>
							<ul class="sub_menu">
								<li>
									<form action="/searchMedicineByCategory/category1" id="categoryForm1" method="get">
										<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
										<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
										<a href="" onClick="submitCategoryForm(event, 1)" class="s-text13 active1">
											Medicine
										</a>
									</form>
								</li>

								<li>
									<form action="/searchMedicineByCategory/category2" id="categoryForm2" method="get">
										<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
										<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
										<a href="" onClick="submitCategoryForm(event, 2)" class="s-text13">
											Proteins and Suppliments
										</a>
									</form>
								</li>

								<li>
									<form action="/searchMedicineByCategory/category3" id="categoryForm3" method="get">
										<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
										<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
										<a href="" onClick="submitCategoryForm(event, 3)" class="s-text13">
											Baby and Mom
										</a>
									</form>
								</li>

								<li>
									<form action="/searchMedicineByCategory/category4" id="categoryForm4" method="get">
										<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
										<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
										<a href="" onClick="submitCategoryForm(event, 4)" class="s-text13">
											Beauty
										</a>
									</form>
								</li>

								<li>
									<form action="/searchMedicineByCategory/category5" id="categoryForm5" method="get">
										<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
										<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
										<a href="" onClick="submitCategoryForm(event, 5)" class="s-text13">
											HouseHold
										</a>
									</form>
								</li>

								<li>
									<form action="/searchMedicineByCategory/category6" id="categoryForm6" method="get">
										<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
										<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
										<a href="" onClick="submitCategoryForm(event, 6)" class="s-text13">
											Others
										</a>
									</form>
								</li>
							</ul>
						</li>

						<li>
							<a href="/aboutUs">About Us</a>
						</li>

						<li>
							<a href="/contactUsFormGeneral">Contact</a>
						</li>
					</ul>
				</nav>
			</div>

			<!-- Header Icon -->
			<div class="header-icons">
				<a href="/dashboard" class="header-wrapicon1 dis-block">
					<img src="/themeAssets/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
				</a>

				<span class="linedivide1"></span>

				<div class="header-wrapicon2">
					<a href="/viewCart">
						<i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 26px; color:#c6c6c6"></i>
					</a>
					<span class="header-icons-noti" style="background-color:#E65540">{{ Cart::count() }}</span>
				</div>
			</div>
		</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap_header_mobile">
		<!-- Logo moblie -->
		<a href="/" class="logo-mobile">
			<img src="/themeAssets/images/icons/lifeLine2.png" alt="IMG-LOGO">
		</a>

		<!-- Button show menu -->
		<div class="btn-show-menu">
			<!-- Header Icon mobile -->
			<div class="header-icons-mobile">
				<a href="/dashboard" class="header-wrapicon1 dis-block">
					<img src="/themeAssets/images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
				</a>

				<span class="linedivide2"></span>

				<div class="header-wrapicon2">
					<a href="/viewCart">
						<i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 26px; color:#c6c6c6"></i>
					</a>
					<span class="header-icons-noti" style="background-color:#E65540">{{ Cart::count() }}</span>
				</div>
			</div>

			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>
	</div>

	<!-- Menu Mobile -->
	<div class="wrap-side-menu">
		<nav class="side-menu">
			<ul class="main-menu">

				<li class="item-menu-mobile">
					<a href="/">Home</a>
					<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
				</li>

				<li class="item-menu-mobile">
					<a href="#">Categories</a>
					<ul class="sub-menu">
						<li>
							<form action="/searchMedicineByCategory/category1" id="categoryForm1" method="get">
								<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
								<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
								<a href="" onClick="submitCategoryForm(event, 1)" class="s-text13 active1">
									Medicine
								</a>
							</form>
						</li>

						<li>
							<form action="/searchMedicineByCategory/category2" id="categoryForm2" method="get">
								<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
								<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
								<a href="" onClick="submitCategoryForm(event, 2)" class="s-text13">
									Proteins and Suppliments
								</a>
							</form>
						</li>

						<li>
							<form action="/searchMedicineByCategory/category3" id="categoryForm3" method="get">
								<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
								<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
								<a href="" onClick="submitCategoryForm(event, 3)" class="s-text13">
									Baby and Mom
								</a>
							</form>
						</li>

						<li>
							<form action="/searchMedicineByCategory/category4" id="categoryForm4" method="get">
								<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
								<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
								<a href="" onClick="submitCategoryForm(event, 4)" class="s-text13">
									Beauty
								</a>
							</form>
						</li>

						<li>
							<form action="/searchMedicineByCategory/category5" id="categoryForm5" method="get">
								<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
								<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
								<a href="" onClick="submitCategoryForm(event, 5)" class="s-text13">
									HouseHold
								</a>
							</form>
						</li>

						<li>
							<form action="/searchMedicineByCategory/category6" id="categoryForm6" method="get">
								<input type="text" name="latitude" class="lat" @if(session()->has('latitude')) value="{{ session('latitude') }}" @endif style="display:none">
								<input type="text" name="longitude" class="lng" @if(session()->has('longitude')) value="{{ session('longitude') }}" @endif style="display:none">
								<a href="" onClick="submitCategoryForm(event, 6)" class="s-text13">
									Others
								</a>
							</form>
						</li>
					</ul>
					<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
				</li>

				<li class="item-menu-mobile">
					<a href="/aboutUs">About Us</a>
				</li>

				<li class="item-menu-mobile">
					<a href="/contactUsFormGeneral">Contact</a>
				</li>
			</ul>
		</nav>
	</div>
</header>








    @section('body')

    @show



	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					<i class="fa fa-home" aria-hidden="true" style="font-size:40px"></i>
				</h4>

				<a href="#" class="s-text11 t-center">
					Medicine At your DoorStep
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					<i class="fa fa-clock-o" aria-hidden="true" style="font-size:40px"></i>
				</h4>

				<span class="s-text11 t-center">
					Medicine Delivered within hours
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					<i class="fa fa-money" aria-hidden="true" style="font-size:40px"></i>
				</h4>

				<span class="s-text11 t-center">
					Cash on delivery
				</span>
			</div>
		</div>
	</section>


	<!-- Footer -->
	<footer class="bg6">
			<div class="text-center">
				<h4 class="s-text12 p-b-30 p-t-30">
					Final Year Project
				</h4>
			</div>
	</footer>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="/themeAssets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="/themeAssets/js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/lightbox2/js/lightbox.min.js"></script>
	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function () {
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function () {
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function () {
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function () {
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});
	</script>

	<!--===============================================================================================-->
	<script type="text/javascript" src="/themeAssets/vendor/parallax100/parallax100.js"></script>
	<script type="text/javascript">
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="/themeAssets/js/main.js"></script>

	<script>
		function submitCategoryForm(event, formId){
                event.preventDefault();
                var categoryForm = 'categoryForm'+formId;
                $('#'+categoryForm).submit();
        }
		</script>

    @section('script')
    @show
</body>

</html>
