<!DOCTYPE html>
<html>
<head>
    <title>mailsend</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
   
    <p><a href="{{route('reset.password.get' , $details['token'])}}">Reset Password</a>
</p>
</body>
</html>