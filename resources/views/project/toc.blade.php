@extends('layouts.app')

@section('title', $project->title . ' table of contents')

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
						<li class="active"><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Table of Contents</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
    </div>
	
	<div class="row project">
	    <div class="col-lg-12">
			<form method="POST" action="/account/project/toc" enctype="multipart/form-data" id="toc-form">
				{!! csrf_field() !!}
				<input type="hidden" name="id" id="id" value="{{ $project->id }}" />			
				<input type="hidden" name="new_sections" id="new_sections" value="{{ $new_sections }}" />
				<input type="hidden" name="json_toc" id="json_toc" value="" />
				
				<div class="row">
			        <div class="col-md-8 edit-column">
				        <div class="wrapper">
							<!-- table of contents see http://forresst.github.io/2012/06/22/Make-a-list-jQuery-Mobile-sortable-by-drag-and-drop/ -->
							<div class="panel panel-default">
								<div class="panel-heading">Table of Contents:</div>
								<div class="panel-body white unid-list table-of-contents">
									<div data-role="content" data-theme="c">
										
										<ul data-role="listview" data-inset="true" data-theme="d" id="sortable" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded">
											<?php foreach ($sections as $index => $section): ?>
												<li id="item-{{ $index }}" data-title="{{ $section->title }}" data-section-id="{{ $section->id }}" class="li-section mjs-nestedSortable-branch mjs-nestedSortable-expanded @if ($section->deleted) deleted @endif">
													<div>
												        <input type="hidden" id="section-{{ $index }}-title" name="section-{{ $index }}-title" class="form-control" value="{{ $section->title }}" />   
														<input type="hidden" name="sort_order[]" value="{{ $section->id }}" />
														<span class="fa fa-bars" style="cursor: move;"></span>
														<i class="fa fa-chevron-down toggle"></i> <a href="/account/project/section/{{ $project->id }}/{{ $section->id }}">{{ $section->title }}</a> @if ($section->deleted) <span class="label pull-right label-warning">Deleted</span> @endif
														<span data-section_id="{{ $section->id }}" class="toc-icon toc-delete label pull-right label-danger" data-toggle="tooltip" data-placement="left" title="Delete"><span class="fa @if ($section->deleted) fa-undo @else fa-times @endif"></span></span>
														<span data-section_id="{{ $section->id }}" class="toc-check-complete label pull-right @if ($section->completed) label-success @else label-default @endif" data-toggle="tooltip" data-placement="left" title="Mark as complete"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
														<!--<span class="label pull-right text-length label-info">Good Text Length</span>-->
													</div>
													<ul>
														@if (count($section->children))
													  		@foreach ($section->children as $child)
																<li data-title="{{ $child->title }}" data-section-id="{{ $child->id }}" class="li-section-child @if ($child->deleted) deleted @endif">
																	<div>
																		<input type="hidden" name="sort_order[]" value="{{ $child->id }}" />
																		<input type="hidden" name="section-{{ $child->id }}-parent" value="{{ $index }}" />

																		<span class="fa fa-bars" style="cursor: move;"></span>
																		<a href="/account/project/section/{{ $project->id }}/{{ $child->id }}">{{ $child->title }}</a> @if ($child->deleted) <span class="label pull-right label-warning">Deleted</span> @endif
																		<span data-section_id="{{ $child->id }}" class="toc-icon toc-delete label pull-right label-danger"><span class="fa @if ($child->deleted) fa-undo @else fa-times @endif"></span></span>
																		<span data-section_id="{{ $child->id }}" class="toc-icon toc-check-complete label pull-right @if ($child->completed) label-success @else label-default @endif"><span class="fa @if ($child->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
																		<!--<span class="label pull-right text-length label-default section-{{ $child->id }}-label">Not Started</span>-->
																	</div>
                                                                    <ul>
                                                                        @if (count($child->children))
                                                                            @foreach ($child->children as $chch)
                                                                                <li data-title="{{ $chch->title }}" data-section-id="{{ $chch->id }}" class="li-section-child @if ($chch->deleted) deleted @endif">
                                                                                    <div>
                                                                                        <input type="hidden" name="sort_order[]" value="{{ $chch->id }}" />
                                                                                        <input type="hidden" name="section-{{ $chch->id }}-parent" value="{{ $child->id }}" />

                                                                                        <span class="fa fa-bars" style="cursor: move;"></span>
                                                                                        <a href="/account/project/section/{{ $project->id }}/{{ $chch->id }}">{{ $chch->title }}</a> @if ($chch->deleted) <span class="label pull-right label-warning">Deleted</span> @endif
                                                                                        <span data-section_id="{{ $chch->id }}" class="toc-icon toc-delete label pull-right label-danger"><span class="fa @if ($chch->deleted) fa-undo @else fa-times @endif"></span></span>
                                                                                        <span data-section_id="{{ $chch->id }}" class="toc-icon toc-check-complete label pull-right @if ($chch->completed) label-success @else label-default @endif"><span class="fa @if ($chch->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
                                                                                        <!--<span class="label pull-right text-length label-default section-{{ $chch->id }}-label">Not Started</span>-->
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                    </ul>
																</li>
															@endforeach
														@endif
														<li class="new-component">
															<div class="input-group">
																<input type="text" class="form-control" placeholder="Enter a new component label here..." aria-describedby="section-{{ $section->id }}-add" />
																<span class="btn input-group-addon add-page" id="section-{{ $section->id }}-add" data-project_section_id="{{ $section->id }}">ADD</span>
															</div>
														</li>
														<!--<li>
															<div>
																<p><button class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add Sub Page</button></p>
															</div>
														</li>-->
													</ul>
												</li>
											<?php endforeach; ?>
                                            <?php unset($section); ?>
											<li id="final-leaf" class="new-component">
												<div class="input-group">
													<input type="text" class="form-control" placeholder="Enter a new section label here..." aria-describedby="section-0-add" />
													<span class="btn input-group-addon add-page" id="section-0-add" data-project_section_id="0">ADD</span>
												</div>
											</li>
										</ul>
										
									</div>
									<!--<p><button class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add New Page</button></p>-->
								</div>
							</div>   
							<div class="wrapper-footer" style="display: none;">
								<button class="btn btn-lg btn-primary btn-icon" type="submit"><span class="fa fa-floppy-o"></span> Save Table of Contents</button>
								<!--<a href="#" class="btn btn-lg btn-success btn-icon"><span class="fa fa-check"></span> Project Details Saved</a>-->
							</div>
				        </div>

			        </div>
			        <div class="col-md-4 tips-column">
				        
	                	<div class="help">
				        	<span class="fa fa-question-circle"></span>
				        	<p>Need to learn more about best practices for audio descriptions? <a href="/guide">Read our guide</a> for more details!</p>
			        	</div>
			        	
			        	@include('project.shared.version')

                        @include('project.todo.main')
			        	
                        @include('project.shared.progress')

			        	<div class="panel panel-default">
							<div class="panel-heading">Tip: Table of Contents</div>
							<div class="panel-body">
								<!--
								<p>When your project is completed, click below to export your app as an Android APK file or iOS project ready to upload to the App Store.</p>
								<a href="#" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-download"></span> Export Project</a>
								-->
								<p>The Table of Contents lists all of the pages within your project. Click on a page title to edit. You can add pages or subpages as well as re-order the pages by dragging them within this list.</p>

								<p> <label for="toggle-deleted"><input type="checkbox" onclick="toggleDeleted();" id="toggle-deleted" /> Show deleted items</label> </p>
							</div>
						</div>
			        	
			          	@include('project.shared.export')

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
		
		
		
		$('[data-toggle="tooltip"]').tooltip();
		
		$('.form-control').bind('keypress', function(e){
			if ( e.keyCode == 13 ) {
				//console.log('the span:');
				//console.log(e.currentTarget.parentElement);
				$('span', e.currentTarget.parentElement).click();
				//$( this ).find( 'input[type=submit]:first' ).click();
				e.preventDefault();
			}
		});
		
		$('.toc-check-complete').on('click', function(event) {

			if ($(this).hasClass('label-default')) {
				
				var section_id = $(this).data('section_id');
				var section = $(this);
				
				//$(section).addClass('label-success');
				//$(section).removeClass('label-default');
				$(section).children().removeClass('fa-square-o');
    			$(section).children().addClass("fa-spinner fa-spin");

				var formData = { 
					_token: $('input[name=_token]').val(),
					completed: 1,
					id: section_id
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
					        $(section).removeClass('label-default');
							$(section).addClass('label-success');
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
					id: section_id
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
					        $(section).removeClass('label-success');
							$(section).addClass('label-default');
							$(section).children().addClass('fa-square-o');
	
				        }
				        else {
					        alert('Error: contact the site admin');
				        }
				    }
				});
				// Set it not completed
			}
			
	  	});
	  	
	  	$('.add-page').one('click', function(event) {
		  	//console.log( $(this).data() );
		  	//console.log($(this).prev().val());
		  	//console.log(event);
  			var formData = { 
				_token: $('input[name=_token]').val(),
				project_id: $('#id').val(),
				project_section_id: $(this).data('project_section_id'),
				title: $(this).prev().val(),
			};
			
			var list_item = $('.li-section-child').first();

			//console.log( $(list_item).html() );
			
			$.ajax({
			    url : "/account/project/addSection",
			    type: "POST",
			    data : formData,
			    success: function(data, textStatus, jqXHR)
			    {
				    location.reload();
				    //$("<li>" + $('.li-section').first().html() + "</li>").insertAfter( $('#final-leaf').prev() );       
			    }
			});
			
	  	});

		$('.toc-arrow').on('click', function() {
	    	$(this).toggleClass('glyphicon-chevron-right').toggleClass('glyphicon-chevron-down');
	  	});
	  	
	  	$('.fa-chevron-right', $('.table-of-contents')).click();
	  	
	  	
	  	$('.toc-delete').on('click', function(event) {

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

			
			var formData = { 
				_token: $('input[name=_token]').val(),
				deleted: deleted,
				id: section_id
			};

			if (deleted == 0 || confirm('Are you sure you want to delete this? If you do, you can still recover it by clicking "Show deleted items" in the right hand column.')) {	
				// Set it completed
				$.ajax({
					url : "/account/project/deleted",
					type: "POST",
					data : formData,
					success: function(data, textStatus, jqXHR)
					{
						if (data.status) {
							$(section).children().removeClass("fa-spinner fa-spin");
							//$(section).removeClass('label-success');
							//$(section).addClass('label-default');
							location.reload();
						}
						else {
							alert('Error: contact the site admin');
						}
					}
				});
			}
	  	});
	    
		//$(":file").filestyle({buttonBefore: true, placeHolder: 'Project Photo', buttonText: '&nbsp;Project photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});
	    
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
