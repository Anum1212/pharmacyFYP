@extends('layouts.dashboard') 

@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet"> 

<style>
    @import "http://fonts.googleapis.com/css?family=Droid+Sans";
form{
background-color:#fff
}
#maindiv{
width:960px;
margin:10px auto;
padding:10px;
font-family:'Droid Sans',sans-serif
}
#formdiv{
width:500px;
float:left;
text-align:center
}
form{
padding:40px 20px;
box-shadow:0 0 10px;
border-radius:2px
}
h2{
margin-left:30px
}
.upload{
background-color:red;
border:1px solid red;
color:#fff;
border-radius:5px;
padding:10px;
text-shadow:1px 1px 0 green;
box-shadow:2px 2px 15px rgba(0,0,0,.75)
}
.upload:hover{
cursor:pointer;
background:#c20b0b;
border:1px solid #c20b0b;
box-shadow:0 0 5px rgba(0,0,0,.75)
}
#file{
color:green;
padding:5px;
border:1px dashed #123456;
background-color:#f9ffe5
}
#upload{
margin-left:45px
}
#noerror{
color:green;
text-align:left
}
#error{
color:red;
text-align:left
}
#img{
width:17px;
border:none;
height:17px;
margin-left:-20px;
margin-bottom:91px
}
.abcd{
text-align:center
}
.abcd img{
height:100px;
width:100px;
padding:5px;
border:1px solid #e8debd
}
b{
color:red
}
</style>

@endsection 

@section('body')

<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini">
				<b>H</b>OME</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg">
				<b>Dash</b>Board</span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">

					<!-- User Account Menu -->
					<li class="user user-menu">
						<!-- Menu Toggle Button -->
						<a>
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{Auth::user()->name}}</span>
						</a>
					</li>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar Menu -->
			<ul class="sidebar-menu" data-widget="tree">
				<!-- Optionally, you can add icons to the links -->
				<li>
					<a href="/index">
						<i class="fas fa-home"></i>
						<span>Pharmacy</span>
					</a>
				</li>
				<li class="active">
					<a href="/home">
						<i class="fas fa-tachometer-alt"></i>
						<span>DashBoard</span>
					</a>
				</li>
				<li>
					<a href="/editAccountDetailsForm">
						<i class="fas fa-cogs"></i>
						<span>Account Details</span>
					</a>
				</li>
				<li>
					<a href="/viewAllOrders">
						<i class="fas fa-truck"></i>
						<span>Orders</span>
					</a>
				</li>
				<li class="active">
					<a href="/viewCart">
						<i class="fas fa-shopping-cart"></i>
						<span>Cart</span>
					</a>
				</li>
				<li>
					<a href="contactUsForm">
						<i class="fas fa-comment"></i>
						<span>Contact Admin</span>
					</a>
				</li>
				<li>
					<a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
						<i class="fas fa-sign-out-alt"></i>
						<span>Logout</span>
					</a>

					<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			</ul>
			<!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		@if(Cart::count()==0)
		<section class="content-header">
			<h1>
				No Items in Cart
			</h1>
		</section>

		@else
		<section class="content-header">
			<h1>
				Upload Prescription
			</h1>
		</section>
		<!-- Main content -->
		<section class="content container-fluid">

			<!--------------------------
        | Your Page Content Here |
		-------------------------->
<div class="container containerDashboardContent">
	<form enctype="multipart/form-data" action="prescriptionUpload" method="post">
		{{csrf_field()}}
        First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
        <div id="filediv">
            <input name="file[]" type="file" id="file" />
        </div>
        <input type="button" id="add_more" class="upload" value="Add More Files" />
        <input type="submit" value="Upload File" name="submit" id="upload" class="upload" />
    </form>
</div>
		</section>
		@endif
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2016
			<a href="#">Company</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->
@endsection

@section('script')
    <script>
    var abc = 0; // Declaring and defining global increment variable.
    $(document).ready(function () {
        //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
        $('#add_more').click(function () {
            $(this).before($("<div/>", {
                id: 'filediv'
            }).fadeIn('slow').append($("<input/>", {
                name: 'file[]',
                type: 'file',
                id: 'file'
            }), $("<br/><br/>")));
        });
        // Following function will executes on change event of file input to select different file.
        $('body').on('change', '#file', function () {
            if (this.files && this.files[0]) {
                abc += 1; // Incrementing global variable by 1.
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd" + abc).append($("<img/>", {
                    id: 'img',
                    src: 'storage/myAssets/x.jpg',
                    alt: 'delete'
                }).click(function () {
                    $(this).parent().parent().remove();
                }));
            }
        });
        // To Preview Image
        function imageIsLoaded(e) {
            $('#previewimg' + abc).attr('src', e.target.result);
        };
        $('#upload').click(function (e) {
            var name = $(":file").val();
            if (!name) {
                alert("First Image Must Be Selected");
                e.preventDefault();
            }
        });
    });

</script>
@endsection