@extends('layouts.app')

@section('title', $section->title)

@section('header')
	
    <link href="/css/magnific-popup.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="/js/jquery.form.js"></script>
	<script type="text/javascript" src="/js/jquery.magnific-popup.min.js"></script>


			<script type="text/javascript" src="/js/audio/recorder.js"></script>
			<script type="text/javascript" src="/js/audio/recordLive.js"></script>
			
<style>
	#recordingslist td{
		display: inline-block;
		margin:3px;
	}
	#recordingslist td:first-child{
		display:block;
	}
	.soundBite{
		border-top: 1px solid #ccc;
		padding: 10px 0;
		margin-bottom:4px;
		display:block;
	}
	
	.blink {
	    animation: blinker 1.5s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
	}
	@keyframes blinker {  
	  from { opacity: 1; }
	  to { opacity: 0; }
	}
</style>

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
	        <nav class="navbar navbar-default" style="border-radius: 4px;">
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
					<div class="collapse navbar-collapse" id="bs-project-navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Backstage <span class="sr-only">(current)</span></a></li>
							<li><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Frontstage</a></li>
							<li class="active"><a href="#">{{ $section->title }}</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
	    </div>
	    
		
		<div class="row project">
		    <div>

				<?php if ($was_locked): ?>
					<form method="POST" action="/account/project/section" enctype="multipart/form-data" id="section_form">
				<?php else: ?>
					<form method="GET" action="#" enctype="multipart/form-data" id="section_form">
				<?php endif; ?>
			
					<?php if ($was_locked): ?>
						@if($editable)
							{!! csrf_field() !!}
						@endif
						
						@if($editable)
						<input type="hidden" name="project_id" id="id" value="{{ $project->id }}" />
						<input type="hidden" name="project_section_id" id="project_section_id" value="{{ $section->id }}" />
						<input type="hidden" name="was_autosave" id="was_autosave" value="0" />
						@endif
					<?php endif; ?>
					
					<div class="row">
				        <div class="col-md-8 edit-column">
					        <div class="">
								@if($editable)			
									<?php if ($was_locked): ?>
										<p>
											<span class="pull-left label label-warning" style="font-size: 100%;"><i class="fa fa-unlock" aria-hidden="true"></i> You can edit this page.</span>
											<span class="pull-right label label-info" style="font-size: 100%; display: none;" id="saving"><i class="fa fa-save" aria-hidden="true"></i> Saving section...</span>
										</p>
										<br clear="all" />
									<?php else: ?>
										<p>
											<span class="pull-left label label-warning" style="font-size: 100%;"><i class="fa fa-lock" aria-hidden="true"></i> This page was locked by <?php echo $section->locked_by_user()->name; ?> <?php echo prettyDate($section->locked_at); ?>. <a href="?force_unlock=1">Force unlock.</a></span>
											<span class="pull-right label label-info" style="font-size: 100%; display: none;" id="saving"><i class="fa fa-save" aria-hidden="true"></i> Saving section...</span>
										</p>
										<br clear="all" />
									<?php endif; ?>
								@endif
								
								<?php /*				        
						        <div class="panel panel-default">
									<div class="panel-heading">
										Component Name:
										<!--<span class="label pull-right label-info">Good Text Length</span>-->
									</div>
									<div class="panel-body form-element">
										<input type="text" class="large" name="title" value="{{ $section->title }}" <?php if (!$was_locked) { echo 'readonly'; } ?>>
									</div>
								</div>
								*/ ?>
								
								
								<div class="panel panel-default">
									<div class="panel-heading">
										
			Component Name:
			{{-- DELETE --}}
			@if($editable)
			<?php if($section->audio_title!=''){ ?>			
				<span class="pull-right" style="padding-right: 5px;">
					<a class="btn btn-sm btn-primary label-danger removeAudio" style="position: relative; top: -5px;" href="{{url('account/project/edit/audio/delete/'.$project->id.'/'.$section->id.'/audio_title')}}">
				        <span class="fa fa-times"></span>
			        </a>
				</span>
		    <?php } ?>
		    @endif
			
			{{-- UPLOAD --}}
			@if($editable)
			<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;">
				<a style="position: relative; top: -5px;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadTitle">
					<span id="microphone-icon" class="fa fa-upload"></span>
				</a>
			</span>
			@endif
			
			{{-- DOWNLOAD --}}
			@if($editable)
			<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;">
				<?php if($section->audio_title!=''){ ?>			
					<a class="btn btn-sm btn-primary" style="position: relative; top: -5px;" href="{{url('audio/'.$section->audio_title)}}">
						<span id="download-icon" class="fa fa-download"></span>
					</a>
			    <?php } else { ?>
					<a class="btn btn-sm btn-primary download-title" style="position: relative; top: -5px;">
						<span id="download-icon" class="fa fa-download"></span>
					</a>
				<?php } ?>
			</span>
			@endif

			{{-- EAR --}}
			<span class="pull-right" style="padding-right: 5px;">
				<?php if($section->audio_title!=''){ ?>
				    <span class="btn btn-sm btn-primary toggle-phonetic" rel="title" style="position: relative; top: -5px;" data-toggle="tooltip" data-placement="left" data-title="Edit phonetics">
				        <span class="fal fa-assistive-listening-systems"></span>
			        </span>
			    <?php } else { ?>
					<span class="btn btn-sm btn-primary toggle-phonetic" rel="title" style="position: relative; top: -5px;" data-toggle="tooltip" data-placement="left" data-title="Edit phonetics">
						<span class="fa fa-assistive-listening-systems"></span>
					</span>
				<?php } ?>
			</span>
			
			{{-- PLAY --}}
			<span class="pull-right" style="padding-right: 5px;">
				<?php if($section->audio_title!=''){ ?>
				    <a href="{{url('audio/'.$section->audio_title)}}" class="btn btn-sm btn-primary playAudio" rel="title" style="position: relative; top: -5px;">
				        <span id="player-icon" class="fa fa-play"></span>
			        </a>
			    <?php } else { ?>
					<a class="btn btn-sm btn-primary play-audio" rel="title" style="position: relative; top: -5px;">
						<span id="player-icon" class="fa fa-play"></span>
					</a>
				<?php } ?>
			</span>

			<br/>
			<input type="text" id="title" class="large" name="title" value="{{ $section->title }}" style="color:#000; width:100%; padding:0 5px" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>
			
	
									</div>
									<div class="panel-body form-element">
										<div class="audio-player play-title">
											<audio id="play-title" controls></audio>
										</div>
									</div>
								</div>
	
								
                                <div class="panel panel-default" id="phonetic_name" style="<?php if ($section->phonetic_title == '') { echo 'display: none !important;'; } ?>">
									<div class="panel-heading">
										Phonetic Component Name: 
										<span class="pull-right"><a class="btn btn-sm btn-primary play-audio" rel="phonetic_title" style="position: relative; top: -5px;"><span id="player-icon" class="fa fa-play"></span></a></span>
										@if($editable)<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;"><a class="btn btn-sm btn-primary download-phonetic_title" style="position: relative; top: -5px;"><span id="download-icon" class="fa fa-download"></span></a></span>@endif
										<br /><input type="text" id="phonetic_title" class="large" name="phonetic_title" value="{{ $section->phonetic_title }}" style="color:#000; width:100%; padding:0 5px" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>
									</div>
									<div class="panel-body form-element">
										<div class="audio-player play-phonetic_title">
											<audio id="play-phonetic_title" controls></audio>
										</div>
									</div>
								</div>


							@if($editable)
                            @if($section->image_url)
							<div class="panel panel-default">
								<div class="panel-heading">Component Photo:</div>
								<div class="panel-body">
									<p>@if ($section->image_url)Replace the @else Upload a @endif photo for this project section.</p>
	                                <?php if ($was_locked): ?><p><input type="file" id="section_image" name="section_image"></p><?php endif; ?>
	                                @if ($section->image_url)
	                                    <div>
	                                        <img id="section-photo" src="{{ $section->image_url }}?ts=<?php echo time(); ?>" style="width: 100%;" class="thumbnail" />
	                                    </div>
	                                    <!-- Button trigger modal -->
										<?php if ($was_locked || true): ?>
											<p>
                                            <a class="has-image-rights btn btn-lg @if ($section->has_image_rights) btn-success @else btn-default @endif btn-icon" style="width: 100%"><span class="fa @if ($section->has_image_rights) fa-check-square-o @else fa-square-o @endif"></span> <span style="border-right: 0;" class="image-rights-text">@if ($section->has_image_rights) Image Rights Cleared @else NOT CLEARED - IMAGE RIGHTS (WILL NOT DISPLAY) @endif</span></a>
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
										<?php endif; ?>
	                                @endif
                                    <!--<button class="btn btn-lg btn-primary btn-icon save-details" style="width: 100%;"><span class="fa fa-floppy-o"></span> Upload &amp; Save</button>-->
								</div>
							</div>
                            @endif
							@endif
	
								
								<div class="panel panel-default">
									<div class="panel-heading">
										
										
												
										
										
	Component Description:
	
	{{-- DELETE --}}
	@if($editable)
	<?php if($section->audio_description!=''){ ?>			
		<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;">
			<a class="btn btn-sm btn-primary label-danger removeAudio" style="position: relative; top: -5px;" href="{{url('account/project/edit/audio/delete/'.$project->id.'/'.$section->id.'/audio_description')}}">
		        <span class="fa fa-times"></span>
	        </a>
		</span>
	<?php } ?>
	@endif
	
	{{-- UPLOAD --}}
	@if($editable)
	<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;">
		<a style="position: relative; top: -5px;" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#uploadDescription">
			<span id="microphone-icon" class="fa fa-upload"></span>
		</a>
	</span>
	@endif
	
	{{-- DOWNLOAD --}}
	@if($editable)
	<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;">
		<?php if($section->audio_description!=''){ ?>			
			<a class="btn btn-sm btn-primary" style="position: relative; top: -5px;" href="{{url('audio/'.$section->audio_description)}}">
				<span id="download-icon" class="fa fa-download"></span>
			</a>
	    <?php } else { ?>
			<a class="btn btn-sm btn-primary download-description" style="position: relative; top: -5px;">
				<span id="download-icon" class="fa fa-download"></span>
			</a>
		<?php } ?>
	</span>
	@endif
			{{-- EAR --}}
			<span class="pull-right" style="padding-right: 5px;">
				<?php if($section->audio_description!=''){ ?>
				    <span class="btn btn-sm btn-primary toggle-phonetic-description" rel="description" style="position: relative; top: -5px;" data-toggle="tooltip" data-placement="left" data-description="Edit phonetics">
				        <span class="fal fa-assistive-listening-systems"></span>
			        </span>
			    <?php } else { ?>
					<span class="btn btn-sm btn-primary toggle-phonetic-description" rel="description" style="position: relative; top: -5px;" data-toggle="tooltip" data-placement="left" data-description="Edit phonetics">
						<span class="fa fa-assistive-listening-systems"></span>
					</span>
				<?php } ?>
			</span>
	
	{{-- PLAY --}}
	<span class="pull-right" style="padding-right: 5px;">
		<?php if($section->audio_description!=''){ ?>
		    <a href="{{url('audio/'.$section->audio_description)}}" class="btn btn-sm btn-primary playAudio" rel="description" style="position: relative; top: -5px;">
		        <span id="player-icon" class="fa fa-play"></span>
	        </a>
	    <?php } else { ?>
			<a class="btn btn-sm btn-primary play-audio" rel="description" style="position: relative; top: -5px;">
				<span id="player-icon" class="fa fa-play"></span>
			</a>
		<?php } ?>
	</span>
			
	
									</div>
									<div class="panel-body form-element" id="description_container">
										<div class="audio-player play-description play_description">
											<audio id="play-description" controls></audio>
										</div>
										<textarea class="tall rte" name="description" id="description" placeholder="<?php echo get_placeholder_text($section->description); ?>" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>{{ $section->description }}</textarea>
									</div>
								</div>
							
							@if($editable)
                            @if(!$section->image_url)
							<div class="panel panel-default">
								<div class="panel-heading">Component Photo:</div>
								<div class="panel-body">
									<p>@if ($section->image_url)Replace the @else Upload a @endif photo for this project section.</p>
	                                <?php if ($was_locked): ?><p><input type="file" id="section_image" name="section_image"></p><?php endif; ?>
	                                @if ($section->image_url)
	                                    <div>
	                                        <img id="section-photo" src="{{ $section->image_url }}?ts=<?php echo time(); ?>" style="width: 100%;" class="thumbnail" />
	                                    </div>
	                                    <!-- Button trigger modal -->
										<?php if ($was_locked || true): ?>
											<p>
												<a class="has-image-rights btn btn-lg @if ($section->has_image_rights) btn-success @else btn-default @endif btn-icon" style="width: 100%"><span class="fa @if ($section->has_image_rights) fa-check-square-o @else fa-square-o @endif"></span> <span style="border-right: 0;" class="image-rights-text">@if ($section->has_image_rights) Image Rights Cleared @else NOT CLEARED - IMAGE RIGHTS (WILL NOT DISPLAY) @endif</span></a>
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
										<?php endif; ?>
	                                @endif
                                    <!--<button class="save-details btn btn-lg btn-primary btn-icon" style="width: 100%;"><span class="fa fa-floppy-o"></span> Upload &amp; Save</button>-->
								</div>
							</div>
                            @endif
							@endif
					        						
                                <div class="panel panel-default" id="phonetic_description_box" <?php if ($section->phonetic_description == '') { echo 'style="display: none !important;"'; } ?>>
									<div class="panel-heading">
										Phonetic Component Description:<br /><small>if you fill this field out, this text will be used in the text to speech audio instead of the description above. You might want to use this if the text to speech software isn't properly pronouncing your text.</small><br /><br />&nbsp;
																			
																			
										{{-- PLAY --}}
										<span class="pull-right" style="padding-right: 5px;">
											<a class="btn btn-sm btn-primary play-audio" rel="phonetic_description" style="position: relative; top: -5px;">
												<span id="player-icon" class="fa fa-play"></span>
											</a>
										</span>
										
										{{-- DOWNLOAD --}}
										@if($editable)
										<span class="pull-right hidden-xs hidden-sm" style="padding-right: 5px;">
											<?php if($section->phonetic_description!=''){ ?>			
												<a class="btn btn-sm btn-primary" style="position: relative; top: -5px;" href="{{url('audio/'.$section->phonetic_description)}}">
													<span id="download-icon" class="fa fa-download"></span>
												</a>
										    <?php } else { ?>
												<a class="btn btn-sm btn-primary download-phonetic_description" style="position: relative; top: -5px;">
													<span id="download-icon" class="fa fa-download"></span>
												</a>
											<?php } ?>
										</span>
										@endif
										
										
									</div>
									<div class="panel-body form-element" id="phonetic_description_container">
										<div class="audio-player play-phonetic_description play_phonetic_description">
											<audio id="play-phonetic_description" controls></audio>
										</div>
										<textarea class="tall rte" name="phonetic_description" id="phonetic_description" placeholder="<?php echo get_placeholder_text($section->phonetic_description); ?>" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>{{ $section->phonetic_description }}</textarea>
									</div>
								</div>
										
										


