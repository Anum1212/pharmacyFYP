<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="{{ asset('css/dashboard/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/dashboard/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @section('head') @show @section('style') @show


    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body>

    @include('includes.error') @include('includes.message')
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <span>LifeLine</span>
                    <em class="fa fa-heartbeat" style="color:#fff; font-size: 25px"></em>
                </a>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    {{{ ucwords(trans(Auth::user()->name)) }}}
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>

        @section('searchBar') @show

        <ul class="nav menu">
            <li class="{{{ (Request::is('dashboard') ? 'active' : '') }}}">
                <a href="/dashboard">
                    <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
            </li>
            <li class="{{{ (Request::is('editAccountDetailsForm') ? 'active' : '') }}}">
                <a href="/editAccountDetailsForm">
                    <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
            </li>
            <li class="{{{ (Request::is('viewAllOrders') ? 'active' : '') }}}">
                <a href="/viewAllOrders">
                    <em class="fa fa-truck">&nbsp;</em> Orders</a>
            </li>
            <li class="{{{ (Request::is('viewCart') ? 'active' : '') }}}">
                <a href="/viewCart">
                    <em class="fa fa-shopping-cart">&nbsp;</em> Cart ({{ Cart::count() }})</a>
            </li>
            <li class="{{{ (Request::is('downloads') ? 'active' : '') }}}">
                <a href="/downloads">
                    <em class="fa fa-file">&nbsp;</em> Downloads</a>
            </li>
            <li class="{{{ (Request::is('chatView') ? 'active' : '') }}}">
                <a href="/chatView">
                    <em class="fa fa-comments">&nbsp;</em> Chat</a>
            </li>
            <li class="{{{ (Request::is('contactUsForm') ? 'active' : '') }}}">
                <a href="contactUsForm">
                    <em class="fa fa-comment">&nbsp;</em> Contact Admin</a>
            </li>
            <li>
                <a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <em class="fa fa-power-off">&nbsp;</em> Logout</a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
    <!--/.sidebar-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        @section('body') @show
    </div>
    <!--/.row-->





    <script type="text/javascript" src="{{ URL::asset('js/dashboard/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/chart-data.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/easypiechart.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/easypiechart-data.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/custom.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/confirmDelete.js') }}"></script>
    @yield('script') 
    
    
    {{-- trigger rating modal if customer rating is needed --}} 
    
    @if(!empty($pharmacyRatings))
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <link href="{{ asset('css/siteView/rating.css') }}" rel="stylesheet"> {{-- rating modal --}}
    <div id="ratingModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <form action="/ratePharmacyLater" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="close">&times;</button>
                    </form>
                    <h4 class="modal-title">Rate Your Experience</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <form action="/ratePharmacy" method="post">
                            {{csrf_field()}}
                            <tbody>
                                @foreach ($pharmacyRatings as $pharmacyRating)
                                <tr>
                                    <td data-label="Name">{{$pharmacyRating->pharmacyName}}</td>
                                    <td data-label="Customer Ratings">{{$pharmacyRating->rating}}/5</td>
                                    <input type="text" name="pharmacyId[]" value="{{$pharmacyRating->id}}" hidden>
                                    <td data-label="Your Rating">
                                        <div class="pull-right">
                                            <fieldset class="rating">
                                                <input type="radio" id="star5{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="5" />
                                                <label class="full" for="star5{{$loop->iteration}}" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4half{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="4.5" />
                                                <label class="half" for="star4half{{$loop->iteration}}" title="Pretty good - 4.5 stars"></label>
                                                <input type="radio" id="star4{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="4" />
                                                <label class="full" for="star4{{$loop->iteration}}" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3half{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="3.5" />
                                                <label class="half" for="star3half{{$loop->iteration}}" title="Meh - 3.5 stars"></label>
                                                <input type="radio" id="star3{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="3" />
                                                <label class="full" for="star3{{$loop->iteration}}" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2half{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="2.5" />
                                                <label class="half" for="star2half{{$loop->iteration}}" title="Kinda bad - 2.5 stars"></label>
                                                <input type="radio" id="star2{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="2" />
                                                <label class="full" for="star2{{$loop->iteration}}" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1half{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="1.5" />
                                                <label class="half" for="star1half{{$loop->iteration}}" title="Meh - 1.5 stars"></label>
                                                <input type="radio" id="star1{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="1" />
                                                <label class="full" for="star1{{$loop->iteration}}" title="Sucks big time - 1 star"></label>
                                                <input type="radio" id="starhalf{{$loop->iteration}}" name="rating[{{$loop->iteration-1}}]" value="0.5" />
                                                <label class="half" for="starhalf{{$loop->iteration}}" title="Sucks big time - 0.5 stars"></label>
                                            </fieldset>
                                        </div>
                                        <br>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        <button type="submit" class="btn btn-info btn-block">Rate your Experience</button>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- A script to show rating Modal if user rating is needed see rateOrder Middleware for more details --}}
    <script>
        $(function () {
            $('#ratingModal').modal('show');
        });
    </script>
    @endif 
    
    
    @section('script') @show

</body>

</html>