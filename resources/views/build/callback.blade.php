@extends('layouts.app')

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
	    <p>&nbsp;</p>
        <ol class="breadcrumb">
            <li><a href="{{ SITEROOT }}/">Home</a></li>
            <li><a href="{{ SITEROOT }}/account">Account</a></li>
            <li class="active">
				Adobe PhoneGap Build - Authorized
            </li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-lg-12">
		<h2>Adobe PhoneGap Build</h2>
		<p>You have successfully approved the UniDescription tool to access your Adobe account for building PhoneGap application.</p>
		<p><a href="{{ SITEROOT }}/account/project" class="btn btn-default">Go to projects</a>

	</div>
</div>
	    
@endsection
