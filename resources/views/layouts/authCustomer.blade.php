<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tabTitle')</title>

    <link href="{{ asset('css/dashboard/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/dashboard/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden
        }

        .fullPage {
            min-height: 88vh;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <span>Lumino</span>Admin</a>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <em class="fa fa-user"></em>
                        </a>
                        @if (Auth::guest())
                        <ul class="left dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <div class="message-body">
                                        <a href="{{ route('login') }}">
                                            <strong>Login</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <div class="message-body">
                                        <a href="{{ route('register') }}">
                                            <strong>Register</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                            </li>
                        </ul>
                        @else
                        <ul class="left dropdown-menu dropdown-messages">
                            <li>
                                <div class="dropdown-messages-box">
                                    <div class="message-body">
                                        <a href="/dashboard">
                                            <strong>Account</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="dropdown-messages-box">
                                    <div class="message-body">
                                        <a href="#">
                                            <strong>Cart</strong>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                            </li>
                        </ul>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.container-fluid -->
    </nav>

    @include('includes.error') @include('includes.message') @section('body') @show

    <script type="text/javascript" src="{{ URL::asset('js/dashboard/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dashboard/bootstrap.min.js') }}"></script>
</body>

</html>