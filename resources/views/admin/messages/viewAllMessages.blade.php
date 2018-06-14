@extends('layouts.adminDashboard')

@section('panelHeading', 'panelHeadingHere') 


@section('searchBar')
<form role="search" action="/admin/searchSender" method="get">
    <div class="form-group">
        <input type="text" class="form-control" name="search" placeholder="Search for message by" required>
    </div>
</form>
@endsection 


@section('body')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Unread Messages ({{$totalUnreadMessages}})
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
                            <th scope="col">Mark as Read</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unreadMessages as $unreadMessage)
                        <tr>
                            <td data-label="#">{{ (($unreadMessages->currentPage() - 1 ) * $unreadMessages->perPage() ) + $loop->iteration }}
                            </td>
                            <td data-label="Name">{{$unreadMessage->name}}</td>
                            <td data-label="View">
                                <a href="{{'/admin/viewMessage/'.$unreadMessage->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td data-label="Mark as read">
                                <form style="margin-top:15px;" action="{{'/admin/markAsReadMessage/'.$unreadMessage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Mark as Read</button>
                                </form>
                            </td>
                            <td data-label="Delete">
                                <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$unreadMessage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $unreadMessages->appends(['readTable' => $readMessages->currentPage()])->links() }}
            </div>
        </div>
    </div>
</div>
<!--/.row-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Read Messages ({{$totalReadMessages}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                {{-- |---------------------------------- Read Messages Table ----------------------------------|--}}
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">View</th>
                            <th scope="col">Mark as Read</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($readMessages as $readMessage)
                        <tr>
                            <td data-label="#">{{ (($readMessages->currentPage() - 1 ) * $readMessages->perPage() ) + $loop->iteration}}
                            </td>
                            <td data-label="Name">{{$readMessage->name}} @if($readMessage->status == '1')
                                <p>
                                    <span style="color:red">(Only Read)</span>
                                </p>
                                @endif @if($readMessage->status == '2')
                                <p>
                                    <span style="color:green">(Replied)</span>
                                </p>
                                @endif
                            </td>
                            <td data-label="View">
                                <a href="{{'/admin/viewMessage/'.$readMessage->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td data-label="Mark as read">
                                <form style="margin-top:15px;" action="{{'/admin/markAsUnreadMessage/'.$readMessage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Mark as Unread</button>
                                </form>
                            </td>
                            <td data-label="Delete">
                                <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$readMessage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $readMessages->appends(['unreadTable' => $unreadMessages->currentPage()])->links() }}
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection