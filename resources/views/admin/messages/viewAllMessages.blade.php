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
    <h1>Messages</h1>
</div>

<!--
********************************************************************
                        Search Form
********************************************************************
 -->
<div class="searchForm" id="searchForm">
<form action="/admin/searchSender" method="POST" role="search" target="_blank">
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
                         Unread Messages Table
********************************************************************
 -->

<!--
********************************************************************
                          Table Heading
********************************************************************
 -->
<div id="messageTable" class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">


<div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
       <h2>Unread Messages ({{count($unreadMessages)}})</h2>
       @if (count($unreadMessages)==0)
       <p>Wow no Messages</p>    
       @endif
       @if (count($unreadMessages)==1)
       <p>Admin there is only 1 Message. Lets see what it says</p>    
       @endif
       @if (count($unreadMessages)>1 && count($unreadMessages)<=10)
       <p>Come On Admin its only a few messages. Lets finish them</p>    
       @endif
</div>

<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
@foreach ($unreadMessages as $unreadMessage)
    <tr>
      <td data-column="Title">{{$unreadMessage->name}}</td>
      <td data-column="Actions">
        <a href="{{'/admin/viewMessage/'.$unreadMessage->id}}" class="btn btn-info" title="Edit" >Read / Reply</a>
        <form style="margin-top:15px;" action="{{'/admin/markAsReadMessage/'.$unreadMessage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <button type="submit" class="btn btn-warning">Mark as Read</button>
        </form>
        <form style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$unreadMessage->id}}" method="post">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                     </form>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $unreadMessages->appends(['readTable' => $readMessages->currentPage()])->links() }}
<!--
********************************************************************
                          Heading
********************************************************************
 -->

<div id="tableHeading" class="col-md-12 col-sm-12 col-xs-12">
     <h2>Read Messages</h2>

</div>


<!--
********************************************************************
                           Read Message Table
********************************************************************
 -->

      <table>
        <thead>
          <tr>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($readMessages as $readMessage)
          <tr>
            <td data-column="Title">{{$readMessage->name}}
              @if($readMessage->status == '1')
              <p>
                <span style="color:red">(Only Read)</span>
              </p>
              @endif
              @if($readMessage->status == '2')
              <p>
                <span style="color:green">(Replied)</span>
              </p>
              @endif
            </td>
            <td data-column="Actions">
              <a href="{{'/admin/viewMessage/'.$readMessage->id}}" class="btn btn-info" title="Edit" >Read / Reply</a>
                      <form style="margin-top:15px;" action="{{'/admin/markAsUnreadMessage/'.$readMessage->id}}" method="post">
                                          {{csrf_field()}} {{method_field('PUT')}}
                                          <button type="submit" class="btn btn-warning">Mark as Unread</button>
                      </form>
                      <form style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$readMessage->id}}" method="post">
                                          {{csrf_field()}} {{method_field('DELETE')}}
                                          <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
          </tr>
          @endforeach
        </tbody>
      </table>

      {{ $readMessages->appends(['unreadTable' => $unreadMessages->currentPage()])->links() }}
</div>
@endsection

@section('script')

@endsection
