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
									Phonetic Page Description:<br /><small>if you fill this field out, this text will be used in the text to speech audio instead<br/> of the description above. You might want to use this if the text to speech software<br/> isn't properly pronouncing your text.</small>
                                    <span class="pull-right"><a class="btn btn-sm btn-primary play-phonetic-description" style="position: relative; top: -5px;"><span id="phonetic-player-icon" class="fa fa-play"></span></a></span>
                                    <span class="pull-right" style="padding-right: 5px;"><a class="btn btn-sm btn-primary download-phonetic-description" style="position: relative; top: -5px;"><span id="phonetic-download-icon" class="fa fa-download"></span></a></span>
								</div>
								<div class="panel-body form-element">
									<textarea class="tall" name="phonetic_description" id="phonetic_description">{{ $section->phonetic_description }}</textarea>
								</div>
							</div>
				        						
							<div class="panel panel-default">
								<div class="panel-heading">
									Page Notes:<br /><small>internal use only</small>
								</div>
								<div class="panel-body form-element">
									<textarea class="tall" name="notes">{{ $section->notes }}</textarea>
								</div>
							</div>
							
					        <div class="wrapper-footer">
								<button id="save-page" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-floppy-o"></span> Save Page</button>
								<a class="page-complete check-complete btn btn-lg @if ($section->completed) btn-success @else btn-default @endif btn-icon"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span> Page Complete</a>
							</div>
				        </div>				        
			        </div>
			        <div class="col-md-4 tips-column">
				        
				        
	                	<div class="help">
				        	<span class="fa fa-question-circle"></span>
				        	<p>Need to learn more about best practices for audio descriptions? <a href="/guide">Read our guide</a> for more details!</p>
			        	</div>
			        	
			        	<div class="panel panel-default">
							<div class="panel-body">
                                <p><button class="btn btn-lg btn-primary btn-icon" style="width: 100%;"><span class="fa fa-floppy-o"></span> Save Page</button></p>
								<p><a class="page-complete check-complete btn btn-lg @if ($section->completed) btn-success @else btn-default @endif btn-icon" style="width: 100%;"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span> Page Complete</a></p>
							</div>
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
							<div class="panel-heading">Component Photo:</div>
							<div class="panel-body">
								<p>@if ($section->image_url)Replace the @else Upload a @endif photo for this project section.</p>
                                <p><input type="file" id="section_image" name="section_image"></p>
                                @if ($section->image_url)
                                    <div>
                                        <img id="section-photo" src="{{ $section->image_url }}?ts=<?php echo time(); ?>" style="width: 100%;" class="thumbnail" />
                                    </div>
                                    <!-- Button trigger modal -->
                                    <p>
	                                    <a class="has-image-rights btn btn-lg @if ($section->has_image_rights) btn-success @else btn-default @endif btn-icon" style="width: 100%"><span class="fa @if ($section->has_image_rights) fa-check-square-o @else fa-square-o @endif"></span> Image rights cleared</a>
                                    </p>
                                    <p>
	                                    <button type="button" class="btn btn-primary btn-lg btn-icon" data-toggle="modal" data-target="#cropModal" style="width: 100%;">
	                                        <span class="fa fa-file-image-o"></span> Crop photo
	                                    </button>
                                    </p>
                                    <p>
	                                    <button type="button" class="btn btn-primary btn-lg btn-icon label-danger"  data-toggle="modal" data-target="#deleteModal" style="width: 100%;">
	                                        <span class="fa fa-remove"></span> Delete photo
	                                    </button>
                                    </p>
                                @endif
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
								<a href="#" class="btn btn-lg btn-primary btn-icon" style="width: 100%;"><span class="fa fa-users"></span> Join Our Forum!</a>
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

        $('textarea').trumbowyg();
        //$(":file").filestyle({buttonBefore: true, placeHolder: 'Component Photo', buttonText: '&nbsp;Component Photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});
        $(":file").filestyle({icon: false, buttonText: "Component Photo", buttonName: "btn-primary"});

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
				  data: { t : $('#phonetic_description').val().replace(/(<([^>]+)>)/ig,"") },
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
				  data: { t : $('#description').val().replace(/(<([^>]+)>)/ig,"") },
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
				  data: { t : $('#description').val().replace(/(<([^>]+)>)/ig,"") },
				  dataType: "json"
				});
				 
				request.done(function( msg ) {
					window.open(msg.fn);
				});
				 
		});		
	
		$('.has-image-rights').on('click', function(event) {
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
					has_image_rights: 1,
					project_section_id: $('#project_section_id').val()
				};
			
				console.log(formData);
				// Set it completed
				$.ajax({
				    url : "/account/project/section/hasImageRights",
				    type: "POST",
				    data : formData,
				    dataType: "json",
				    success: function(data, textStatus, jqXHR)
				    {
					    console.log('the data');
					    console.log(data);
				        if (data.status == 'success') {
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
					has_image_rights: 0,
					project_section_id: $('#project_section_id').val()
				};
			
				// Set it completed
				$.ajax({
				    url : "/account/project/section/hasImageRights",
				    type: "POST",
				    data : formData,
				    dataType: "json",
				    success: function(data, textStatus, jqXHR)
				    {
					    console.log('the data');
					    console.log(data);
				        if (data.status == 'success') {
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
		
		
	  	$('.check-complete').on('click', function(event) {
			//console.log( $(this).data() );
			console.log( $(this) );
			//console.log( $(this).children() );
			//console.log( $(this).data() );

			if ($(this).children().hasClass('fa-square-o')) {
				
				var section_id = $(this).data('section_id');
				//var section = $(this);
				var section = $('.page-complete');
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
                    dataType: "json",
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
				//var section = $(this);
				var section = $('.page-complete');
				
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
                    dataType: "json",
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

        // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
        /*
        $('img.cropper').cropper('getCroppedCanvas').toBlob(function (blob) {
          var formData = new FormData();

          formData.append('croppedImage', blob);

          $.ajax('/<?php WEBROOT ?>/account/project/crop', {
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
              console.log('Upload success');
            },
            error: function () {
              console.log('Upload error');
            }
          });
        }, "image/jpeg", 0.75);

        */
        $('.cropper').cropper({
          preview: '.img-preview',
          crop: function(e) {
            // Output the result data for cropping image.
            console.log(e.x);
            console.log(e.y);
            console.log(e.width);
            console.log(e.height);
            console.log(e.rotate);
            console.log(e.scaleX);
            console.log(e.scaleY);
          },
          minContainerHeight: 400,
          minContainerWidth: 400,
    
        });

        $('#saveCrop').click(function() {
            var $img = $('.cropper');
            var canvas = $img.cropper('getCroppedCanvas');
            //console.log('canvas');
            //console.log(canvas);
            var canvasURL = canvas.toDataURL('image/jpeg');
            //console.log('url');
            //console.log(canvasURL);
            //var photo = canvasURL.toDataURL('image/jpeg');                
            //console.log('photo');
            //console.log(photo);

            $.ajax({
                method: 'POST',
                headers: { 'X-CSRF-TOKEN' : $('input[name="_token"]').val()  },
                url: '/account/project/section/crop',
                data: {
                    photo: canvasURL,
                    project_id: $('#id').val(),
                    project_section_id: $('#project_section_id').val()
                },
                dataType: "json",
                success: function(response) {
                    d = new Date();
                    $('#section-photo').attr('src', response.file + "?" + d.getTime());
                    $('#modalClose').click();
                }
            });
        });
        
        $('#deleteImage').click(function() {
            $.ajax({
                method: 'POST',
                headers: { 'X-CSRF-TOKEN' : $('input[name="_token"]').val()  },
                url: '/account/project/section/deleteImage',
                data: {
                    project_id: $('#id').val(),
                    project_section_id: $('#project_section_id').val()
                },
                dataType: "json",
                success: function(response) {
                    //$('#deleteModalClose').click();
                    $('#save-page').click();
                }
            });
        });
	});

</script>

<!-- Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crop Image</h4>
      </div>
      <div class="modal-body col-md-12">
        <div class="col-md-6">
            <img src="{{ $section->original_image }}?ts=<?php echo time(); ?>" style="width: 100%;" class="thumbnail cropper" />
        </div>
        <div class="col-md-6">
          <div class="img-preview"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="modalClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveCrop">Save changes</button>
<!--       result = $image.cropper(data.method, data.option, data.secondOption);-->
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myDeleteModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myDeleteModalLabel">Delete Photo</h4>
      </div>
      <div class="modal-body col-md-12">
	  	Are you sure you want to delete the component photo?
      </div>
      <div class="modal-footer">
        <button id="deleteModalClose" type="button" class="btn btn-default" data-dismiss="modal">No, Close</button>
        <button type="button" class="btn btn-primary label-danger" id="deleteImage">Yes, Delete Photo</button>
<!--       result = $image.cropper(data.method, data.option, data.secondOption);-->
      </div>
    </div>
  </div>
</div>


@endsection
