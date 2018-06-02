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
                    Upload File
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/admin/editFile/{{$file->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            <!-- File Title-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="fileTitle">File Title</label>
                                <div class="col-md-9">
                                    <input id="fileTitle" name="fileTitle" type="text" class="form-control" value="{{$file->title}}" required >
                                </div>
                            </div>

                            <!-- File Description-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="description">Description</label>
                                <div class="col-md-9">
                                    <textarea id="description" name="description" class="form-control" rows="3" required >{{$file->description}}</textarea>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="uploadFile">File</label>
                                <div class="col-md-5">
                                    <input type="file" name="uploadFile" required >
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-sm btn-primary" href={{ asset( 'storage/myAssets/files/'.$file->filename) }} download= {{$file->title}} >Currently Uploaded File</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="submit" class="btn btn-default btn-md pull-right">Upload File</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
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