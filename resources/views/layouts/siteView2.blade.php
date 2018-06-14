<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pharmacy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Latest compiled and minified CSS -->

  <link href="{{ asset('css/fontAwesome/css/fontawesome-all.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/siteViewGeneral.css') }}" rel="stylesheet">
  <link href="{{ asset('css/siteViewSmallDisplay.css') }}" rel="stylesheet">
  <link href="{{ asset('css/siteViewLargeDisplay.css') }}" rel="stylesheet">
  <!--
********************************************************************
                              Head
********************************************************************
 -->
  @section('head') @show @section('style') @show
</head>


<!--
********************************************************************
                               Body
********************************************************************
-->

<body data-spy="scroll" data-target=".navbar" data-offset="50">

  <!--
********************************************************************
                               NavBar
********************************************************************
-->

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
          aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">Pharmacy</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="#topPart">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <!-- Authentication Links -->
          @guest
          <li>
            <a href="{{ route('login') }}">Login</a>
          </li>
          <li>
            <a href="{{ route('register') }}">Register</a>
          </li>
          @else
          <li>
            <a href="/viewCart">Cart ({{Cart::count()}})</a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              {{ Auth::user()->name }}
              <span class="caret"></span>
            </a>

            <ul class="dropdown-menu">
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                  Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </li>
          @endguest
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <!--
********************************************************************
                       Main Page Wrapper
********************************************************************
 -->

   <div id="gap">
  </div>
  @include('includes.error') @include('includes.message')
  @section('body') @show


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  @section('script') @show
</body>

</html>