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
        <nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="navbar-brand">My Project:</span>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-project-navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Overview <span class="sr-only">(current)</span></a></li>
						<li><a href="/account/project/assets/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">App Store Assets</a></li>
						<li><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Table of Contents</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
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
										<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
										<p>No Template</p>
									</div>
									<div class="select-template" style="float: right;" data-template="template-nps">
										<input type="hidden" id="template-nps" value="0" />
										<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
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
									Version:
								</div>
								<div class="panel-body form-element">
									<input type="text" class="large" name="version" value="{{ $project->version }}" />
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
									Publication Date:
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
								        @endif
									</div>
									<div class="col-md-6">
										<p>This photo is used for vivamus sagittis lacinia turpis. Uploaded image should be at least 800x600 pixels.</p>
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
				        	<p>Need to learn more about best practices for audio descriptions? <a href="/guide">Read our guide</a> for more details!</p>
			        	</div>
			        	
			        	<div class="panel panel-default">
							<div class="panel-heading">Project Progress:</div>
							<div class="panel-body">
								<div class="progress">
									<?php $percent = get_project_completion_percentage($sections); ?>
									<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent; ?>%;">
										<?php echo $percent; ?>%
									</div>
								</div>
							</div>
						</div>
			        	
				        @if ($project->id)
			        	<div class="panel panel-default">
							<div class="panel-heading">Tip: Exporting</div>
							<div class="panel-body">
								<!--
								<p>When your project is completed, click below to export your app as an Android APK file or iOS project ready to upload to the App Store.</p>
								<a href="#" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-download"></span> Export Project</a>
								-->
								<p>When your project is completed, click below to export your app as an Android APK file or iOS project ready to upload to the App Store.</p>
								
								@if ($project->id)
									<a href="/account/project/export/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" target="_blank"><span class="fa fa-download"></span> Export Project</a>
								@endif
							</div>
						</div>
						@endif

				        @if ($project->id)
						<div class="panel panel-default">
							<div class="panel-heading"><h3 class="panel-title">Owner: {{ $project->user->name }}</h3></div>
							<div class="panel-body">
								Shared with:
								<ul class="list-group share-list-group">
									@foreach ($project->users as $user)
										<li class="list-group-item">
											@if ($project->is_owner())
												<span class="glyphicon glyphicon-trash pull-right" style="cursor: pointer;" aria-hidden="true" data-email="{{ $user->email }}"></span>
											@endif
											<span class="email">{{ $user->email }}</span>
										</li>
									@endforeach
								</ul>
								@if ($project->is_owner())
								<div class="input-group" id="share-input-group">
									<input type="email" class="form-control" id="share-email" placeholder="Email" aria-describedby="share-button" />
									<span class="btn input-group-addon" id="share-button"><i id="share-icon" class="fa fa-plus fa-fw"></i> Share</span>
								</div>
								@endif
			
							</div>
						</div>
						@endif
				        


			          	
			        </div>
				</div>
				<!-- /.row -->
			</form>
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
		
		$(":file").filestyle({buttonBefore: true, placeHolder: 'Project Photo', buttonText: '&nbsp;Project photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});
	    
	    $('.share-list-group').on('click', 'span.glyphicon-trash', function(event) {
		   console.log($(event.currentTarget).data('email'));
			$('#share-input-group').removeClass('has-error');
			
			$('#share-icon').removeClass("fa fa-plus fa-fw");
			$('#share-icon').addClass("fa fa-spinner fa-spin");
			
			var formData = { 
				_token: $('input[name=_token]').val(),
				project_id: $('#id').val(),
				email: $(event.currentTarget).data('email'),
				add_or_del: 'del'
			};
			
			$.ajax({
			    url : "/account/project/share",
			    type: "POST",
			    data : formData,
			    success: function(data, textStatus, jqXHR)
			    {
			        if (data.status) {
				        $('ul.share-list-group').empty();
				        for (var i = 0; i < data.users.length; i++) {
					        $('ul.share-list-group').append(
						        '<li class="list-group-item"><span class="glyphicon glyphicon-trash pull-right" style="cursor: pointer;" aria-hidden="true" data-email="'+ data.users[i].email +'"></span><span class="email">'+ data.users[i].email +'</span></li>'
					        );
				        }
				        $('#share-icon').removeClass("fa fa-spinner fa-spin");
	        			$('#share-icon').addClass("fa fa-plus fa-fw");

			        }
			        else {
				        
			        }
			    }
			}); 
	    });
	    
	    
	    $('#share-button').click(function(event) {
			var email = $('#share-email').val();
			
			if (validateEmail(email)) {
				$('#share-input-group').removeClass('has-error');
				
				$('#share-icon').removeClass("fa fa-plus fa-fw");
				$('#share-icon').addClass("fa fa-spinner fa-spin");
				
				var formData = { 
					_token: $('input[name=_token]').val(),
					project_id: $('#id').val(),
					email: email,
					add_or_del: 'add'
				}; 
				
				$.ajax({
				    url : "/account/project/share",
				    type: "POST",
				    data : formData,
				    success: function(data, textStatus, jqXHR)
				    {
				        if (data.status) {
					        $('ul.share-list-group').empty();
					        for (var i = 0; i < data.users.length; i++) {
						        $('ul.share-list-group').append(
							        '<li class="list-group-item"><span class="glyphicon glyphicon-trash pull-right" style="cursor: pointer;" aria-hidden="true" data-email="'+ data.users[i].email +'"></span><span class="email">'+ data.users[i].email +'</span></li>'
						        );
					        }
					        $('#share-icon').removeClass("fa fa-spinner fa-spin");
		        			$('#share-icon').addClass("fa fa-plus fa-fw");
				        }
				        else {
					        
				        }
				    }
				});
			} 
			else {
				$('#share-input-group').addClass('has-error');
			}
	    });

	});



</script>

@endsection