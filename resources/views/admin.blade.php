@extends('layouts.siteView')

@section('content')
    <div class="container">
        <div class="sideNavBar panel panel-default col-lg-2 col-md-2 col-sm-2 col-xs-12">
           <div class="panel-body">
                <ul>
                <li><a href="#">Account</a></li>
                <li><a href="#">View Orders</a></li>
                <li><a href="#">View Medicine Stats</a></li>
                <li><a href="admin/viewAllMessages">Messages</li>
            </ul>
        </div>
        </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin Dashboard</div>

                    <div class="panel-body">
                        @component('components.who-is-logged-in')
                        @endcomponent
                    </div>
                </div>
            </div>
    </div>
@endsection
