@extends('layout.base')
@section('title')
Login
@stop

@section('content')
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
@endsection