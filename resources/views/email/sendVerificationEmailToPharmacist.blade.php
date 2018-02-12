to verify email
  <a href="{{route('sendEmailToPharmacist', ["email" => $pharmacist->email, "verificationToken" => $pharmacist->verificationToken])}}">Click Here</a>
