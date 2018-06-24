@extends( Auth::check()  ?  'layouts.customerDashboard' : 'layouts.pharmacistDashboard' )
{{-- @extends('layouts.customerDashboard') --}}
  @section('head')
   <link rel="stylesheet" href="{{asset('css/alertify.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/default.css')}}">
  <link rel="stylesheet" href="{{asset('css/chat.css')}}">
  <script src="{{asset('js/alertify.min.js')}}"></script>
   <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
<script>
  	// $.noConflict();
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
  	$(function () {
      $('.chat-message').scrollTop(5000000);
  $('form').on('submit', function (event) {
  //	console.log($('form').serializeArray());
  	//var reciever=$('#otherPersonName').val();
    event.preventDefault();
    var d = new Date();
    // call ajax
//onsole.log(decodeURIComponent(reciever));
var messages=$('#text').val();
  var time=d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
 $('.chat-container').append('<li class="left clearfix"><div class="chat-body clearfix"><div class="header"><strong class="primary-font">Me</strong><small class="pull-right text-muted"><i class="fa fa-clock-o"></i>'+time+'</small></div><p>'+$('#text').val()+'</p></div></li>');
 $('.chat-message').scrollTop(5000000);
 queryString=getUrlVars();
        
        if(!queryString['name'])
        {
            console.log(null);
        }
        var reciever=queryString['name'];
        //console.log(decodeURIComponent(category));
   storeChatData(messages,decodeURIComponent(reciever)); 
  });
});
         function getUrlVars()          
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
} 
  	function storeChatData(message,reciever)
  	{
  		console.log(reciever);
  		$('#text').val('');
  		//console.log($('#otherPersonName').val());
  		//console.log(document.getElementById('otherPersonName').value);
  	$.ajax({
      type: "GET",
      url: "storeChatData",
      dataType: "json",
      cache:false,
      data:{ message : message,reciever : reciever},
      success: function(data) 
      {
      	console.log("work");
      }
    });
  }
  var pusher = new Pusher('d777d40d2f1e9e7e6b04', {
      cluster: 'mt1',
      encrypted: true
    });
 
    //Also remember to change channel and event name if your's are different.
    var channel = pusher.subscribe('notify2');
    channel.bind('notify-event2', function(message) {
      /*console.log(message);*/
    	if(message[3]=='user'){
     /*   console.log("reach");*/
     @if(isset(Auth::user()->id) )

      if({{Auth::user()->id}}==message[0])
       {
          alertify.set('notifier','position', 'top-center');
  alertify.error('You have recieve a message by '+message[2]+'');
 //alertify.success('You have recieve a message');
          var d = new Date();
    //mera logic
    var time=d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
     $('.chat-container').append('<li class="left clearfix"><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+message[2]+'</strong><small class="pull-right text-muted"><i class="fa fa-clock-o"></i> '+time+'</small></div><p>'+message[1]+'</p></div></li>');
     $('.chat-message').scrollTop(5000000);
     }
       @endif
   }else if(message[3]=='pharmicist'){
       @if(isset(Auth::guard('pharmacist')->user()->name))

        if({{Auth::guard('pharmacist')->user()->id}}==message[0])
       {
          alertify.set('notifier','position', 'top-center');
    alertify.set('notifier','delay', 10);
 alertify.error('You have recieve a message by '+message[2]+'');
    var d = new Date();
    //mera logic
    var time=d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
     $('.chat-container').append('<li class="left clearfix"><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+message[2]+'</strong><small class="pull-right text-muted"><i class="fa fa-clock-o"></i>'+time+'</small></div><p>'+message[1]+'</p></div></li>');
     $('.chat-message').scrollTop(5000000);
       } 
    @endif
}
    });
 function call(){
  alert();
}
  </script>
@endsection
@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chat
                <span class="pull-right clickable panel-toggle panel-button-tab-left">
                    <em class="fa fa-toggle-up"></em>
                </span>
            </div>
            <div class="panel-body">
              <div class="row">
  <div class="col-lg-12 text-center">
    <label for="sel1">Select Name (select one):</label>
    <select class="form-control" id="names" onchange="selectChat()">
      <option value="">Select</option>
      @foreach($data as $datas)
      <option value="{{$datas->name}}">{{$datas->name}}</option>
      @endforeach
    </select>
    <script>
      function selectChat() {
        window.location.href = "/getMessages?name=" + $('#names').val() + "";
      }

      function getUrl() {

        queryString = getUrlVars();

        if (!queryString['name']) {
          console.log(null);
        } else {
          var category = queryString['name'];
          console.log(decodeURIComponent(category));
        }
      }
    </script>
  </div>
<div class="gap"></div>

  @if(isset($chat))
  <!--=========================================================-->
  <!-- selected chat -->
  <div class="col-lg-12">
    <div class="chat-message">
      <ul class="chat chat-container">
        @foreach($chat as $chats)
        <li class="left clearfix">
          <div class="chat-body clearfix">
            <div class="header">
              <strong class="primary-font">@if(Auth::check())
                <b id="name">{{$chats->senderName==Auth()->user()->name ? 'Me':$chats->senderName}}</b>
                @elseif(Auth::guard('pharmacist')->check())
                <b>{{$chats->senderName==Auth::guard('pharmacist')->user()->name ? 'Me':$chats->senderName}} @endif
              </strong>
              <small class="pull-right text-muted">
                <i class="fa fa-clock-o"></i> {{ $chats->created_at }}</small>
            </div>
            <p>
              {{ $chats->message }}
            </p>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="chat-box gap col-lg-12">
      <form class="send-message-form">
        <div class="input-group">
          <input type="text" class="form-control border no-shadow no-rounded" placeholder="Type your message here" id="text">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary no-rounded">Send</button>
          </span>
          <!-- /input-group -->
        </div>
      </form>
    </div>
</div>
@endif
            </div>
        </div>
    </div>
</div>
<!--/.row-->
@endsection