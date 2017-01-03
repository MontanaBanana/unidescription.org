@extends('layouts.app')

@section('title', $project->title . ' Details')

@section('header')

@endsection

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
	<div class="container">
		<div class="col-lg-12">
			<h1 class="page-header">
					@if ($project->id)
						{{ $project->title }}
					@else
						Create New Project
					@endif
			</h1>
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
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-project-navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!--<span class="navbar-brand">My Project:</span>-->
					</div>
	
					<!-- Collect the nav links, forms, and other content for toggling -->
					<?php
					if ($project->id > 0) {
					?> 
					<div class="collapse navbar-collapse" id="bs-project-navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Overview <span class="sr-only">(current)</span></a></li>
							<li><a href="/account/project/assets/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Media Assets</a></li>
							<li><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Table of Contents</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
					<?php
					}
					?>
				</div><!-- /.container-fluid -->
			</nav>
		</div>
		
		
		<div class="row project">
			<div class="col-lg-12">
				<form method="POST" action="/account/project/details" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<input type="hidden" name="id" id="id" value="{{ $project->id }}" />			
					
					<div class="row">
						<div class="col-md-8 edit-column">
							<div class="wrapper">
											
								<!-- project details -->
								@if (!$project->id)
								<input type="hidden" id="chosen_template" name="chosen_template" value="template-none" />
	
								<div class="panel panel-default">
									<div class="panel-heading">Project Template:</div>
									<div class="panel-body">
										<div class="select-template selected" style="float: left;" data-template="template-none">
											<img class="thumbnail" src="https://placeholdit.imgix.net/~text?txtsize=14&txt=No%20Template&w=200&h=131" alt="No Template placeholder">
											<p>No Template</p>
										</div>
										<div class="select-template" style="float: right;" data-template="template-nps">
											<input type="hidden" id="template-nps" value="0" />
											<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="NPS Campfires and Candlelight">
											<p>NPS Unigrid Brochure</p>
										</div>
									</div>
								</div>
								@endif
				
								<div class="panel panel-default">
									<div class="panel-heading">
										Project Name:
										<!--<span class="label pull-right label-info">Good Text Length</span>-->
									</div>
									<div class="panel-body form-element">
										<input type="text" class="large" name="title" value="{{ $project->title }}" />
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										App Store Description:
										<!--<span class="label pull-right label-info">Good Text Length</span>-->
									</div>
									<div class="panel-body form-element">
										<textarea name="description">{{ $project->description }}</textarea>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										GPO #:
									</div>
									<div class="panel-body form-element">
										<input type="text" class="large" name="gpo" value="{{ $project->gpo }}" />
									</div>
								</div>
	
								<div class="panel panel-default">
									<div class="panel-heading">
										Version / Version Notes:
									</div>
									<div class="panel-body form-element">
										<!--<input type="text" class="large" name="version" value="{{ $project->version }}" />-->
										<textarea name="version">{{ $project->version }}</textarea>
									</div>
								</div>
	
								<div class="panel panel-default">
									<div class="panel-heading">
										Metatags: (comma separated list. i.e.: National Historial Site, Oregon, bison, Midwest.)
									</div>
									<div class="panel-body form-element">
										<input type="text" class="large" name="metatags" value="{{ $project->metatags }}" />
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										Author:
									</div>
									<div class="panel-body form-element">
										<input type="text" class="large" name="author" value="{{ $project->author }}" />
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										Publication year of brochure:
									</div>
									<div class="panel-body form-element">
										<input type="text" class="large" name="publication_date" value="{{ $project->publication_date }}" />
									</div>
								</div>
																																				
								<div class="panel panel-default">
									<div class="panel-heading">Project Photo:</div>
									<div class="panel-body white">
										<div class="col-md-6">
											@if ($project->image_url)
												<img src="{{ $project->image_url }}" style="width: 100%;" class="thumbnail" />
												<button type="button" class="btn btn-primary btn-lg btn-icon label-danger" id="deleteProjectImage" style="width: 100%;">
														<span class="fa fa-remove"></span> Delete photo
												</button>
											@endif
										</div>
										<div class="col-md-6">
											<p>Uploaded image should be at least 800x600 pixels.</p>
											<input type="file" id="project_image" name="project_image">
											<!--<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload Photo</a>-->
										</div>
	
									</div>
								</div>
	
	  
								<div class="wrapper-footer">
									<button class="btn btn-lg btn-primary btn-icon" type="submit"><span class="fa fa-floppy-o"></span> Save Details</button>
									<!--<a href="#" class="btn btn-lg btn-success btn-icon"><span class="fa fa-check"></span> Project Details Saved</a>-->
								</div>
							</div>
	
						</div>
						<div class="col-md-4 tips-column">
							
							
							<div class="help">
								<span class="fa fa-question-circle"></span>
								<p>Need to learn more about best practices for audio descriptions? <a href="/unid-academy">Read our guide</a> for more details!</p>
							</div>
	
							@include('project.todo.main')
	
							@include('project.shared.version')
	
							@include('project.shared.progress')
							
							@include('project.shared.export')
	
							@include('project.shared.owner')
	
						</div>
					</div>
					<!-- /.row -->
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')

<script type="text/javascript">
	
	$(document).ready(function() {
		
		$('.select-template').on('click', function(e) {
			$('.select-template').removeClass('selected');
			$(this).addClass('selected');
			
			console.log( $(e.currentTarget).data('template') );
			$('#chosen_template').val( $(e.currentTarget).data('template') );
			//console.log( $(e).data() );
		});
		
		$('#deleteProjectImage').click(function() {
			$.ajax({
				method: 'POST',
				headers: { 'X-CSRF-TOKEN' : $('input[name="_token"]').val()  },
				url: '/account/project/deleteProjectImage',
				data: {
					project_id: $('#id').val(),
				},
				dataType: "json",
				success: function(response) {
					location.reload();
					//$('#deleteModalClose').click();
					//$('#save-page').click();
					//$('#was_autosave').val(0);
					//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post'});

				}
			});
		});		//$(":file").filestyle({buttonBefore: true, placeHolder: 'Project Photo', buttonText: '&nbsp;Project photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});

	});

</script>

@endsection
