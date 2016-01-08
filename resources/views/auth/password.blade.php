@extends('layouts.app')

@section('content')

<div class="container">

<form method="POST" action="/password/email" class="form-register">
    {!! csrf_field() !!}

    <h2 class="form-signin-heading">Password Reset</h2>

    <label for="email" class="sr-only">Email address</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Send Password Reset Link</button>

</form>

</div>

@endsection