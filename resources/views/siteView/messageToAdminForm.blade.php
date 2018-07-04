@extends('layouts.siteLayout')

@section('tabTitle', 'Contact Us')

@section('head')
    
@endsection
@section('style')
    
@endsection
@section('body')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(/themeAssets/images/contactBackground.jpg);">
		<h2 class="t-center">
			Contact Us
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-60">
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-6 p-b-30">
					<form class="leave-comment" action="/contactUs" method="POST">
                    {{ csrf_field() }}
						<h4 class="m-text26 p-b-36 p-t-15">
							Got a Question? Send us your message
						</h4>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input name="email" class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email Address">
						</div>

						<textarea name="message" class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message"></textarea>

						<div class="w-size25">
							<!-- Button -->
							<button type="sumbit" class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
								Send
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('script')

@endsection