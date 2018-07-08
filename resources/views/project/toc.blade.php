@extends('layouts.app')

@section('title', $project->title . ' table of contents')

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
	        <nav class="navbar navbar-default" style="border-radius: 4px;">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sub-navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<!--<span class="navbar-brand">My Project:</span>-->
					</div>
	
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="sub-navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Backstage <span class="sr-only">(current)</span></a></li>
							<!--<li><a href="/account/project/assets/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Media Assets</a></li>-->
							<li class="active"><a href="/account/project/toc/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">Frontstage</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
	    </div>
		
		<div class="row project">
		    <div>
				<form method="POST" action="/account/project/toc" enctype="multipart/form-data" id="toc-form">
					@if($editable)
						{!! csrf_field() !!}
					@endif
					
					@if($editable)
					<input type="hidden" name="id" id="id" value="{{ $project->id }}" />			
					<input type="hidden" name="new_sections" id="new_sections" value="{{ $new_sections }}" />
					<input type="hidden" name="json_toc" id="json_toc" value="" />
					@endif
					
							
		
					<?php 
					$needs_updating = FALSE;
					foreach($sections AS $sec){
						if($sec->sort_order==99){$needs_updating = TRUE;
						}
					}
					
					if($needs_updating && false){ ?>
					<div class="row">
				        <div class="col-md-8 edit-column" style="margin-bottom:20px">
					        <div class="wrapper" style="background-color:yellow; padding:5px 12px">
						        Update the ordering below to enable the Component Navigation.<br>This process only needs to be done once.
					        </div>
				        </div>
					</div>
					<?php } ?>
					
					
					<div class="row">
				        <div class="col-md-8 edit-column">
					        <div class="">
								<!-- table of contents see http://forresst.github.io/2012/06/22/Make-a-list-jQuery-Mobile-sortable-by-drag-and-drop/ -->
								<div class="panel panel-default">
                                    <div class="panel-heading">
                                    Frontstage: <p> <label for="toggle-deleted"><input type="checkbox" onclick="toggleDeleted();" id="toggle-deleted" <?php if (@$_GET['show_deleted']) { echo 'checked'; } ?>/> Show deleted items</label> </p>

                                    </div>
									<div class="panel-body white unid-list table-of-contents">
										<div data-role="content" data-theme="c">
											
											
											<ul data-role="listview" data-inset="true" data-theme="d" <?php if($editable){echo 'id="sortable" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded"';}?>>
												<?php foreach ($sections as $index => $section): ?>
                                                    <?php if (!@$_GET['show_deleted'] && $section->deleted) { continue; } ?>
													<li id="item-{{ $index }}" data-title="{{ $section->title }}" data-section-id="{{ $section->id }}" class="li-section mjs-nestedSortable-branch mjs-nestedSortable-expanded">
														<div style="overflow: hidden; width: 100%;">
													        <input type="hidden" id="section-{{ $index }}-title" name="section-{{ $index }}-title" class="form-control" value="{{ $section->title }}" />   
															<input type="hidden" name="sort_order[]" value="{{ $section->id }}" />
                                                            <!--<a href="#moveModal" role="button" onclick="$('#move_component_id').val({{ $section->id }})" data-toggle="modal">--><span class="fa fa-bars hidden-xs hidden-sm" style="cursor: move;"></span><!--</a>-->
															<i class="fa fa-chevron-down toggle"></i> <a href="/account/project/section/{{ $project->id }}/{{ $section->id }}">{{ $section->title }}</a> @if ($section->deleted) <span class="label pull-right label-warning">Deleted</span> @endif
															@if($editable)
															<span data-section_id="{{ $section->id }}" class="toc-icon toc-delete label pull-right label-danger" data-toggle="tooltip" data-placement="left" title="Delete"><span class="fa @if ($section->deleted) fa-undo @else fa-times @endif"></span></span>
															<span data-section_id="{{ $section->id }}" class="toc-check-complete label pull-right @if ($section->completed) label-success @else label-default @endif" data-toggle="tooltip" data-placement="left" title="Mark as complete"><span class="fa @if ($section->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
															@endif
															<!--<span class="label pull-right hidden-xs hidden-sm text-length label-info">Good Text Length</span>-->
														</div>
														<ul>
															@if (count($section->children))
														  		@foreach ($section->children as $child)
																	<li data-title="{{ $child->title }}" data-section-id="{{ $child->id }}" class="li-section-child @if ($child->deleted) deleted @endif">
																		<div style="overflow: hidden; width: 100%;">
																			<input type="hidden" name="sort_order[]" value="{{ $child->id }}" />
																			<input type="hidden" name="section-{{ $child->id }}-parent" value="{{ $index }}" />
	
                                                                            <!--<a href="#moveModal" role="button" onclick="$('#move_component_id').val({{ $child->id }})" data-id="section-{{ $child->id }}-parent" data-toggle="modal">--><span class="fa fa-bars hidden-xs hidden-sm" style="cursor: move;"></span><!--</a>-->
																			<a href="/account/project/section/{{ $project->id }}/{{ $child->id }}">{{ $child->title }}</a> @if ($child->deleted) <span class="label pull-right label-warning">Deleted</span> @endif
																			@if($editable)
																			<span data-section_id="{{ $child->id }}" class="toc-icon toc-delete label pull-right label-danger"><span class="fa @if ($child->deleted) fa-undo @else fa-times @endif"></span></span>
																			<span data-section_id="{{ $child->id }}" class="toc-icon toc-check-complete label pull-right @if ($child->completed) label-success @else label-default @endif"><span class="fa @if ($child->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
																			@endif
																			<!--<span class="label pull-right hidden-xs hidden-sm text-length label-default section-{{ $child->id }}-label">Not Started</span>-->
																		</div>
	                                                                    <ul>
	                                                                        @if (count($child->children))
	                                                                            @foreach ($child->children as $chch)
	                                                                                <li data-title="{{ $chch->title }}" data-section-id="{{ $chch->id }}" class="li-section-child @if ($chch->deleted) deleted @endif">
	                                                                                    <div style="overflow: hidden; width: 100%;">
	                                                                                        <input type="hidden" name="sort_order[]" value="{{ $chch->id }}" />
	                                                                                        <input type="hidden" name="section-{{ $chch->id }}-parent" value="{{ $child->id }}" />
	
                                                                                            <!--<a href="#moveModal" onclick="$('#move_component_id').val({{ $chch->id }})" role="button" data-id="section-{{ $chch->id }}-parent" data-toggle="modal">--><span class="fa fa-bars hidden-xs hidden-sm" style="cursor: move;"></span><!--</a>-->
	                                                                                        <a href="/account/project/section/{{ $project->id }}/{{ $chch->id }}">{{ $chch->title }}</a> @if ($chch->deleted) <span class="label pull-right label-warning">Deleted</span> @endif
	                                                                                        @if($editable)
	                                                                                        <span data-section_id="{{ $chch->id }}" class="toc-icon toc-delete label pull-right label-danger"><span class="fa @if ($chch->deleted) fa-undo @else fa-times @endif"></span></span>
	                                                                                        <span data-section_id="{{ $chch->id }}" class="toc-icon toc-check-complete label pull-right @if ($chch->completed) label-success @else label-default @endif"><span class="fa @if ($chch->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
	                                                                                        @endif
	                                                                                        <!--<span class="label pull-right hidden-xs hidden-sm text-length label-default section-{{ $chch->id }}-label">Not Started</span>-->
	                                                                                    </div>
	                                                                                </li>
	                                                                            @endforeach
	                                                                        @endif
	                                                                    </ul>
																	</li>
																@endforeach
															@endif
															
															@if($editable)
