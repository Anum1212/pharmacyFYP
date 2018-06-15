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
                Previous Chat
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
                <ul>
                    @for ($i=0; $i
                    <count($visitorPrevMessage) ; $i++) <li class="left clearfix">
                        <span class="chat-img pull-left">
                            <strong>{{$visitorPrevMessage[$i]->name}}</strong>
                            <br>
                            <small class="text-muted">{{$visitorPrevMessage[$i]->created_at->toDateString()}}</small>
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header"></div>
                            <p>{{$visitorPrevMessage[$i]->message}}</p>
                        </div>
                        </li>
                        @for ($j=0; $j
                        <count($adminResponse) ; $j++) @if($visitorPrevMessage[$i]->id == $adminResponse[$j]->repliedToId)
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                    <strong>You</strong>
                                    <br>
                                    <small class="text-muted">{{$adminResponse[$j]->created_at->toDateString()}}</small>
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header"></div>
                                    <p>{{$adminResponse[$j]->message}}</p>
                                </div>
                            </li>
                            @endif @endfor @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection