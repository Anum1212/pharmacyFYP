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
        <form role="search" action="/admin/searchSender" method="get">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Search for message by" required>
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
        <li class="active">
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
        <li class="parent ">
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
{{-- 
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Messages</h1>
        </div>
    </div> --}}
    <!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Search Results ({{$totalSearchResults}})
                    <span class="pull-right clickable panel-toggle panel-button-tab-left">
                        <em class="fa fa-toggle-up"></em>
                    </span>
                </div>
                <div class="panel-body">
                    @if(!empty($searchResults))
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                                <th scope="col">Change Status</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($searchResults as $searchResult)
                            <tr>
                                <td data-label="#">{{ (($searchResults->currentPage() - 1 ) * $searchResults->perPage() ) + $loop->iteration
                                    }}
                                </td>
                                <td data-label="Name">{{$searchResult->name}}
                                    <br>
                                </td>
                                <td data-label="Email">@if ($searchResult->senderEmail=='0')Admin @else{{$searchResult->senderEmail}}@endif</td>
                                <td data-label="Status"> @if ($searchResult->status==0)
                                    <span style="color:red"> Unread </span> @elseif ($searchResult->status==1)
                                    <span style="color:Green"> Read </span> @elseif ($searchResult->senderEmail=='0')
                                    <span style="color:blue"> Admin Reply </span> @endif @if ($searchResult->status==2)Read and replied @endif</td>
                                <td data-label="View">
                                    <a href="{{'/admin/viewMessage/'.$searchResult->id}}">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td data-label="Change Status"> 
                                    {{-- if message status is unread --}}
                                    @if ($searchResult->status==0)
                                    <form style="margin-top:15px;" action="{{'/admin/markAsReadMessage/'.$searchResult->id}}"
                                        method="post">
                                        {{csrf_field()}} {{method_field('put')}}
                                        <button type="submit" class="btn btn-md btn-success">Mark as read</button>
                                    </form> 
                                    {{-- if message status is read --}}
                                    @elseif ($searchResult->status==1 || $searchResult->status==2)
                                    <form style="margin-top:15px;" action="{{'/admin/markAsUnreadMessage/'.$searchResult->id}}"
                                        method="post">
                                        {{csrf_field()}} {{method_field('put')}}
                                        <button type="submit" class="btn btn-md btn-warning">Mark as unread</button>
                                    </form> 
                                    {{-- if message status is 3 i.e it is admin response --}}
                                    @elseif ($searchResult->status=='3')
                                    <span style="color:blue"> Admin Reply </span> @endif @if ($searchResult->status==2)Read and replied @endif</td>
                                <td data-label="Delete">
                                    <form style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$searchResult->id}}" method="post">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $searchResults->appends(Request::only('search'))->links() }} @endif
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