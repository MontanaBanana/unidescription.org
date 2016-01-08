@extends('layouts.app')

@section('content')

<div class="container">

<form method="POST" action="/auth/login" class="form-signin">
    {!! csrf_field() !!}

    <h2 class="form-signin-heading">Please sign in</h2>

	<div class="input-group margin-bottom-sm">
	  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
	  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
	</div>
	
	<div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
	  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
	</div>
	       
    <div class="checkbox">
		<label><input type="checkbox" value="remember"> Remember me</label>
	</div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

	<h6><a href="/auth/password">Forgot Password?</a></h6>

</form>

</div>

@endsection