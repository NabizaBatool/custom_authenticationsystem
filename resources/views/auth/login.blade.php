<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <h4>Login | Custom Auth</h4>
                <hr>
                <form action="{{ route('auth.check') }}" method="post">
                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{old('email')}}">
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                    <br>
                    <a href="{{ route('auth.register') }}">I don't have an account, create new</a>
                    <p class="my-3 text-gray-500">Don't remember password? <a class="text-blue-500 underline" href="{{ route('password.request') }}">Forget Passsword</a> </p>
                </form>
               
            </div>
        </div>
    </div>
</body>

</html>
</body>

</html>