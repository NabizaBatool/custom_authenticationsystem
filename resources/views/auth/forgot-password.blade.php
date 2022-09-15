@extends('layout.base')
@section('title')
Forget Password
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top:55px">
        <div class="col-md-4 col-md-offset-4">
            <h4>Reset Password | Custom Auth</h4>
            <hr>
            <form action="{{ route('send-mail')}}" method="post">
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
                <button type="submit" class="btn btn-block btn-primary">Reset</button>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection