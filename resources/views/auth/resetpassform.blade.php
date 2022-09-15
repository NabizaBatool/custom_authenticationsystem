@extends('layout.base')
@section('title')
Reset Password
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top:55px">
        <div class="col-md-4 col-md-offset-4">
            <h4>Reset Password | Custom Auth</h4>
            <hr>
            <form action="{{ route('reset.password.post') }}" method="post">
                @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
                @endif

                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{old('email')}}">
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                </div>
                <input type="hidden" class="form-control" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="newpassword" placeholder="Enter new password">
                    <span class="text-danger">@error('newpassword'){{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" class="form-control" name="newpasswordconfirm" placeholder="Enter new password again">

                </div>
                <button type="submit" class="btn btn-block btn-primary">Update password</button>
            </form>

        </div>
    </div>
</div>

@endsection