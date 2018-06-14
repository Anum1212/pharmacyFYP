<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tabTitle')</title>

    <link href="{{ asset('css/dashboard/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('css/dashboard/styles.css') }}" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <style>
          body{
              overflow-x: hidden
          }
      .fullPage{
          min-height: 88vh;
      }
      </style>
</head>

<body>
        	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
            </div>
		</div><!-- /.container-fluid -->
    </nav>
    
    @include('includes.error') @include('includes.message')
        @section('body') @show

    <script type="text/javascript" src="{{ URL::asset('js/dashboard/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap.min.js') }}"></script>
</body>

</html>