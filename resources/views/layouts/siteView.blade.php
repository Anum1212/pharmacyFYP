<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/siteViewGeneral.css')}}"> 
    <link rel="stylesheet" href="{{asset('css/siteViewNavBar.css')}}"> 
    
    @section('head') @show 
    @section('style') @show
</head>

<body>
<body>
        	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
            </div>
		</div><!-- /.container-fluid -->
    </nav>
    @section('body') @show 
    
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap.min.js') }}"></script>
    @section('script') @show

</body>

</html>