<!--
															<li class="new-component">
																<div class="input-group">
																	<input type="text" style="width: 80%" class="form-control" placeholder="Enter a new component label here..." aria-describedby="section-{{ $section->id }}-add" />
																	<span class="btn btn-sm btn-primary btn-inline add-page" style="width: 18%;" id="section-{{ $section->id }}-add" data-project_section_id="{{ $section->id }}"><i id="plus-icon" class="fa fa-plus fa-fw"></i> <span class="hidden-xs hidden-sm">ADD</span></span>
																</div>
															</li>
-->
															@endif
															<!--<li>
																<div>
																	<p><button class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add Sub Page</button></p>
																</div>
															</li>-->
														</ul>
													</li>
												<?php endforeach; ?>
	                                            <?php unset($section); ?>
	                                            
	                                            @if($editable)
												<li id="final-leaf" class="new-component">
													<div class="input-group">
														<input type="text" class="form-control" style="width: 80%;" placeholder="Enter a new section or component label here..." aria-describedby="section-0-add" />
														<span class="btn btn-sm btn-primary btn-inline add-page" style="width: 18%;" id="section-0-add" data-project_section_id="0"><i id="plus-icon" class="fa fa-plus fa-fw"></i> <span class="hidden-xs hidden-sm">ADD</span></span>
													</div>
												</li>
												@endif
											</ul>
											
										</div>
										<!--<p><button class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add New Page</button></p>-->
									</div>
								</div>   
								<div class="wrapper-footer">
									<!--<button class="btn btn-lg btn-primary btn-icon" type="submit"><span class="fa fa-floppy-o"></span> Save Frontstage</button>-->
									<button class="btn btn-lg btn-primary btn-icon"><span class="fa fa-floppy-o"></span> Save </button>
									<!--<a href="#" class="btn btn-lg btn-success btn-icon"><span class="fa fa-check"></span> Project Details Saved</a>-->
								</div>
					        </div>
	
				        </div>
				        <div class="col-md-4 tips-column">
					        
	                        @include('project.shared.progress')

                            @include('project.todo.main')
	
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
   $('input.form-control').blur(function(event){
        if ($(event.currentTarget).val().length > 0) {
            $(event.currentTarget).next().click();
            event.preventDefault();
        }
        //$(event.currentTarget).next().click();
   });
   $('input.form-control').keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        $(event.currentTarget).next().click();
        return false;
      }
   });
});


