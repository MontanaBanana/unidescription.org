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
						<li><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Overview <span class="sr-only">(current)</span></a></li>
						<li><a href="/account/project/assets/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Media Assets</a></li>
						<li><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Table of Contents</a></li>
						<li class="active"><a href="#">{{ $section->title }}</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
    </div>
    
	
	<div class="row project">
	    <div class="col-lg-12">
			<form method="POST" action="/account/project/section" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type="hidden" name="project_id" id="id" value="{{ $project->id }}" />
				<input type="hidden" name="project_section_id" id="project_section_id" value="{{ $section->id }}" />		
				
				<div class="row">
			        <div class="col-md-8 edit-column">
				        <div class="wrapper">
					        
					        <div class="panel panel-default">
								<div class="panel-heading">
									Page Name:
									<!--<span class="label pull-right label-info">Good Text Length</span>-->
								</div>
								<div class="panel-body form-element">
									<input type="text" class="large" name="title" value="{{ $section->title }}">
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									Page Description:
									<!--<span class="label pull-right label-info">Good Text Length</span>-->
									<span class="pull-right"><a class="btn btn-sm btn-primary play-description" style="position: relative; top: -5px;"><span id="player-icon" class="fa fa-play"></span></a></span>
									<span class="pull-right" style="padding-right: 5px;"><a class="btn btn-sm btn-primary download-description" style="position: relative; top: -5px;"><span id="download-icon" class="fa fa-download"></span></a></span>

								</div>
								<div class="panel-body form-element">
									<textarea class="tall" name="description" id="description" placeholder="<?php echo get_placeholder_text($section->title); ?>">{{ $section->description }}</textarea>
								</div>
							</div>
				        						
							<div class="panel panel-default">
								<div class="panel-heading">
									Phonetic Page Description (... description about what this means ...):
                                    <span class="pull-right"><a class="btn btn-sm btn-primary play-phonetic-description" style="position: relative; top: -5px;"><span id="phonetic-player-icon" class="fa fa-play"></span></a></span>
                                    <span class="pull-right" style="padding-right: 5px;"><a class="btn btn-sm btn-primary download-phonetic-description" style="position: relative; top: -5px;"><span id="phonetic-download-icon" class="fa fa-download"></span></a></span>
								</div>
								<div class="panel-body form-element">
									<textarea class="tall" name="phonetic_description" id="phonetic_description">{{ $section->phonetic_description }}</textarea>
								</div>
							</div>
				        						
							<div class="panel panel-default">
								<div class="panel-heading">
									Page Notes (internal use only):
								</div>
								<div class="panel-body form-element">
									<textarea class="tall" name="notes">{{ $section->notes }}</textarea>
								</div>
							</div>
							
					        <div class="wrapper-footer">
								<button class="btn btn-lg btn-primary btn-icon"><span class="fa fa-floppy-o"></span> Save Page</button>
								<a class="check-complete btn btn-lg @if ($section->completed) btn-success @else btn-default @endif btn-icon"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span> Page Complete</a>
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
						
						<div class="panel panel-default">
							<div class="panel-heading">Section Photo:</div>
							<div class="panel-body">
								<p>Upload a photo for this project section.</p>
                                @if ($section->image_url)
                                    <img src="{{ $section->image_url }}" style="width: 100%;" class="thumbnail" />
                                @endif
                                <input type="file" id="section_image" name="section_image">
							</div>
						</div>
			          	
						<div class="panel panel-default">
							<div class="panel-heading">Content Tips:</div>
							<div class="panel-body">
								<p>Click on the subjects below to read more about the best practices for audio descriptions for this page.</p>
								<ul class="standard-list">
									<li>&bull; <a href="#">Lorem ipsum dolor sit amet</a></li>
									<li>&bull; <a href="#">Consectetur adipiscing elit</a></li>
									<li>&bull; <a href="#">Vivamus sagittis lacinia turpis</a></li>
									<li>&bull; <a href="#">Class aptent taciti sociosqu ad litora</a></li>
								</ul>
								<a href="#" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-users"></span> Join Our Forum!</a>
							</div>
						</div>
			          	
			        </div>
				</div>
				<!-- /.row -->
			
			        
			    <div class="row creator">
			        
			       
			    </div>
			    
			</form>
	    </div>
	</div>
</div>

@endsection

@section('js')

