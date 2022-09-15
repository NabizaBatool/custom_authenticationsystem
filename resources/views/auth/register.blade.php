@extends('layout.base')
@section('title')
Register
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-top:55px">
            <div class="col-md-4 col-md-offset-4">
                <h4>Register | Custom Auth</h4>
                <hr>
                <form action="{{ route('auth.save') }} " method="post">
                    @if(Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{old('name')}}">
                        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                    </div>
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
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpassword" placeholder="Password confirmation" >
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
                    <br>
                    <a href="{{ route('auth.login') }}">I already have an account, Sign In</a>
                </form>
            </div>
        </div>
    </div>
@endsection