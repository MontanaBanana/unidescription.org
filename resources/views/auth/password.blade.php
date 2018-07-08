@extends('layouts.app')

@section('title', 'Password Reset')

@section('content')

<div class="row blade">
	<div class="container">
	
		<div class="col-lg-12">
			<h2 class="page-header">Password Reset</h2>
			<p style="text-align:center;">Please enter your account email address below and we will send you a link and instructions on how to update your password.</p>
			<p>&nbsp;</p>
		</div>
	
		<form method="POST" action="/password/email" class="form-register">
		    
		    {!! csrf_field() !!}
		
			<div class="input-group margin-bottom-sm">
				<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
				<label for="email">Email</label>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus>
			</div>
		
		    <button class="btn btn-lg btn-primary btn-block" type="submit">Send Link</button>
		
		</form>
	
	</div>
</div>

@endsection
