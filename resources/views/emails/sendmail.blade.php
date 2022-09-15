@extends('layout.base')
@section('title')
Mail Send
@stop
@section('content')
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <a href="{{route('reset.password.get' , $details['token'])}}"><button type="submit" class="btn btn-block btn-primary">Reset Password </button></a>
</p>
@endsection