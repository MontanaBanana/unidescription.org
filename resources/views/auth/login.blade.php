@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="row blade">
	<div class="container">
	
		<div class="col-lg-12">
			<h2 class="page-header">Please sign in</h2>
		</div>
	
		<form method="POST" action="/auth/login" class="form-signin">
			
			{!! csrf_field() !!}
			    
			<div class="input-group margin-bottom-sm">
			  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
			  <label for="email">Email</label>
			  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
			</div>
			
			<div class="input-group">
			  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			  <label for="password">Password</label>
			  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			</div>
			       
		    <div class="checkbox">
				<label><input type="checkbox" value="remember"> Remember me</label>
			</div>
		
		    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		
			<h6><a href="/auth/password">Forgot Password?</a></h6>
		
		</form>
	
	</div>
</div>

@endsection