<div class="row">
	    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 57px;">
                        Geolocation Tag @if($editable)<span class="pull-right" style="padding-right: 5px;"><a class="btn btn-sm btn-primary" style="position: relative; top: -5px;" onclick="FillOutCoords()"><span id="location-arrow" class="fa fa-map-marker" style="font-size: 2em;" title="Click or tap to grab your current GPS coordinates"></span></a></span>@endif

                    </div>
                </div>
        </div>
</div>
<div class="row">
	    <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Latitude:
                        <input type="text" id="latitude" class="large" name="latitude" value="{{ $section->latitude }}" style="color:#000; width:100%; padding:0 5px" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Longitude:
                        <input type="text" id="longitude" class="large" name="longitude" value="{{ $section->longitude }}" style="color:#000; width:100%; padding:0 5px" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Radius (in meters, 1 to 10,000)
                        <input type="text" id="gps_range" class="large" name="gps_range" <?php if (!strlen($section->gps_range) || $section->gps_range == 10): ?>placeholder<?php else: ?>value<?php endif; ?>="{{ $section->gps_range }}" style="color:#000; width:100%; padding:0 5px" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>

                    </div>
                </div>


        </div>
	    <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        GPS Coordinate &amp; Radius
                    </div>
                    <p>GPS coordinates are used in UniD apps to create a locational trigger for users, in which a device (with the app open and permissions allowed) will vibrate and present particular content in a particular place, within the radius selected.</p>
                    <p>Designers can either input the coordinates remotely or go to the place, open the UniD design tool on a smartphone or tablet, and select the geolocation button, which will grab the current coordinates and link those to the UniD component.</p>
                </div>

        </div>
