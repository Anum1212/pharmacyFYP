

 @extends('layouts.customerDashboard')
  @section('customHeaderIncludes')
   <link rel="stylesheet" href="{{asset('css/alertify.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/default.css')}}">
  <script src="{{asset('js/alertify.min.js')}}"></script>
   <script src="https://js.pusher.com/4.2/pusher.min.js"></script>
 <style>
 {
  box-sizing: border-box;
}
.container {
  width: 400px;
  margin: 0 auto;
  border: solid 1px #ccc;
  border-radius: 5px;
  overflow: hidden;
}
.chat-container {
  height: 400px;
  overflow: auto;
  -webkit-transform: rotate(180deg);
          transform: rotate(180deg);
  direction: rtl;
}
.chat-container .message {
  border-bottom: solid 1px #ccc;
  padding: 20px;
  -webkit-transform: rotate(180deg);
          transform: rotate(180deg);
  direction: ltr;
}
.chat-container .message .avatar {
  float: left;
  margin-right: 5px;
}
.chat-container .message .datetime {
  float: right;
  color: #999;
}
.send-message-form input {
  width: 100%;
  border: none;
  font-size: 16px;
  padding: 10px;
}
.send-message-form button {
  display: none;
}
label {
    margin-top: 3%;}
</style>
<script>
  	// $.noConflict();
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});
  	$(function () {
  $('form').on('submit', function (event) {
  //	console.log($('form').serializeArray());
  	//var reciever=$('#otherPersonName').val();
    event.preventDefault();
    var d = new Date();
    // call ajax
//onsole.log(decodeURIComponent(reciever));
var messages=$('#text').val();
  var time=d.getFullYear()+'-'+d.getMonth()+'-'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
 $('.chat-container').prepend('<div class="message"><h4 ><span><i class="fa fa-comments-o"style="font-size:24px;color:green"></i></span> &nbsp Name <b>Me</b></h4><div class="datetime" id="datetime">'+time+'</div><p>'+$('#text').val()+'</p></div>');
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
     $('.chat-container').prepend('<div class="message"><h4 ><span><i class="fa fa-comments-o"style="font-size:24px;color:green"></i></span> &nbsp Name <b>'+message[2]+'</b></h4><div class="datetime" id="datetime">'+time+'</div><p>'+message[1]+'</p></div>');
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
     $('.chat-container').prepend('<div class="message"><h4 ><span><i class="fa fa-comments-o"style="font-size:24px;color:green"></i></span> &nbsp Name <b>'+message[2]+'</b></h4><div class="datetime" id="datetime">'+time+'</div><p>'+message[1]+'</p></div>');
       } 
    @endif
}
    });
 function call(){
  alert();
}
  </script>
@endsection
@section('content')
<div class="form-group">

	 <div class="col-xs-4">
	 {{-- 	@if(Auth::check()) --}}
      <label for="sel1">Select Name  (select one):</label>
    {{--   @else --}}
      {{--  <label for="sel1">Select Users  (select one):</label> --}}
      {{--  @endif --}}
      <select class="form-control" id="names" onchange="selectChat()">
<option value="">Select</option>
      	 @foreach($data as $datas)
        <option value="{{$datas->name}}" >{{$datas->name}}</option> 
        {{-- <option>2</option>
        <option>3</option>
        <option>4</option> --}}
         @endforeach 
      </select>
<script>
 // window.load=getUrl();
	 function selectChat()
 {
 	/*console.log($('#names').val());*/
 	window.location.href="/getMessages?name="+$('#names').val()+"";
 }
 function getUrl()
    {
      
        queryString=getUrlVars();
        
        if(!queryString['name'])
        {
            console.log(null);
        }else{
        var category=queryString['name'];
        console.log(decodeURIComponent(category));
       // var subject=queryString['subjects'].slice(0, -1);
       /* $('#subjectName').val(subject);
         $('#categoryName').val(category);*/
         //alert($('#categoryName').val());
}
    }
</script>
      </div>
  </div>
@if(isset($chat))
 <div class="container">
  <div class="chat-container">
   {{--  <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?1">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?2">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?1">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?2">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?1">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?2">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?1">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div>
    <div class="message">
      <img class="avatar" src="https://placeimg.com/50/50/people?2">
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div> --}}
    {{-- <div class="message">
  <h4><span><i class="fa fa-male" style="font-size:24px;color:green"></i></span> &nbsp Name <b>ali ikram </b></h4>
      <div class="datetime">23/03/2016 20:40</div>
      <p>A message text</p>
    </div> --}} 

    @foreach($chat as $chats)
    <div class="message">
    	<h4 ><span><i class="fa fa-comments-o	
" style="font-size:24px;color:green"></i></span> &nbsp Name @if(Auth::check())<b id="name">{{$chats->senderName==Auth()->user()->name ? 'Me':$chats->senderName}}</b>@elseif(Auth::guard('pharmacist')->check())<b>{{$chats->senderName==Auth::guard('pharmacist')->user()->name ? 'Me':$chats->senderName}}@endif</b></h4>
      <div class="datetime" id="datetime">{{-- 23/03/2016 20:40 --}}{{$chats->created_at}}</div>
      <p> {{ $chats->message }}</p>
    </div> 
    @endforeach
  </div>
  <form class="send-message-form">
    <input type="text" placeholder="Your message" id="text">
    <button type="submit" class="btn btn-primary" style="display:block !important">Send <i class="fa fa-comment"></i></button>

  </form>
</div>
@else
@endif
@endsection