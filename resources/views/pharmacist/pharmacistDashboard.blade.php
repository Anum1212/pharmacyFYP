@extends('layouts.siteView')

@section('body')
    <div class="container">
        <div class="sideNavBar panel panel-default col-lg-2 col-md-2 col-sm-2 col-xs-12">
           <div class="panel-body">
                <ul>
                <li><a href="#">Account</a></li>
                <li><a href="#">View Orders</a></li>
                <li><a href="#">View Medicine Stats</a></li>
                @if($userData->dataSource=='2')
                <li>Manage Products
                <ul>
                    <li><a href="pharmacist/viewProducts">View Products</a></li>
                    <li><a href="pharmacist/addProduct">Add Product</a></li>
                </ul>
                </li>
                @endif
            </ul>
        </div>
        </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Pharmacist Dashboard</div>

                    <div class="panel-body">
                        @component('components.who-is-logged-in')
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
