<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      text-align: center;
    }

    #header {
      background: #D41B29;
      color: white;
    }

    #senderMessage, #adminMessage{
      background-color: #f9f9f9;
    }

  </style>
</head>

<body style="text-align: center;">
  <div id="emailBody">
    <div id="header" style="background: #D41B29; color: white;">
      <h1>LifeLine</h1>
    </div>
    <div id="content">
      <h4><b>Hi There!
        <br>
        Following is the admin's response to your message
      </b></h4>
      <br/>
      <b>Your Message</b>
      <div id="senderMessage" style="background-color: #f9f9f9">
        <p>{{$recipientData->message}}</p>
      </div>
      <br>
      <b>Admin Reply</b>
      <div id="adminMessage" style="background-color: #f9f9f9">
        <p>{{$reply}}</p>
      </div>
  </div>
  </div>
</body>

</html>