@extends('layouts.app')

@section('header')

@endsection

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <!--<h1 class="page-header">
	            @if ($project->id)
            		{{ $project->title }}
            	@else
            		Create New Project
            	@endif
        </h1>-->
	    <p>&nbsp;</p>
        <ol class="breadcrumb">
            <li><a href="{{ SITEROOT }}/">Home</a></li>
            <li><a href="{{ SITEROOT }}/account">Account</a></li>
            <li><a href="{{ SITEROOT }}/account/project">My Projects</a></li>
            <li class="active">
            	@if ($project->id)
            		{{ $project->title }}
            	@else
            		Create New Project
            	@endif
            </li>
        </ol>
    </div>

    <div class="col-lg-12">
		<p><b>Cannot build:</b> The owner of this project needs to authorize this app to be built.</p>
		<p><a class="btn btn-default" href="mailto:{{ $owner->email }}?subject=Authorize app to be build on UniDescription.org&body={{ $owner->name }}- As the owner of the {{ $project->title }} project on UniDescription.org, you must authorize the app to be built. Please go to http://www.unidescription.org/phonegapbuild/authorize and follow the instructions to allow the app to be built. Thanks!">Email {{ $owner->name }} &lt;{{ $owner->email }}&gt; to ask for authorization.</a></p>
    </div>
</div>

@endsection
