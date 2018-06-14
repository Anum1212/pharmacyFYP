@extends('layouts.adminDashboard')

@section('panelHeading', 'panelHeadingHere') 

@section('searchBar')
<form role="search" action="/admin/searchOrder" method="get" role="search">
    <div class="form-group">
        <input type="number" class="form-control" name="search" placeholder="Search for order" required>
    </div>
</form>
@endsection 

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Search results ({{$totalSearchResults}})
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Id</th>
                            <th scope="col">View</th>
                            <th scope="col">Disable</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($searchResults as $searchResult)
                        <tr>
                            <td data-label="#">{{ (($searchResults->currentPage() - 1 ) * $searchResults->perPage() ) + $loop->iteration }}</td>
                            <td data-label="Order Id">{{$searchResult->id}}</td>
                            <td data-label="View">
                                <a href="{{'/admin/editFileForm/'.$searchResult->id}}">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td data-label="searchResult">
                                <form style="margin-top:15px;" action="{{'/admin/disableFile/'.$searchResult->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Disable</button>
                                </form>
                            </td>
                            <td data-label="Delete">
                                <form style="margin-top:15px;" action="{{'/admin/deleteFile/'.$searchResult->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $searchResults->appends(Request::only('search'))->links() }}
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection