<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pharmacy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link href="{{ asset('css/dashboard/dashboardGeneral.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard/dashboardSmallDisplay.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard/dashboardLargeDisplay.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard/dashboard.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard/skin-blue.min.css') }}" rel="stylesheet">
<!--
********************************************************************
                              Head
********************************************************************
 -->
    @section('head')
    @show
  </head>


<!--
********************************************************************
                               Body
********************************************************************
-->
<body class="hold-transition skin-blue sidebar-mini">

  @include('partials.error')
  @include('partials.message')
  <!--
  ********************************************************************
                         Main Page Wrapper
  ********************************************************************
   -->


@section('body')
@show


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ URL::asset('js/dashboard.min.js') }}"></script>

  @section('script')
    @show
  </body>
</html>