<script type="text/javascript">
	
	var audio;
	
	$(document).ready(function() {

        $(":file").filestyle({buttonBefore: true, placeHolder: 'Section Photo', buttonText: '&nbsp;Section Photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});

		$('.play-phonetic-description').on('click', function(event) {
			

			/*
			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, 'http://api.montanab.com/tts/tts.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$request->description);
			
			//execute post
			$result = json_decode(curl_exec($ch));
			
			$ps->audio_file_url = $result->fn;
			$ps->audio_file_needs_update = false;
			*/
			if ($('#phonetic-player-icon').hasClass('fa-play')) {
				$('#phonetic-player-icon').removeClass('fa-play');
				$('#phonetic-player-icon').addClass('fa-stop');
				
				var request = $.ajax({
				  url: "http://api.montanab.com/tts/tts.php",
				  method: "POST",
				  data: { t : $('#phonetic_description').val() },
				  dataType: "json"
				});
				 
				request.done(function( msg ) {
					console.log(msg.fn);
					audio = new Audio(msg.fn);
					audio.play();
					audio.addEventListener('ended', function() {
						$('#phonetic-player-icon').removeClass('fa-stop');
						$('#phonetic-player-icon').addClass('fa-play');
					});
				});
				 
				request.fail(function( jqXHR, textStatus ) {
				  alert( "Request failed: " + textStatus );
				});
			}
			else {
				$('#phonetic-player-icon').removeClass('fa-stop');
				$('#phonetic-player-icon').addClass('fa-play');
				
				audio.pause();
				audio.currentTime = 0;
			}
		});
		
		$('.play-description').on('click', function(event) {
			

			/*
			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, 'http://api.montanab.com/tts/tts.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$request->description);
			
			//execute post
			$result = json_decode(curl_exec($ch));
			
			$ps->audio_file_url = $result->fn;
			$ps->audio_file_needs_update = false;
			*/
			if ($('#player-icon').hasClass('fa-play')) {
				$('#player-icon').removeClass('fa-play');
				$('#player-icon').addClass('fa-stop');
				
				var request = $.ajax({
				  url: "http://api.montanab.com/tts/tts.php",
				  method: "POST",
				  data: { t : $('#description').val() },
				  dataType: "json"
				});
				 
				request.done(function( msg ) {
					console.log(msg.fn);
					audio = new Audio(msg.fn);
					audio.play();
					audio.addEventListener('ended', function() {
						$('#player-icon').removeClass('fa-stop');
						$('#player-icon').addClass('fa-play');
					});
				});
				 
				request.fail(function( jqXHR, textStatus ) {
				  alert( "Request failed: " + textStatus );
				});
			}
			else {
				$('#player-icon').removeClass('fa-stop');
				$('#player-icon').addClass('fa-play');
				
				audio.pause();
				audio.currentTime = 0;
			}
		});
		
		$('.download-description').on('click', function(event) {

				var request = $.ajax({
				  url: "http://api.montanab.com/tts/tts.php",
				  method: "POST",
				  data: { t : $('#description').val() },
				  dataType: "json"
				});
				 
				request.done(function( msg ) {
					window.open(msg.fn);
				});
				 
		});		
		
		
	  	$('.check-complete').on('click', function(event) {
			//console.log( $(this).data() );
			console.log( $(this) );
			//console.log( $(this).children() );
			//console.log( $(this).data() );

			if ($(this).children().hasClass('fa-square-o')) {
				
				var section_id = $(this).data('section_id');
				var section = $(this);
				//$(section).addClass('label-success');
				//$(section).removeClass('label-default');
				$(section).children().removeClass('fa-square-o');
    			$(section).children().addClass("fa-spinner fa-spin");

				var formData = { 
					_token: $('input[name=_token]').val(),
					completed: 1,
					id: $('#project_section_id').val()
				};
			
				console.log(formData);
				// Set it completed
				$.ajax({
				    url : "/account/project/completed",
				    type: "POST",
				    data : formData,
				    success: function(data, textStatus, jqXHR)
				    {
				        if (data.status) {
					        $(section).children().removeClass("fa-spinner fa-spin");
					        $(section).removeClass('btn-default');
							$(section).addClass('btn-success');
							$(section).children().addClass('fa-check-square-o');
	
				        }
				        else {
					        alert('Error: contact the site admin.');
				        }
				    }
				});
			}
			else {
				var section_id = $(this).data('section_id');
				var section = $(this);
				
				//$(section).addClass('label-success');
				//$(section).removeClass('label-default');
				$(section).children().removeClass('fa-check-square-o');
    			$(section).children().addClass("fa-spinner fa-spin");

				var formData = { 
					_token: $('input[name=_token]').val(),
					completed: 0,
					id: $('#project_section_id').val()
				};
			
				// Set it completed
				$.ajax({
				    url : "/account/project/completed",
				    type: "POST",
				    data : formData,
				    success: function(data, textStatus, jqXHR)
				    {
				        if (data.status) {
					        $(section).children().removeClass("fa-spinner fa-spin");
					        $(section).removeClass('btn-success');
							$(section).addClass('btn-default');
							$(section).children().addClass('fa-square-o');
	
				        }
				        else {
					        alert('Error: contact the site admin');
				        }
				    }
				});
				// Set it not completed
			}
			
			//<span data-section_id="{{ $section->id }}" class="check-complete label pull-right label-default"><span class="fa fa-square-o"></span></span>

	  	});

	
	});

</script>

@endsection
