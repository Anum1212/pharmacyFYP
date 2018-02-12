to verify email
  <a href="{{route('sendEmailToUser', ["email" => $user->email, "verificationToken" => $user->verificationToken])}}">Click Here</a>
