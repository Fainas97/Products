@extends('layout.app')

@section('title', 'Login')

@yield('top-bar')
@section('content')
<div class="container">
    <div class="center-login">
        <form method="post" action="/login">
            {{ csrf_field() }}
            <legend>Admin login</legend>
            <hr>
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <p class="errors">{{ $error }}</p>
            @endforeach
            @endif
            <div class="form-group">
                <label for="username">Username</label>
                <input type="username" name="username" id="username" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary" style="float: right">Login</button>
        </form>
        <div>
    </div>
@endsection