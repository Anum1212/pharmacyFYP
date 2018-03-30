@extends('layouts.app')
<!--
********************************************************************
                              Head
********************************************************************
 -->
@section('head')
<link href="{{ asset('css/table.css') }}" rel="stylesheet">
@endsection

<!--
********************************************************************
                              Body
********************************************************************
 -->
@section('content')
<!--
********************************************************************
                          Page Title
********************************************************************
 -->
<div id="pageTitle" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h1>Search Result</h1>
</div>
<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchForm" id="searchForm">
    <form action="/searchSender" method="POST" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search for message by"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
    </form>
</div>
<!--
********************************************************************
                         Searched Messages Table
********************************************************************
 -->
<!--
********************************************************************
                          Table Heading
********************************************************************
 -->
<div id="messageTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">

    <div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
        <h4>These are all the messages i could find admin ({{count($searchResults)}})</h4>
    </div>
    @if(!empty($searchResults))
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchResults as $searchResult)
            <tr>
                <td data-column="Title">Name: {{$searchResult->name}}
                    <br>
                    Email: {{$searchResult->senderEmail}}
                    <br>
                    @if ($searchResult->status==0)
                    Status: Unread
                    @endif
                    @if ($searchResult->status==1)
                    Status: Read
                    @endif
                    @if ($searchResult->status==2)
                    Status: Read and replied
                    @endif
                </td>
                <td data-column="Actions">
                    <a href="{{'/admin/viewMessage/'.$searchResult->id}}" class="btn btn-info" title="Edit">Read / Reply</a>
                    {{--  <form style="margin-top:15px;" action="{{'/admin/markAsReadMessage/'.$searchResult->id}}" method="post">
                        {{csrf_field()}} {{method_field('PUT')}}
                        <button type="submit" class="btn btn-warning">Mark as Read</button>
                    </form>  --}}
                    <form style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$searchResult->id}}" method="post">
                        {{csrf_field()}} {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
 
@section('script')
@endsection