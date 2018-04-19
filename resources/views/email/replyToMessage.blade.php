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
      <h1>Laravel Pharmacy Project</h1>
    </div>
    <div id="content">
      A.S.A {{$recipientData->name}},
      <br />
      <p>{{$reply}}</p>
    </div>
  </div>
</body>

</html>