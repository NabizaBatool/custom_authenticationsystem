@extends('layout.base')
@section('title')
Dashboard
@stop
@section('content')

<div class="container">
    <div class="row justify-content-center" style="margin-top:50px">
        <div class="col-md-6 col-md-offset-3">
            <h4>Dashboard</h4>
            <hr>
            <table class="table table-hover">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $LoggedUserInfo['name'] }}</td>
                        <td>{{ $LoggedUserInfo['email'] }}</td>
                        <td><a href="{{ route('auth.logout') }}">Logout</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

@stop
<style>
    .container{
        background-color: lightcoral;
    }
</style>