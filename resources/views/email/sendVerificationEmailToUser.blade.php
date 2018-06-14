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
      background: #30A5FF;
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
      background-color: #30A5FF;
      border-radius: 5%;
      color: white;
    }

    #button a {
      color: white;
    }
  </style>
</head>

<body>
  <div id="emailBody">
    <div id="header">
      <h1>Pharmacy</h1>
    </div>
    <div id="content">
      <h1>Confirm Your Email</h1>
      <b>Hi There!</b>
      <br />
      <p>
        Please use the link below to verify your email account
        <br>
        <br>
        <br>
      </p>
    </div>
    <div id="button">
      <h2><a href="{{route('verifyCustomerRegistration', [" email " => $user->email, "verificationToken
        " => $user->verificationToken])}}">Click Here</a></h2>
    </div>
  </div>
</body>

</html>