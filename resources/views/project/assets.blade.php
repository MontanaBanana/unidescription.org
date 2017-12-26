@extends('layouts.app')

@section('title', $project->title . ' Assets')

@section('header')

@endsection

@section('content')

<?php
	$c = DB::select('SELECT can_edit FROM project_user WHERE project_id=:projectid AND user_id=:userid LIMIT 1', ['projectid'=>$project->id, 'userid'=>Auth::user()->id]);
	$c = array_shift($c);
	$editable = 0;
	if($c){
		$editable = $c->can_edit;
	}
	if($project->user_id == Auth::user()->id){$editable = 1;}
?>

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
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!-- <span class="navbar-brand">My Project:</span> -->
					</div>
	
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-project-navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Overview <span class="sr-only">(current)</span></a></li>
							<li class="active"><a href="/account/project/assets/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Media Assets</a></li>
							<li><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Table of Contents</a></li>
							<li><a href="/library" target="_blank">Phonetic Library</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
	    </div>
	    
		
		<div class="row project">
		    <div class="col-lg-12">
				<!--<form method="POST" action="/account/project/edit" enctype="multipart/form-data">-->		
					
					<div class="row">
				        <div class="col-md-8 edit-column">
					        <div class="wrapper">
								
								@if($editable)
								<!-- app store assets -->
								<div class="panel panel-default">
									<div class="panel-heading">Project assets:</div>
									<div class="panel-body white">
										<?php $c = false; foreach ($assets as $a): ?>
											<div class="row" style="<?php echo (($c = !$c)?'background-color: #f5f5f5':'') ?>; padding: 10px;">
												<h4 class="media-heading"><a target="_blank" href="/assets/projects/<?php echo $project->id; ?>/assets/<?php echo $a['title']; ?>"><?php echo $a['title']; ?></a><span data-asset_id="<?php echo $a['id']; ?>" class="toc-icon asset-delete label pull-right label-danger" style="width: 28px;" data-toggle="tooltip" data-placement="left" title="Delete"><span class="fa fa-times"></span></span></h4>
	                                            
												Uploaded by <a href="mailto:<?php echo $a->user->email; ?>"><?php echo $a->user->name; ?></a> on <?php echo date('F jS, Y', strtotime($a->created_at)); ?>
											</div>
										<?php endforeach; ?>
										<div class="panel-note">
											<form method="POST" action="/account/project/assets" enctype="multipart/form-data" id="section_form">
												{{ csrf_field() }}
												<input type="hidden" name="project_id" id="id" value="{{ $project->id }}"  />
												<p>
													<input type="file" id="asset" name="asset[]" onchange="javascript:this.form.submit();" multiple><br />
													This section allows you to store all assets related to this project.
													The assets are not automatically included in the export of the app.<br />
												</p>
											</form>
										</div>
									</div>
								</div>
								@endif
		<!--						
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
	-->
	
								
								<div class="panel panel-default">
									<div class="panel-heading">
										App Store Description:
										<!--<span class="label pull-right label-info">Good Text Length</span>-->
									</div>
									<div class="panel-body form-element">
										<textarea name="description" <?php if(!$editable){echo 'disabled';}?>>{{ $project->description }}</textarea>
									</div>
								</div>
					
								@if($editable)
									<div class="wrapper-footer">
										<button class="btn btn-lg btn-primary btn-icon" type="submit"><span class="fa fa-floppy-o"></span> Save Details</button>
										<!--<a href="#" class="btn btn-lg btn-success btn-icon"><span class="fa fa-check"></span> Project Details Saved</a>-->
									</div>
								@endif
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
				<!--</form>-->
		    </div>
		</div>
	</div>
</div>

@endsection

@section('js')

@if($editable)
<script type="text/javascript">
	
	$(document).ready(function() {
		
	  	$('.asset-delete').on('click', function(event) {

/*
	    	var section_id = $(this).data('section_id');
			var section = $(this);
			
			//$(section).addClass('label-success');
			//$(section).removeClass('label-default');

			var deleted = 0;
			if ($(section).children().hasClass("fa-times")) {
				$(section).children().removeClass('fa-times');
				deleted = 1;
			}
			else {
				$(section).children().removeClass('fa-undo');
			}
			
			$(section).children().addClass("fa-spinner fa-spin");
*/
			
			var formData = { 
				_token: $('input[name=_token]').val(),
				deleted: 1,
				id: $(this).data('asset_id')
			};

			if (confirm('Are you sure you want to delete this?')) {	
				// Set it completed
				$.ajax({
					url : "/account/project/asset/delete",
					type: "POST",
					data : formData,
					success: function(data, textStatus, jqXHR)
					{
						if (data.status) {
							location.reload();
							//$(section).children().removeClass("fa-spinner fa-spin");
							//$(section).removeClass('label-success');
							//$(section).addClass('label-default');
							//location.reload();
						}
						else {
							alert('Error: contact the site admin');
						}
					}
				});
			}
	  	});

	});



</script>
@endif

@endsection
