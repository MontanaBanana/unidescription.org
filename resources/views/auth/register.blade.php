@extends('layouts.app')

@section('content')

<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="row blade">
	<div class="container">

		<div class="col-lg-12">
			<h2 class="page-header">Register</h2>
		</div>

		<form method="POST" action="/auth/register" class="form-register">
		    
		    {!! csrf_field() !!}
		    
			<div class="input-group margin-bottom-sm">
			  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
			  <label for="name">Name</label>
			  <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required autofocus>
			</div>
		
			<div class="input-group margin-bottom-sm">
			  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
			  <label for="email">Email</label>
			  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required>
			</div>
		
			<div class="input-group">
			  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			  <label for="password">Password</label>
			  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			</div>
		    
		    <div class="input-group">
			  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
			  <label for="password_confirmation">Confirm Password</label>
			  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
			</div>

            <div class="g-recaptcha" data-sitekey="6LeRyCcUAAAAAPywPBDCQcG8imBSdWKqRjgtBgXz"></div>
			    
		    <div class="checkbox">
				<label><input type="checkbox" value="remember"> Remember me</label>
			</div>
		
		    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
		
		</form>

	</div>
</div>

@endsection
