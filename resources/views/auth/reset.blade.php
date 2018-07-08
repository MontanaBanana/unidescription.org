@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="container">

<form method="POST" action="/password/reset" class="form-register">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">

    <h2 class="form-signin-heading">Password Reset</h2>


    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>

    <label for="password" class="sr-only">New Password</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
    
    <label for="password_confirmation" class="sr-only">Confirm Password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Update Password</button>

</form>

</div>

@endsection
