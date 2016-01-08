@extends('layouts.app')

@section('header')

@endsection

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
	            @if ($project->id)
            		{{ $project->title }}
            	@else
            		Create New Project
            	@endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/account">Account</a></li>
            <li><a href="/account/project">My Projects</a></li>
            <li class="active">
            	@if ($project->id)
            		{{ $project->title }}
            	@else
            		Create New Project
            	@endif
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row project">
    <div class="col-lg-12">
		<form method="POST" action="/account/project/edit" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<input type="hidden" name="id" id="id" value="{{ $project->id }}" />
			<div class="row">
				<div class="col-md-12">
					<h4>UniDescription Creator</h4>
					<p>
						Need to learn more about best practices for audio descriptions? <a href="/guide" target="_blank">Read our guide</a> for more details!
					</p>
					<p>
						Fill out as many fields on the form below to make your UniDescription app as complete as possible. 
					</p>
				</div>
			</div>
			<!-- /.row -->
			
			<div class="row">
		        <div class="col-md-8">
		    		<h3>Table of Contents - Full Template</h3>
		            <ul class="list-group well">
					<?php foreach ($sections as $section): ?>
			            <li class="list-group-item">
			                <span class="label label-default pull-right section-{{ $section->id }}-label">Not Started</span>
			                @if (count($section->children))
			                	<span class="glyphicon glyphicon-chevron-right toc-arrow" data-toggle="collapse" data-target="#collapse-{{ $section->id }}" aria-expanded="false" aria-controls="collapse-{{ $section->id }}"></span>
			                @endif
			                
			                <a href="#section-{{ $section->id }}">{{ $section->title }}</a>
			                
			                @if (count($section->children))
			                	<div class="collapse" id="collapse-{{ $section->id }}">
							      	<ul class="list-group" style="margin-top: 5px; margin-left: 18px">
									  	@foreach ($section->children as $child)
								    		<li class="list-group-item">
			    				                <span class="label label-default pull-right section-{{ $child->id }}-label">Not Started</span>
								    	  		<a href="#section-{{ $child->id }}">{{ $child->title }}</a>
										  	</li>
										@endforeach
								  	</ul>
								</div>
			                @endif
			            </li>
					<?php endforeach; ?>
		            </ul>
		        </div>
		        <div class="col-md-4">
			        <div class="panel panel-default">
						<div class="panel-heading"><h3 class="panel-title">Project Details</h3></div>
						<div class="panel-body">
						    <input type="text" id="title" name="title" class="form-control" placeholder="Project Title" value="{{ $project->title }}" required />   
						    <textarea id="description" name="description" class="form-control" placeholder="Description" rows="4" required>{{ $project->description }}</textarea>
					        
					        <label for="project_image" style="margin-top: 10px;">Project Image</label>
					        @if ($project->image_url)
					        	<img src="{{ $project->image_url }}" style="width: 100%;" class="thumbnail" />
					        @endif
							<input type="file" id="project_image" name="project_image">
						    
						    <label style="margin-top: 10px;">Project progress</label>
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
									0%
								</div>
							</div>
							
							<button class="btn btn-sm btn-primary btn-block" type="submit"><span class="fa fa-save"></span> Save Project</button>
							@if ($project->id)
								<a href="/account/project/export/{{ $project->id }}" class="btn btn-sm btn-warning btn-block"><span class="fa fa-download"></span> Export Project</a>
							@endif
						</div>
			        </div>
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
		
		        
		    <div class="row creator">
		        
		        <!-- start the paste -->
				<?php 
					foreach ($sections as $section): 
						//$project_section = $project->project_sections->where('section_template_id', $section->id)->first();
						//echo "<PRE>".print_R($project_section,true)."</pre>";
					
				?>
					<div class="row panel" id="section-{{ $section->id }}">
				        <div class="col-md-6">
				            <div class="row">
					            <div class="col-md-12">
					                <h4>
			        				    <label for="section-{{ $section->id }}-title">Title:</label>
			        				    <span class="label pull-right label-default section-{{ $section->id }}-label">Not Started</span><br />
			        				    <input type="text" id="section-{{ $section->id }}-title" name="section-{{ $section->id }}-title" class="form-control" placeholder="{{ $section->title }}" value="{{ $section->title }}" required />   
						            </h4>
					            </div>
				            </div>
				            <div class="form-group">
				            	<label for="section-{{ $section->id }}-description">Description:</label>
								<textarea class="form-control" placeholder="{{ $section->description }}" style="margin: 0px -1px 0px 0px; width: 464px; height: 173px;" name="section-{{ $section->id }}-description" id="section-{{ $section->id }}-description">@if ($project->id){{ $section->description }}@endif</textarea>
				            </div>
				            <!--<a class="btn btn-default" onclick="playId(this, 'section-{{ $section->id }}-description')">
				            	<span class="glyphicon glyphicon-play" aria-hidden="true"></span> Play Audio
				            </a>
				            <a class="btn btn-default" onclick="downloadId(this, 'section-{{ $section->id }}-description')">
				            	<span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download Audio
				            </a>-->
				          
				            @if (count($section->children))
				            	<div style="height: 10px;">&nbsp;</div>
								@foreach ($section->children as $s)
									<input type="hidden" name="section-{{ $s->id }}-parent" value="@if ($project->id){{ $s->project_section_id }}@else{{ $s->section_template_id }}@endif" />
									<div class="form-group well" id="section-{{ $s->id }}">
										<label for="section-{{ $s->id }}-title">Title:</label>
			        				    <span class="label label-default pull-right section-{{ $s->id }}-label">Not Started</span>
			        				    <br />
										<input type="text" id="section-{{ $s->id }}-title" name="section-{{ $s->id }}-title" class="form-control" placeholder="{{ $s->title }}" value="{{ $s->title }}" required />
										
										<label for="section-{{ $s->id }}-description" style="margin-top: 20px;">Description:</label>
										<textarea class="form-control" style="margin-bottom: 10px; height: 123px;" placeholder="{{ $s->description }}" id="section-{{ $s->id }}-description" name="section-{{ $s->id }}-description">@if ($project->id){{ $s->description }}@endif</textarea>
										<!--<a class="btn btn-default" onclick="playId(this, 'section-{{ $s->id }}-description')">
											<span class="glyphicon glyphicon-play" aria-hidden="true"></span>Play Audio
										</a>-->
									</div>
					            @endforeach
					        @endif
				        </div>
				        <div class="col-md-6">
				        	<h3>Standards for {{ $section->title }}</h3>
				            <p>Click on the subjects below to read more about best practices for audio descriptions.</p>
				            <div class="list-group">
					            <a class="list-group-item disabled" data-toggle="modal" data-target="#whatyouseeModal" style="cursor: pointer">Lorem ipsum dolor site amet</a>
					            <a class="list-group-item disabled">site amet consectetur</a>
					            <a class="list-group-item disabled">Ut lobortis lobortis sodales</a>
					            <a class="list-group-item disabled">Donec dictum ipsum</a>
					            <a class="list-group-item disabled">Nullam at neque</a>
				            </div>
				            <a href="/forum" class="btn btn-default">
				            	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								Want to discuss this issue more? Join our forum!
				            </a>
				        </div>
				    </div>
		        <?php 
			        endforeach; 
			    ?>
		        <!-- end the paste -->
		
		    </div>
		    
			<button class="btn btn-lg btn-success btn-block" type="submit"><span class="fa fa-save"></span> Save Project</button>
		</form>
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
		
		var completion = 100 - Math.floor((not_started_count / total_count) * 100);
	    $('.progress-bar').css('width', completion+'%').attr('aria-valuenow', completion);
	    $('.progress-bar').html(completion + '%');
		
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