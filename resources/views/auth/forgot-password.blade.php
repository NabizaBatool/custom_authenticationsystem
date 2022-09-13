<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    body {
        background-color: black;
    }

    h4 {
        color: gray;
    }

    label {
        font-weight: bold;
        color: #0069d9;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center" style="margin-top:55px">
            <div class="col-md-4 col-md-offset-4">
                <h4>Reset Password | Custom Auth</h4>
                <hr>
                <form action="{{ route('password.email')}}/"{{$token}} method="post">
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{old('email')}}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Reset</button>
                    <br>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
</body>

</html>