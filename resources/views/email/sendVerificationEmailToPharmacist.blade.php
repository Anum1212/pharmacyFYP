<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    #header {
      background: #BD1616;
      color: white;
      text-align: center;
    }
  </style>
</head>

<body>
  <div id="emailBody">
    <div id="header">
      <h1>Pharmacy</h1>
    </div>
    <div id="content">
      A.S.A {{$pharmacist->name}},
      <br />
      <p>
        to verify email
        <a href="{{route('verifyPharmacistRegistration', [" email " => $pharmacist->email, "verificationToken
          " => $pharmacist->verificationToken])}}">Click Here</a>
      </p>
    </div>
  </div>
</body>

</html>