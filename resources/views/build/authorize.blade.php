@extends('layouts.app')

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
	<div class="container">
	    <div class="col-lg-12">
		    <p>&nbsp;</p>
	        <ol class="breadcrumb">
	            <li><a href="{{ SITEROOT }}/">Home</a></li>
	            <li><a href="{{ SITEROOT }}/account">Account</a></li>
	            <li class="active">
					Adobe PhoneGap Build - Authorize
	            </li>
	        </ol>
	    </div>
	</div>
</div>

<div class="row">
	<div class="container">
		<div class="col-lg-12">
			<h2>Adobe PhoneGap Build</h2>
			<p>We use Adobe's PhoneGap Build to create the app packages for iOS and Android. You will need to create an Adobe account, or use your existing one.</p>
			<p><a href="https://build.phonegap.com/authorize?client_id=<?php echo env('PHONEGAP_BUILD_CLIENT_ID'); ?>" class="btn btn-default btn-wide">Authorize Adobe PhoneGap Build</a>
		</div>
	</div>
</div>
	    
@endsection
