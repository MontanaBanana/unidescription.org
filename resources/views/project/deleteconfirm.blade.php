@extends('layouts.app')

@section('title', 'Delete ' . $project->title);

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
        <ol class="breadcrumb">
            <li><a href="{{ SITEROOT }}/">Home</a></li>
            <li><a href="{{ SITEROOT }}/account">Account</a></li>
            <li><a href="{{ SITEROOT }}/account/project">My Projects</a></li>
            <li class="active">
            		{{ $project->title }}
            </li>
        </ol>
    </div>
	
	<div class="row project">
	    <div class="col-lg-12">
			<form method="POST" action="/account/project/section" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type="hidden" name="project_id" id="id" value="{{ $project->id }}" />
										        
				<div class="panel panel-danger">
				    <!-- Default panel contents -->
				    <div class="panel-heading">Are you sure you want to delete {{ $project->title }}?</div>
				    <div class="panel-body">
				        <p><strong>This action is irreversible!</strong></p>
				        <a class="btn-danger btn btn-icon label-danger delete-project"  style="width: 100%;" href="/account/project/delete/{{ $project->id }}" data-id="{{ $project->id }}"><span class="fa fa-times"></span> Yes, I am sure. Delete {{ $project->title }}.</i></a><br /><br />
				        <a class="btn btn-primary btn-icon" style="width: 100%;" href="/account/project"><span class="fa fa-angle-left"></span> Do not delete {{ $project->title }}. Go back.</i></a>

				    </div>
				</div>
			    
			</form>
	    </div>
	</div>
</div>

@endsection

@section('js')

<script type="text/javascript">
	
	$(document).ready(function() {
		
	
	});

</script>

@endsection
