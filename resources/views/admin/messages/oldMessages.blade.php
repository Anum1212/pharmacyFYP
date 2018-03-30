@extends('layouts.app')

<!--
********************************************************************
                              Head
********************************************************************
 -->
@section('head')

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
    <h1>Message</h1>
</div>

<!--
********************************************************************
                    Main Wrapper for Divs
********************************************************************
 -->

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 well">
@for ($i=0; $i <count($visitorPrevMessage) ; $i++) 
  <div id="messageSet" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div id="senderMessage" class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
      <h4> {{$visitorPrevMessage[$i]->name}}: </h4>
      <p>{{$visitorPrevMessage[$i]->message}}</p>
</div>
@for ($j=0; $j <count($adminResponse) ; $j++)
@if($visitorPrevMessage[$i]->id == $adminResponse[$j]->repliedToId)
<div id="adminMessage" class="col-lg-11 col-md-11 col-sm-12 col-xs-12 ">
  <h4> You: </h4>
  <p>{{$adminResponse[$j]->message}}</p>
</div>
@endif
@endfor
</div>
@endfor
</div>

@endsection

@section('script')

@endsection