</div>
					        						
								<div class="panel panel-default">
									<div class="panel-heading">
										Component Notes:<br /><small>internal use only</small>
									</div>
									<div class="panel-body form-element">
										<textarea class="tall rte" name="notes" <?php if (!$was_locked OR !$editable) { echo 'disabled'; } ?>>{{ $section->notes }}</textarea>
									</div>
								</div>


					        						
								<?php if ($was_locked): ?>
									<div class="wrapper-footer">
										<!--<button id="save-page" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-floppy-o"></span> Save &amp; Return</button>-->
										<a class="page-complete check-complete btn btn-lg @if ($section->completed) btn-success @else btn-red @endif btn-icon" style="width: 100%;"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span> <span class="component-complete-text" style="border: 0;">@if ($section->completed) Component Complete @else Component Incomplete @endif</span></a>
									</div>
								<?php endif; ?>
					        </div>				        
				        </div>
				        <div class="col-md-4 tips-column">
					        
					        <!--
		                	<div class="help">
					        	<span class="fa fa-question-circle"></span>
					        	<p>Need to learn more about best practices for audio descriptions? <a href="/unid-academy">Read our guide</a> for more details!</p>
				        	</div>
				        	-->
							<div class="panel panel-default">
								<div class="panel-heading">Component Navigation:</div>
								<div class="panel-body">
									<?php $f = FALSE;?>
	                                <div class="col-sm-6 truncate" style="text-align: left;">
	                                    @if ($prev_ps)
	                                    	<?php $f = TRUE;?>
	                                        <a href="/account/project/section/{{ $project->id }}/{{ $prev_ps->id }}">&larr; Previous<br /><small>{{ $prev_ps->title }}</small></a>
	                                    @endif
	                                </div>
	                                <div class="col-sm-6 truncate" style="text-align: right;">
	                                    @if ($next_ps)
	                                    	<?php $f = TRUE;?>
	                                        <a href="/account/project/section/{{ $project->id }}/{{ $next_ps->id }}">Next &rarr;<br /><small>{{ $next_ps->title }}</small></a>
	                                    @endif
	                                </div>
	                                <?php if(!$f){ ?>
		                                <div class="col-sm-12" style="text-align: center;">
			                                <a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Please save the TOC ordering to enable this feature</a>
		                                </div>
		                            <?php } ?>
	                            </div>
	                        </div>
	    				      	
	    				    @if($editable)
							<?php if ($was_locked): ?>
								<div class="panel panel-default">
									<div class="panel-heading">Save &amp; Complete:</div>
									<div class="panel-body">
										<p><button class="btn btn-lg btn-primary btn-icon save-details" style="width: 100%;"><span class="fa fa-floppy-o"></span> Save &amp; Return</button></p>
										<p><a class="page-complete check-complete btn btn-lg @if ($section->completed) btn-success @else btn-red @endif btn-icon" style="width: 100%;"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span> <span class="component-complete-text" style="border: 0;">@if ($section->complete) Component Complete @else Component Incomplete @endif</span> </a></p>
									</div>
								</div>
							<?php endif; ?>
							@endif
							
	                        @include('project.todo.main')
	                        
	                        @if($editable)
