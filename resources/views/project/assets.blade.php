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
						<li class="active"><a href="/account/project/assets/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">App Store Assets</a></li>
						<li><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Table of Contents</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
    </div>
    
	
	<div class="row project">
	    <div class="col-lg-12">
			<form method="POST" action="/account/project/edit" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<input type="hidden" name="id" id="id" value="{{ $project->id }}" />			
				
				<div class="row">
			        <div class="col-md-8 edit-column">
				        <div class="wrapper">
								        
							<!-- app store assets -->
							<div class="panel panel-default">
								<div class="panel-heading">App Store Icons:</div>
								<div class="panel-body white">
									<div class="col-md-6">
										<p><b>Icon for iOS (Apple Devices):</b></p>
										<div class="col-md-6 no-left-padding">
											<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
										</div>
										<div style="clear:both;"></div>
										<p>iOS App Store icon should be square, at least 1024x1024. The system will create all smaller sizes for you.</p>
									</div>
									<div class="col-md-6">
										<p><b>Icon for Android:</b></p>
										<div class="col-md-6 no-left-padding">
											<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
										</div>
										<div style="clear:both;"></div>
										<p>Android App Store icon should be a  PNG file with optional transparency, at least 1024x1024.</p>
									</div>
									<div style="clear:both;"></div>
									<div class="panel-note">
										<img class="icon" src="{{ SITEROOT }}/images/icon-psd.png" alt="Photoshop Icon" width="56" height="56" />
										<p><a href="#">Download</a> this Photoshop (PSD) template with the National Park Service logo for branding consistency. You’ll find a layer in this PSD file to place your artwork.</p>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">Loading Screen/App Screenshots:</div>
								<div class="panel-body white">
									<div class="col-md-6">
										<p><b>Splash/Loading Screen:</b></p>
										<div class="col-md-6 no-left-padding">
											<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
										</div>
										<div style="clear:both;"></div>
										<p>
											iOS and Android splash screen image sizes can be found at these URLs:<br>
											<a href="#">Apple.com</a> | <a href="#">Android.com</a>
										</p>
									</div>
									<div class="col-md-6">
										<p><b>App Store Screenshot:</b></p>
										<div class="col-md-6 no-left-padding">
											<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
										</div>
										<div class="col-md-6">
											<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
										</div>
										<div style="clear:both;"></div>
										<p>
											iOS and Android screenshot image sizes can be found at these URLs:<br>
											<a href="#">Apple.com</a> | <a href="#">Android.com</a>
										</p>
									</div>
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
								<p>Keep track of your app store assets here.</p>
								<p>When your project is completed, click below to export your app as an Android APK file or iOS project ready to upload to the App Store.</p>
								
								@if ($project->id)
									<a href="/account/project/export/{{ $project->id }}" class="btn btn-lg btn-primary btn-icon" target="_blank"><span class="fa fa-download"></span> Export Project</a>
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
		
		$('.toc-arrow').on('click', function() {
	    	$(this).toggleClass('glyphicon-chevron-right').toggleClass('glyphicon-chevron-down');
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
	    
	    // Take the nav bar into account
	    $(window).on("hashchange", function () {
		    window.scrollTo(window.scrollX, window.scrollY - 60);
		});
		
		var not_started_count = 0;
		var total_count = 0;
		$('textarea', $('div.creator')).each(function(index) {

			total_count++;
			
			var label_match = $(this).attr('id').match(/(\d+)/);
			var section_id = label_match[0];
			var length = $(this).val().length;
			var section_label = $('span.section-'+section_id+'-label');
			
			$(section_label).removeClass('label-default label-primary label-success label-info label-warning label-danger');
			
			var new_label_class = '';
			if (length == 0) {
				new_label_class = 'label-default';
				new_label_text = 'Not Started';
				not_started_count++;
			}
			else if (length <= 20) {
				new_label_class = 'label-danger';
				new_label_text = 'Not Enough Text';
			}
			else if (length <= 100) {
				new_label_class = 'label-warning';
				new_label_text = 'Text Seems Short';
			}
			else if (length <= 300) {
				new_label_class = 'label-info';
				new_label_text = 'Good Text Length';
			}
			else {
				new_label_class = 'label-success';
				new_label_text = 'Great Text Length';
			}
			
			$(section_label).addClass(new_label_class);
			$(section_label).html(new_label_text)

		});
		
		$('textarea', $('div.creator')).keyup(function(event) {
			var label_match = $(event.currentTarget).attr('id').match(/(\d+)/);
			var section_id = label_match[0];
			var length = $(event.currentTarget).val().length;
			var section_label = $('span.section-'+section_id+'-label');
			
			$(section_label).removeClass('label-default label-primary label-success label-info label-warning label-danger');
			
			var new_label_class = '';
			if (length == 0) {
				new_label_class = 'label-default';
				new_label_text = 'Not Started';
			}
			else if (length <= 20) {
				new_label_class = 'label-danger';
				new_label_text = 'Not Enough Text';
			}
			else if (length <= 100) {
				new_label_class = 'label-warning';
				new_label_text = 'Text Seems Short';
			}
			else if (length <= 300) {
				new_label_class = 'label-info';
				new_label_text = 'Good Text Length';
			}
			else {
				new_label_class = 'label-success';
				new_label_text = 'Great Text Length';
			}
			
			$(section_label).addClass(new_label_class);
			$(section_label).html(new_label_text)
	
		});
	
	});



</script>

@endsection