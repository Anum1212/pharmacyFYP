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
        <div class="panel panel-default chat">
            <div class="panel-heading">
                Reply
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
                <span class="pull-right">
                    <a href="/admin/viewAllMessagesOfSpecificSender/{{$message->id}}"> View Previous Messages </a>
                </span>
            </div>
            <div class="panel-body">
                <ul>
                    <li class="left clearfix">
                        <span class="chat-img pull-left">
                            Sender
                            <br>
                            <br>
                            <br> Message
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">{{$message->name}} - &lt;{{$message->senderEmail}}&gt;</div>
                            <hr>
                            <p>{{$message->message}}</p>
                        </div>
                    </li>
                </ul>
                <form class="form-horizontal" method="POST" action="{{'/admin/replyMessage/'.$message->id}}">
                    {{ csrf_field() }}
                    <fieldset>
                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="messageReply">Reply</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="messageReply" name="messageReply" placeholder="Please enter your message here..." rows="5"
                                    required></textarea>
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 widget-right">
                                <button type="submit" class="btn btn-default btn-md pull-right">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <div class="form-group">
                    <div class="col-md-12 widget-left">
                        <form class="confirm" style="margin-top:15px;" action="{{'/admin/deleteMessage/'.$message->id}}" method="post">
                            {{csrf_field()}} {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.row-->

@endsection