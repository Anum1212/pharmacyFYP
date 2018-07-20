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
      height: 80px;
      padding: 20px 0 20px;
    }

    #content h1 {
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }

    #button {
      height: 80px;
      padding: 20px 0 20px;
      background-color: #D41B29;
      border-radius: 5%;
      color: white;
    }

    #button a {
      color: white;
    }
  </style>
</head>

<body style="text-align: center;">
  <div id="emailBody">
    <div id="header" style="background: #D41B29;
      color: white;">
      <h1>LifeLine</h1>
    </div>
    <div id="content">
      <h1 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Confirm Your Email</h1>
      <b>Hi There!</b>
      <br />
      <p>
        Please use the link below to verify your email account
        <br>
        <br>
        <br>
      </p>
    </div>
    <div id="button" style="background-color: #D41B29; border-radius: 5%; color: white;">
      <h2><a style="color: white;" href="{{route('verifyCustomerRegistration', [" email " => $user->email, "verificationToken
        " => $user->verificationToken])}}">Click Here</a></h2>
    </div>
  </div>
</body>

</html>