<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->


  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <style>
    /* SLIDE */

    .btnSlide.btnBlueGreen {
      background: 0;
    }

    .btnSlide.btnBlueGreen .top {
      background: #00AE68;
    }

    .btnSlide.btnOrange .top {
      background: #FFAA40;
    }

    .btnSlide.btnPurple .top {
      background: #A74982;
    }

    div.button {
      display: block;
      position: relative;
      float: left;
      width: 120px;
      padding: 0;
      margin: 10px 20px 10px 0;
      font-weight: 600;
      text-align: center;
      line-height: 50px;
      color: #FFF;
      border-radius: 5px;
      transition: all 0.2s;
    }

    .btnSlide .top {
      position: absolute;
      top: 0px;
      left: 0;
      width: 120px;
      height: 85px;
      background: #00AE68;
      z-index: 10;
      transition: all 0.2s;
      border-radius: 5px;
    }

    .btnSlide:hover .top {
      top: 100px;
    }

    .btnSlide .bottom {
      position: absolute;
      top: 0;
      left: 0;
      width: 120px;
      height: 100px;
      color: #000;
      z-index: 5;
      border-radius: 5px;
    }
  </style>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">

        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Pharmacy') }}
                    </a>
      </div>

      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          &nbsp;
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">

          {{-- in final verion remove from here --}} @if (Auth::user())
          <li><a href="/ratePharmacy">Rate Pharmacy</a></li>
          @endif
          <!-- Authentication Links -->
          @if (Auth::guest())
          <!-- Collect the nav links, forms, and other content for toggling -->
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('login') }}">As User</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('pharmacist.login') }}">As Pharmacist</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('register') }}">As User</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{ route('pharmacist.register') }}">As Pharmacist</a></li>
              </ul>
            </li>
          </ul>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

            <ul class="dropdown-menu" role="menu">
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
          @endif
        </ul>
      </div>
    </div>
  </nav>


  <div style="margin-top:25px">
    @include('partials.message') @include('partials.error')
  </div>


  <div class="wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="col-lg-8 col-lg-offset-4 col-md-8 col-md-offset-4 col-sm-12 col-xs-12">
      {{-- Admin Div --}}
      <div class="button btnSlide btnBlueGreen col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <span class="top">Admin</span>
        <div class="bottom">
          <a href="{{ route('admin.login') }}">Login</a>
        </div>
      </div>

      {{-- Pharmacist Div --}}
      <div class="button btnSlide btnOrange col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <span class="top">Pharmacist</span>
        <div class="bottom">
          <a href="{{ route('pharmacist.login') }}">Login</a>
          <br>
          <a href="{{ route('pharmacist.register') }}">Register</a>
        </div>
      </div>

      {{-- User div --}}
      <div class="button btnSlide btnPurple col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <span class="top">User</span>
        <div class="bottom">
          <a href="{{ route('login') }}">Login</a>
          <br>
          <a href="{{ route('register') }}">Register</a>
        </div>
      </div>
    </div>
  </div>



  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