var posX = 0;
var posY = 0;
var secondsDragging = 0;
var isDragging = false;
var $elems = $("html, body");
var delta = 0;

$(document).on("mousemove", function(e) {
    var h = $(window).height();
    var y = e.clientY - h / 2;
    delta = y * 0.01;
});

$(window).on("blur mouseleave", function() {
    delta = 0;
});

(function f() {
    if(delta && isDragging && secondsDragging > 0 && (posY < 30 || posY > 30)) {
        $elems.scrollTop(function(i, v) {
            return v + delta;
        });
    }
    requestAnimationFrame(f);
})();
	
	$(document).ready(function() {

        $("body").mousemove(function(e) {
            posX = e.pageX/window.innerWidth*100;
            posY = e.pageY/window.innerHeight*100;
        });
        
        $(document).mousedown(function() {
            isDragging = true;
            secondsDragging = 0;
            setTimeout(function(){secondsDragging += 2},2000);
        });		
        $(document).mouseup(function() {
            isDragging = false;
        });		

		$('[data-toggle="tooltip"]').tooltip();
		
		@if($editable)
		$('.form-control').bind('keypress', function(e){
			if ( e.keyCode == 13 ) {
				//console.log('the span:');
				//console.log(e.currentTarget.parentElement);
				$('span', e.currentTarget.parentElement).click();
				//$( this ).find( 'input[type=submit]:first' ).click();
				e.preventDefault();
			}
		});
		@endif
		
		@if($editable)
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
	  	@endif
	  	
	  	@if($editable)
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
	  	@endif

		$('.toc-arrow').on('click', function() {
	    	$(this).toggleClass('glyphicon-chevron-right').toggleClass('glyphicon-chevron-down');
	  	});
	  	
	  	$('.fa-chevron-right', $('.table-of-contents')).click();
	  	
	  	@if($editable)
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
	  	@endif
	    
		//$(":file").filestyle({buttonBefore: true, placeHolder: 'Project Photo', buttonText: '&nbsp;Project photo', size: 'md', input: false, iconName: "fa fa-camera-retro"});
	    
	    // Take the nav bar into account
	    $(window).on("hashchange", function () {
		    window.scrollTo(window.scrollX, window.scrollY - 60);
		});
		
		@if($editable)
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
		@endif


        //var ref = document.referrer;
        //alert(ref);
        if (document.referrer != window.location.href) {
            group = $("ul#sortable");
            var data = group.sortable("serialize").get();
            var jsonString = JSON.stringify(data, null, ' ');
            console.log(jsonString);
            $('#json_toc').val(jsonString);
            console.log($('#json_toc'));
            //_super($item, container);
            //alert('about to submit');
            $('#toc-form').submit();
        }
	
	});

    var called = 0;
    function move_component(id, direction)
    {
        called++;
        called++;
        var e = $("li[data-section-id='"+id+"']");
        if (direction == 'up') {
            e.prev().insertAfter(e);
        }
        else if (direction == 'down') {
            e.next().insertBefore(e);
        }
        else if (direction == 'left') {
            e.removeClass('li-section-child');
            e.addClass('li-section');
            e.addClass('mjs-nestedSortable-branch');
            e.addClass('mjs-nestedSortable-expanded');
            e.parent().parent().before(e[0].outerHTML);
            e.remove();
        }
        else if (direction == 'right') {
            e.addClass('li-section-child');
            e.removeClass('li-section');
            e.removeClass('mjs-nestedSortable-branch');
            e.removeClass('mjs-nestedSortable-expanded');
            //$('.li-section-child', e.prev())[0].append( e[0].outerHTML );
            $('.li-section-child:last', e.prev()).after( e[0].outerHTML );
            e.remove();
            //e.parent().parent().before(e[0].outerHTML);
        } 
    
    }

        