<!--
							<div class="panel panel-default">
								<div class="panel-heading">Audio Recorder:</div>
								<div class="panel-body">
	                                <div class="col-sm-12 truncate" style="padding:0; text-align: left;">
	
										<p>
											<div id="audio_record" class="btn btn-primary" onclick="$('#audio_stop').toggle(); $('#audio_record').toggle(); changeVolume({{config('app.mic_volume')}}); startRecording(this);">Record / Upload</div>
											<div style="display: none;" id="audio_stop" class="btn btn-warning" onclick="$('#audio_stop').toggle(); $('#audio_record').toggle(); changeVolume(0); stopRecording(this);" disabled>Stop</div>
											<div style="inline-block; display:none" id="recording_light"><i class="fa fa-circle text-danger blink"></i>&nbsp; RECORDING</div>
										</p>
										
										<table id="recordingslist"></table>
										
	                                </div>
	                            </div>
	                        </div>
-->
	                        @endif
	
							@include('project.shared.section_version')
	
				        </div>
					</div>
					<!-- /.row -->
							        
				    <div class="row creator">
				        
				       
				    </div>
				    
				</form>
		    </div>
		</div>
	</div>
</div>

@endsection

@section('js')

<script type="text/javascript">

$(document).ready(function() {
    $(window).keydown(function(event){
        console.log(  );
        if(event.keyCode == 13  && !$($(event.target)[0]).hasClass('trumbowyg-editor')) {
            event.preventDefault();
            return false;
        }
    });
});
	var audio;
	
	function stopPlayers(){
		var sounds = document.getElementsByTagName('audio');
		for(i=0; i<sounds.length; i++) sounds[i].pause();
	}
	
	$('body').on('click', '.saveAudio', function (e){
		e.preventDefault();
		var t = $(this).attr('rel');
		var link = $(this).attr('download');

		var data = new FormData();			
		data.append('t', t);
		data.append('link', link);
		data.append('_token', '{{csrf_token()}}');
		
		$.ajax({
			url: "{{url('account/project/edit/audio/save/'.$project->id.'/'.$section->id)}}",
			data: data,
			dataType:"json",
			async:true,
			type:"post",
			enctype: "multipart/form-data",
			processData: false,
			contentType: false,
			success:function(response){
				if(response.status == "success"){
					alert("Updated");
					setTimeout(function() { window.location=window.location;},0);
				}
				if(response.status == "error"){
					alert(response.message);
				}
			},
			error:function(response){
				console.log("error: "+response.statusText);
			}
		});
		
    });	

    function FillOutCoords() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                 var latitude  = position.coords.latitude;
                 var longitude = position.coords.longitude;

                 $('#latitude').val( latitude );
                 $('#longitude').val( longitude );
            });
        } else {
              /* geolocation IS NOT available */
            alert('Couldn\'t access GPS coordinates');
        }
    }
	
	$(document).ready(function() {

          $('[data-toggle="tooltip"]').tooltip()


		$('.popup').magnificPopup({
			type: 'ajax',
			modal: true,
			overflowY: 'scroll',
			closeBtnInside: true
		});

	
		$(".removeAudio").click(function(e){
			e.preventDefault();
			$.ajax({
				url: $(this).attr('href'),
				data:'',
				dataType:"json",
				async:true,
				type:"get",
				processData: false,
				contentType: false,
				beforeSend: function() {
	               console.log('deleting');
	            },
				success:function(response){
					if(response.status == 'success'){
						alert('Deleted!');
						setTimeout(function() { window.location=window.location;},0);
					}
					if(response.status == 'error'){
						alert(response.message);
					}
				},
				error:function(response){
					console.log('error: '+response.statusText);
				}
			});
		});

        $("#section_form").data("changed",false);
        $("#section_form :input").change(function() {
               $("#section_form").data("changed",true);
        });

        $(window).on('beforeunload', function(){
            $("#was_autosave").val(0);
            if ($("#section_form").data("changed")) {
                $('.modal-title').html('Please wait');
                $('.modal-body').html('Saving component...');
                $('.modal-footer').html('');
                $('#deleteModal').modal({show: true});
                $("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', async: false});
            }
            else {
                $('#unlock_form').ajaxSubmit({url: '/account/project/unlock', type: 'get', async: false});
            }
        });
		
        $('textarea.rte').trumbowyg({
		    removeformatPasted: true,
                autogrow: true,
                svgPath: '/js/ui/icons.svg'
		}).on('tbwchange', function() {
            $('#section_form').data('changed', true);
			if (($('.trumbowyg-editor').text().length - orig_count > 15) || orig_count - $('.trumbowyg-editor').text().length > 15) {
				// Reset the count, so we save again in another 15 characters
				console.log('submitting');
				orig_count = $('.trumbowyg-editor').text().length;
				$('#was_autosave').val("1");
				$('#saving').show();
				$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', success: function() { $('#saving').hide(); console.log('submitted it'); }});
			}
		});
		
		var orig_count = $('.trumbowyg-editor').text().length;
		
        //$(":file").filestyle({buttonBefore: true, placeHolder: 'Component Photo', buttonText: '&nbsp;Component Photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});
        //$(":file").filestyle({icon: false, buttonText: "Component Photo", buttonName: "btn-primary"});
		
		$( ".microphone-control" ).click(function() {
			var mct = $(this).attr("rel");
			console.log(mct);
			if(mct=="audio_description"){
				$("#description_container").toggle();
			}
			$( ".play_"+mct ).toggle();
		});
				
		$('.play-audio').on('click', function(event) {
			var this_section = $(this).attr('rel');
			stopPlayers();
			
			$.each($('aaudio'), function () {
			    this.pause();
			    $('.fa-stop').removeClass('fa-stop').addClass('fa-play');
			    $('.audio-player').hide();
			});
			
			// define the audio element
			var audio = $('#play-'+this_section);
			
			if ($(this).find('#player-icon').hasClass('fa-play')) {
				$(this).find('#player-icon').removeClass('fa-play');
				$(this).find('#player-icon').addClass('fa-stop');
                console.log(this_section);
                var use_library = true;
                if (this_section.includes('phonetic')) {
                    use_library = false;
                }
				var request = $.ajax({
					url: "https://api.montanab.com/tts/tts.php",
					method: "POST",
					data: { t : $('#'+this_section).val().replace(/(<([^>]+)>)/ig,"\n").replace(/&#?[a-z0-9]{2,8};/ig, ''), use_library : use_library },
					dataType: "json"
				});
				
				request.done(function( msg ) {
					console.log(msg.fn);
					
					audio.attr('src', msg.fn);
					audio.attr('autoplay', 'autoplay');
					audio.load();
					
					$('.audio-player.play-'+this_section).show();
					document.getElementById('play-'+this_section).addEventListener('load', function() {
						document.getElementById('play-'+this_section).play();
					}, true);
					
					document.getElementById('play-'+this_section).addEventListener('ended', function() {
						$('.fa-stop').removeClass('fa-stop').addClass('fa-play');
						$('.audio-player.play-'+this_section).hide();
					});
					
				});
				 
				request.fail(function( jqXHR, textStatus ) {
				  alert( "Request failed: " + textStatus );
				});
			}
			else {
				
				$(this).find('#player-icon').removeClass('fa-stop');
				$(this).find('#player-icon').addClass('fa-play');
				$('.audio-player.play-'+this_section).hide();
				
				document.getElementById('play-'+this_section).pause();
				document.getElementById('play-'+this_section).currentTime = 0;
			}
		});
		
		
		
		
		$('.playAudio').on('click', function(event) {
			event.preventDefault();
			var this_link = $(this).attr('href');
			var this_section = $(this).attr('rel');
			stopPlayers();
			
			// define the audio element
			var audio = $("#play-"+this_section);
			audio.attr('src', this_link);
			audio.attr('autoplay', 'autoplay');
			audio.load();
			
			$('.audio-player.play-'+this_section).show();
			document.getElementById('play-'+this_section).addEventListener('load', function() {
				document.getElementById('play-'+this_section).play();
			}, true);
			
			document.getElementById('play-'+this_section).addEventListener('ended', function() {
				$('.fa-stop').removeClass('fa-stop').addClass('fa-play');
				$('.audio-player.play-'+this_section).hide();
			});
		});
		
		@if($editable)
		$('.download-title').on('click', function(event) {
            $('#showLoading').modal("show")
			var request = $.ajax({
			  url: "https://api.montanab.com/tts/tts.php",
			  method: "POST",
			  data: { t : $('#title').val().replace(/(<([^>]+)>)/ig,"\n") },
			  dataType: "json"
			});
			request.done(function( msg ) {
				window.open(msg.fn, 'Download');
                $('#showLoading').modal("hide")
			});
		});		
		
		$('.download-phonetic_title').on('click', function(event) {
            $('#showLoading').modal("show")
			var request = $.ajax({
			  url: "https://api.montanab.com/tts/tts.php",
			  method: "POST",
			  data: { t : $('#phonetic_title').val().replace(/(<([^>]+)>)/ig,"\n"), use_library : false },
			  dataType: "json"
			});
			request.done(function( msg ) {
				window.open(msg.fn, 'Download');
                $('#showLoading').modal("hide")
			});
		});		
		
		$('.download-description').on('click', function(event) {
            $('#showLoading').modal("show")
			var request = $.ajax({
			  url: "https://api.montanab.com/tts/tts.php",
			  method: "POST",
			  data: { t : $('#description').val().replace(/(<([^>]+)>)/ig,"\n") },
			  dataType: "json"
			});
			request.done(function( msg ) {
				window.open(msg.fn, 'Download');
                $('#showLoading').modal("hide")
			});
		});		
		
		$('.download-phonetic_description').on('click', function(event) {
            $('#showLoading').modal("show")
			var request = $.ajax({
			  url: "https://api.montanab.com/tts/tts.php",
			  method: "POST",
			  data: { t : $('#phonetic_description').val().replace(/(<([^>]+)>)/ig,"\n"), use_library : false },
			  dataType: "json"
			});
			request.done(function( msg ) {
				window.open(msg.fn, 'Download');
                $('#showLoading').modal("hide")
			});
		});		
	
		$('.has-image-rights').on('click', function(event) {
			//console.log( $(this).data() );
			//console.log( $(this) );
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
					    //console.log('the data');
					    //console.log(data);
				        if (data.status == 'success') {
					        $(section).children().removeClass("fa-spinner fa-spin");
					        $(section).removeClass('btn-default');
							$(section).addClass('btn-success');
							$(section).children().addClass('fa-check-square-o');
                            $('.image-rights-text').html('Image Rights Cleared');
	
				        }
				        else {
					        alert('Error: contact the site admin.');
				        }
						
						//$('#was_autosave').val("1");
        				//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', success: function() { console.log('submitted it'); }});

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
					    //console.log('the data');
					    //console.log(data);
				        if (data.status == 'success') {
					        $(section).children().removeClass("fa-spinner fa-spin");
					        $(section).removeClass('btn-success');
							$(section).addClass('btn-default');
							$(section).children().addClass('fa-square-o');
                            $('.image-rights-text').html('NOT CLEARED - IMAGE RIGHTS (WILL NOT DISPLAY)');
	
				        }
				        else {
					        alert('Error: contact the site admin');
				        }
				        
						//$('#was_autosave').val("1");
        				//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', success: function() { console.log('submitted it'); }});

				    }
				});
				// Set it not completed
			}
			
			//<span data-section_id="{{ $section->id }}" class="check-complete label pull-right label-default"><span class="fa fa-square-o"></span></span>
		});
		
	  	$('.check-complete').on('click', function(event) {
			//console.log( $(this).data() );
			//console.log( $(this) );
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
							$(section).removeClass('btn-red');
							$(section).addClass('btn-success');
							$(section).children().addClass('fa-check-square-o');
                            $('.component-complete-text').html('Component Complete');	
				        }
				        else {
					        alert('Error: contact the site admin.');
				        }
						//$('#was_autosave').val("1");
        				//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', success: function() { console.log('submitted it'); }});

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
							$(section).addClass('btn-red');
							$(section).children().addClass('fa-square-o');
                            $('.component-complete-text').html('Component Incomplete');	
	
				        }
				        else {
					        alert('Error: contact the site admin');
				        }
						//$('#was_autosave').val("1");
        				//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', success: function() { console.log('submitted it'); }});

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
                    //d = new Date();
                    //$('#section-photo').attr('src', response.file + "?" + d.getTime());
				    location.reload();	
					//$('#was_autosave').val("1");
    				//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post', success: function() { console.log('submitted it'); }});

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
                    location.reload();
                    //$('#deleteModalClose').click();
                    //$('#save-page').click();
                    //$('#was_autosave').val(0);
    				//$("#section_form").ajaxSubmit({url: '/account/project/section', type: 'post'});

                }
            });
        });
        
        $('#section_image').change(function(){
            $('.modal-title').html('Please wait');
            $('.modal-body').html('Uploading data...&nbsp;&nbsp;&nbsp;<img src="/images/ajax-loader.gif" style="border: 0;">');
            $('.modal-footer').html('');
            $('#deleteModal').modal({show: true});
            setTimeout(function() { $("#section_form").submit(); }, 500);
        });

        $('.save-details').on('change', function() {
            $('.modal-title').html('Please wait');
            $('.modal-body').html('Uploading data...&nbsp;&nbsp;&nbsp;<img src="/images/ajax-loader.gif" style="border: 0;">');
            $('.modal-footer').html('');
            $('#deleteModal').modal({show: true});
            setTimeout(function() { $("#project_details_form").submit(); }, 500);
        });

        /*
        $('#section_image').change(function(){
	       // When a file is chosen, auto-submit and refresh.
	       $('#section_form').submit();
	        
        });
         */
        
        
        	$("#uploadAudioTitle").click(function(e){
				e.preventDefault();
				
				var formData = new FormData($("#upload_audio_title")[0]);
				$.ajax({
					url:"{{url('account/project/edit/audio/add/'.$project->id.'/'.$section->id.'/audio_title')}}",
					data:formData,
					dataType:"json",
					async:true,
					type:"post",
					processData: false,
					contentType: false,
					beforeSend: function() {
		               console.log('about to send: {{$section->audio_title}}');
		            },
					success:function(response){
						if(response.status == 'success'){
							$("button.mfp-close").css("background-color", "yellow");
							$("#upload_audio_title").html(response.message);
						}
						if(response.status == 'deleted'){
							$("#upload_audio_title").html(response.message);
							alert(response.message);
						}
						if(response.status == 'error'){
							alert(response.message);
						}
					},
					error:function(response){
						console.log('error: '+response.statusText);
					}
				});
			});
			
			
        	$("#uploadAudioDescription").click(function(e){
				e.preventDefault();
				
				var formData = new FormData($("#upload_audio_description")[0]);
				$.ajax({
					url:"{{url('account/project/edit/audio/add/'.$project->id.'/'.$section->id.'/audio_description')}}",
					data:formData,
					dataType:"json",
					async:true,
					type:"post",
					processData: false,
					contentType: false,
					beforeSend: function() {
		               console.log('about to send: {{$section->audio_description}}');
		            },
					success:function(response){
						if(response.status == 'success'){
							$("button.mfp-close").css("background-color", "yellow");
							$("#upload_audio_description").html(response.message);
						}
						if(response.status == 'deleted'){
							$("#upload_audio_description").html(response.message);
							alert(response.message);
						}
						if(response.status == 'error'){
							alert(response.message);
						}
					},
					error:function(response){
						console.log('error: '+response.statusText);
					}
				});
			});
		@endif	
			
	});
	
	
	
		$(window).bind("load", function () {
		<?php 
			if($section->audio_title!=''){
				?> $(".microphone-control[rel='audio_title'] #microphone-icon").click(); <?php
			}	
			if($section->audio_description!=''){
				?> $(".microphone-control[rel='audio_description'] #microphone-icon").click(); <?php
			}	
		?>
		});

        $('.toggle-phonetic').click(function() {
            $('#phonetic_name').show();
            if ($('input', $('#phonetic_name')).val() == '') {
                $('input', $('#phonetic_name')).val( $('#title').val() );
            }
        });
		
        $('.toggle-phonetic-description').click(function() {
            $('#phonetic_description_box').show();
            if ($('#phonetic_description').val() == '') {
                $('#phonetic_description').trumbowyg('html',$('#description').val());
            }
        });
		
		

