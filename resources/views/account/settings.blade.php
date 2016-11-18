@extends('layouts.app')

@section('title', 'Account Settings');

@section('content')

<div class="row settings">
    <div class="col-lg-12">
	    
<form method="POST" action="/account/settings" class="form-register" enctype="multipart/form-data">
    {!! csrf_field() !!}
    
    <h2 class="form-signin-heading">Settings</h2>
    
    @if (Auth::user()->image_url)
    	<img src="<?php echo Auth::user()->image_url; ?>?ts=<?php echo time(); ?>" class="img-responsive thumbnail" />
    @endif
    
    <div class="input-group margin-bottom-sm">
	  <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
	  <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?php echo Auth::user()->name; ?>" required autofocus>
	</div>
	
	<div class="input-group margin-bottom-sm">
	  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
	  <input type="email" id="email" name="email" class="form-control" placeholder="Email address" value="<?php echo Auth::user()->email; ?>" required>
	</div>

	<div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
	  <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
	</div>

	<div class="input-group">
	  <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
	  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete="off">
	</div>
	
	<div class="input-group">
		<input type="file" id="profile_photo" name="profile_photo">
	</div>
    
    <div class="checkbox">
		<label><input type="checkbox" value="remember"> Remember me</label>
	</div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Update Account</button>

</form>

    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
$( document ).ready(function() {
    //$(":file").filestyle({buttonBefore: true, placeHolder: 'Profile Photo', buttonText: '&nbsp;Profile photo', size: 'lg', input: false, iconName: "fa fa-camera-retro"});
    $(":file").filestyle({icon: true, iconName: "fa fa-camera-retro", buttonText: "Update Profile Photo", buttonName: "btn-primary", input: false});
});
</script>

@endsection