function submittoc() {
        var group = $("ul#sortable").sortable({
            handle: "span.fa-bars",
            afterMove: function ($placeholder, container, $closestItemOrContainer) {
                //console.log('afterMove');
                //console.log($placeholder, container, $closestItemOrContainer);
            },
            onCancel: function ($item, container, _super, event) {
                console.log('onCancel was called');
            },
            onDrop: function ($item, container, _super) {
                var data = group.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');
                //console.log('onDrop');
                console.log(jsonString);
                $('#json_toc').val(jsonString);
                //$('#serialize_output').html("<PRE>"+jsonString+"</pre>");
                _super($item, container);
                $('#toc-form').submit();
            },
            /*
            isValidTarget: function ($item, container) {
                return true;
            },
            */
            //tolerance: 6,
            //distance: 10,
            exclude: ".new-component",
            nested: true
        });

        var data = group.sortable("serialize").get();
        var jsonString = JSON.stringify(data, null, ' ');
        //console.log('onDrop');
        console.log(jsonString);
        $('#json_toc').val(jsonString);
        $('#toc-form').submit();

}

/*
$(window).bind('beforeunload', function(){
          submittoc();
});
 */

</script>


<div class="modal fade" id="moveModal" tabindex="-1" role="dialog" aria-labelledby="moveModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="moveModalLabel">Select direction to move component</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="move_component_id" name="move_component_id" value="" />
        <button style="margin: 5px; display: inline;" onclick="move_component($('#move_component_id').val(), 'up');" type="button" class="btn btn-primary" aria-label="Move component up"><span aria-hidden="true">&uarr;</span></button>
        <button style="margin: 5px; display: inline;" onclick="move_component($('#move_component_id').val(), 'down');" type="button" class="btn btn-primary" aria-label="Move component down"><span aria-hidden="true">&darr;</span></button>
        <button style="margin: 5px; display: inline;" onclick="move_component($('#move_component_id').val(), 'left');" type="button" class="btn btn-primary" aria-label="Move component left"><span aria-hidden="true">&larr;</span></button>
        <button style="margin: 5px; display: inline;" onclick="move_component($('#move_component_id').val(), 'right');" type="button" class="btn btn-primary" aria-label="Move component right"><span aria-hidden="true">&rarr;</span></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