</script>

<!-- Modal -->
<div class="modal fade" id="uploadTitle" tabindex="-1" role="dialog" aria-labelledby="myModalUploadTitle">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalUploadTitle">Upload Audio Title</h4>
      </div>
      <div class="modal-body col-md-12">
                
		    <h3>Upload your audio file to the title field: <?php echo ucwords(preg_replace("/_/", " ", $section->title));?></h3>
		    
		    <form enctype="multipart/form-data" id="upload_audio_title" role="form" method="POST">
				<div class="form-group">
					<input type="file" id="audio" name="audio" accept=".wav" style="text-align: center;display: block;margin: 15px auto;padding: 5px 20px;border: 1px dotted #999;">
					<p class="">Upload your audio title file. Only .wav format is accepted</p>
				</div>
				<input type="hidden" name="type" value="audio_title">
				<input type="hidden" name="_token" value="{{ csrf_token()}}">
				<div><button id="uploadAudioTitle" value="Submit">SUBMIT</button></div>
			</form>
			
      </div>
      <div class="modal-footer">
        <button id="modalClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--       result = $image.cropper(data.method, data.option, data.secondOption);-->
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="showLoading" tabindex="-1" role="dialog" aria-labelledby="myModalUploadDescription">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalUploadDescription">Creating audio file...</h4>
      </div>
      <div class="modal-body col-md-12">
            <p>Loading...</p>     
      </div>
      <div class="modal-footer">
        <button id="modalClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--       result = $image.cropper(data.method, data.option, data.secondOption);-->
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadDescription" tabindex="-1" role="dialog" aria-labelledby="myModalUploadDescription">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalUploadDescription">Upload Audio Description</h4>
      </div>
      <div class="modal-body col-md-12">
                
		    <h3>Upload your audio file to the description field: <?php echo ucwords(preg_replace("/_/", " ", $section->description));?></h3>
		    
		    <form enctype="multipart/form-data" id="upload_audio_description" role="form" method="POST">
				<div class="form-group">
					<input type="file" id="audio" name="audio" accept=".wav" style="text-align: center;display: block;margin: 15px auto;padding: 5px 20px;border: 1px dotted #999;">
					<p class="">Upload your audio description file. Only .wav format is accepted</p>
				</div>
				<input type="hidden" name="type" value="audio_description">
				<input type="hidden" name="_token" value="{{ csrf_token()}}">
				<div><button id="uploadAudioDescription" value="Submit">SUBMIT</button></div>
			</form>
			
      </div>
      <div class="modal-footer">
        <button id="modalClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!--       result = $image.cropper(data.method, data.option, data.secondOption);-->
      </div>
    </div>
  </div>
</div>


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

<form method="POST" action="/account/project/unlock" enctype="multipart/form-data" id="unlock_form" style="display: none;">
<input type="hidden" name="project_section_id" id="project_section_id" value="{{ $section->id }}" />
</form>

@endsection
