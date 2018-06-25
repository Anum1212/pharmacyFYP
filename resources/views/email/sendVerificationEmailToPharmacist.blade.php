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
    }

    #content h1 {
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif
    }

    #button {
      background-color: #30A5FF;
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
    <div id="header" style="background: #30A5FF;
      color: white;">
      <h1>Pharmacy</h1>
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
    <div id="button" style="background-color: #30A5FF; border-radius: 5%; color: white;">
      <h2><a style="color: white;" href="{{route('verifyPharmacistRegistration', [" email " => $pharmacist->email, "verificationToken
        " => $pharmacist->verificationToken])}}">Click Here</a></h2>
    </div>
  </div>
</body>

</html>