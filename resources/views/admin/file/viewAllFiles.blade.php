@extends('layouts.dashboard') @section('head') @endsection @section('style') @endsection @section('body')
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index">
                <span>Lumino</span>Admin</a>
        </div>
    </div>
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <span class="capitalWord">{{Auth::user()->name}}</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <form role="search" action="/admin/searchFile" method="get" role="search">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search for file" required>
            </div>
        </form>
        <li>
            <a href="/admin/dashboard">
                <em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <li>
            <a href="widgets.html">
                <em class="fa fa-cogs">&nbsp;</em> Account Details</a>
        </li>
        <li>
            <a href="/admin/viewAllOrders">
                <em class="fa fa-truck">&nbsp;</em> Orders</a>
        </li>
        <li>
            <a href="/admin/viewAllMessages">
                <em class="fa fa-comment">&nbsp;</em> Messages</a>
        </li>
        <li class="parent ">
            <a data-toggle="collapse" href="#users">
                <em class="fa fa-users">&nbsp;</em> Mangage Users
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="users">
                <li>
                    <a class="" href="/admin/viewAllCustomers">
                        <span class="fa fa-user">&nbsp;</span> Customers
                    </a>
                </li>
                <li>
                    <a class="" href="/admin/viewAllPharmacies">
                        <span class="fa fa-user-md">&nbsp;</span> Pharmacies
                    </a>
                </li>
            </ul>
        </li>
        <li class="parent active">
            <a data-toggle="collapse" href="#files">
                <em class="fa fa-file">&nbsp;</em> Mangage Files
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                    <em class="fa fa-plus"></em>
                </span>
            </a>
            <ul class="children collapse" id="files">
                <li>
                    <a class="" href="/admin/viewAllFiles">
                        <span class="fa fa-search">&nbsp;</span> View Files
                    </a>
                </li>
                <li>
                    <a class="" href="/admin/uploadFileForm">
                        <span class="fa fa-upload">&nbsp;</span> Upload File
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <em class="fa fa-power-off">&nbsp;</em> Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</div>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!--/.row-->

    {{-- <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">File Managment</h1>
        </div>
    </div> --}}
    <!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Enabled Files ({{$totalEnabledFiles}})
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">View</th>
                                <th scope="col">Disable</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($enabledFiles as $enabledFile)
                                <tr>
                                    <td data-label="#">{{ (($enabledFiles->currentPage() - 1 ) * $enabledFiles->perPage() ) + $loop->iteration }}</td>
                                    <td data-label="Name">{{$enabledFile->title}}</td>
                                    <td data-label="View">
                                        <a href="{{'/admin/editFileForm/'.$enabledFile->id}}">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td data-label="Mark as read">
                                        <form style="margin-top:15px;" action="{{'/admin/disableFile/'.$enabledFile->id}}" method="post">
                                            {{csrf_field()}} {{method_field('PUT')}}
                                            <button type="submit" class="btn btn-warning">Disable</button>
                                        </form>
                                    </td>
                                    <td data-label="Delete">
                                        <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteFile/'.$enabledFile->id}}" method="post">
                                            {{csrf_field()}} {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                        </tbody>
                    </table>
                    
                    {{ $enabledFiles->appends(['disabledTable' => $disabledFiles->currentPage()])->links() }}
                    <div class="divider">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Disabled Files ({{$totaldisabledFiles}})
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    {{-- |---------------------------------- Disabled Files Table ----------------------------------|--}}
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">View</th>
                                <th scope="col">Enable</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($disabledFiles as $disabledFile)
                                <tr>
                                    <td data-label="#">{{ (($disabledFiles->currentPage() - 1 ) * $disabledFiles->perPage() ) + $loop->iteration }}</td>
                                    <td data-label="Name">{{$disabledFile->title}}
                                    </td>
                                    <td data-label="View">
                                        <a href="{{'/admin/editFileForm/'.$disabledFile->id}}">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td data-label="Enable File">
                                        <form style="margin-top:15px;" action="{{'/admin/enableFile/'.$disabledFile->id}}" method="post">
                                            {{csrf_field()}} {{method_field('PUT')}}
                                            <button type="submit" class="btn btn-warning">Enable</button>
                                        </form>
                                    </td>
                                    <td data-label="Delete">
                                        <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteFile/'.$disabledFile->id}}" method="post">
                                            {{csrf_field()}} {{method_field('DELETE')}}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                    @endforeach
                        </tbody>
                    </table>
                    {{ $disabledFiles->appends(['enabledTable' => $enabledFiles->currentPage()])->links() }}

                </div>
            </div>
        </div>
    </div>
    <!--/.row-->

</div>
<!--/.row-->
</div>
<!--/.main-->
@endsection @section('script') @endsection