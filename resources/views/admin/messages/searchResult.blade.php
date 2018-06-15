@extends('layouts.adminDashboard')

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
                            <td data-label="#">{{ (($searchResults->currentPage() - 1 ) * $searchResults->perPage() ) + $loop->iteration }}
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
                                {{-- if message status is unread --}} @if ($searchResult->status==0)
                                <form style="margin-top:15px;" action="{{'/admin/markAsReadMessage/'.$searchResult->id}}" method="post">
                                    {{csrf_field()}} {{method_field('put')}}
                                    <button type="submit" class="btn btn-md btn-success">Mark as read</button>
                                </form>
                                {{-- if message status is read --}} @elseif ($searchResult->status==1 || $searchResult->status==2)
                                <form style="margin-top:15px;" action="{{'/admin/markAsUnreadMessage/'.$searchResult->id}}" method="post">
                                    {{csrf_field()}} {{method_field('put')}}
                                    <button type="submit" class="btn btn-md btn-warning">Mark as unread</button>
                                </form>
                                {{-- if message status is 3 i.e it is admin response --}} @elseif ($searchResult->status=='3')
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
@endsection