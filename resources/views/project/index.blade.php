@extends('layouts.app')

@section('title', 'My Projects')

@section('content')
 
<?php 

/**
 * get projects
 * also gets $sortBy and $direction values from URL or defaults to 'created' 'asc'
 */
$projects = Auth::user()->all_projects($sortBy, $direction); 
foreach ($projects as $k => $v) {
}

?>

		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="container">
			<div class="col-lg-12">
					<h1 class="page-header">My Projects
						<small>list of your projects</small>
					</h1>
					<ol class="breadcrumb above-filter">
						<li><a href="/">Home</a></li>
						<li><a href="/account">Account</a></li>
						<li class="active">My Projects</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.row -->
		
		<!-- Project Filter -->
		<div class="row">
			<div class="container">
				<div class="col-lg-12">
					<ol class="filter">
						<li><strong>Filter By:</strong></li>
						<li><a href="/account/project/title/<?php echo (($sortBy == 'title') && $direction == 'asc' ? 'desc':'asc'); ?>">
							Name <?php
								
							if($sortBy == 'title'){
								?><span class="glyphicon glyphicon-chevron-<?php echo ($direction == 'asc' ? 'down':'up'); ?>"></span><?php
							}
								   
							?>
							</a></li>
						<li><a href="/account/project/created/<?php echo (($sortBy == 'created') && $direction == 'asc' ? 'desc':'asc'); ?>">
							Date <?php
								
							if($sortBy == 'created'){
								?><span class="glyphicon glyphicon-chevron-<?php echo ($direction == 'asc' ? 'down':'up'); ?>"></span><?php
							}
								   
							?>
							</a></li>
						<li>
							<input type="text" name="filter" id="filter" value="" style="color:#888" placeholder="Filter by Title">
						</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.row -->

		<!-- Project Listing -->
		@foreach ($projects as $project)
		
			
		<?php
			$c = DB::select('SELECT can_edit FROM project_user WHERE project_id=:projectid AND user_id=:userid LIMIT 1', ['projectid'=>$project->id, 'userid'=>Auth::user()->id]);
			$c = array_shift($c);
			$editable = 0;
			if($c){
				$editable = $c->can_edit;
			}
			if($project->user_id == Auth::user()->id){$editable = 1;}			
		?>
			<!-- row -->
			<div class="row project_row p_{{$project->id}}" title="{{strtolower(str_replace(' ', '', preg_replace("/[^a-z0-9]/i", "", $project->title)))}}">
				<div class="container">
					<div class="col-md-5">
						<a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">
							<img class="photo img-responsive img-hover thumbnail" src="<?php if ($project->image_url) { echo $project->image_url; } else { echo '/images/placeholder.png'; } ?>" alt="{{ $project->title }}">
						</a>
						@include('project.shared.progress')
					</div>
					<div class="col-md-7">
						<h3><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">{{ $project->title }}</a></h3>
						<small>
							Created: {{ date('F jS, Y', strtotime($project->created_at)) }}<br />
							Updated: {{ date('F jS, Y', strtotime($project->updated_at)) }}<br />
						</small>
						<!--<?php if (strlen($project->author)): ?>
							<strong>Author:</strong> {{ $project->author }}<br />
						<?php endif; ?>-->
						<?php if (strlen($project->description)): ?>
							<strong>Description:</strong> {{ $project->description }}<br />
						<?php endif; ?>
						<?php if (strlen($project->version)): ?>
								<strong>Version notes:</strong> {{ $project->version }}<br />
						<?php endif; ?>
						<?php if (strlen($project->metatags)): ?>
								<strong>Metatags:</strong> {{ $project->metatags }}<br />
						<?php endif; ?>
						<?php if (count($project->users)): ?>
							<p>
								<strong>Owner:</strong> {{ $project->user->email }}<br />
								<strong>Shared with:</strong>
									@foreach ($project->users as $user)
										{{ $user->email }}&nbsp;
									@endforeach
							</p>
						<?php endif; ?>
						@if($editable)
						<a class="btn btn-primary btn-icon" href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}"><span class="fa fa-eye"></span> Edit Project</i></a>
						<a class="btn btn-primary btn-icon label-danger delete-project" href="/account/project/deleteconfirm/{{ $project->id }}" data-id="{{ $project->id }}"><span class="fa fa-times"></span> Delete Project</i></a>
						@endif
					</div>
				</div>
			<!-- /.row -->
			<hr />
			</div>
		@endforeach
		
@endsection


@section('js')
<script type="text/javascript">
	$('#filter').on('input',function(e){
		var f = $(this).val().replace(/\s/g,'').replace(/[^a-zA-Z 0-9]+/g, '').toLowerCase();
		var l = f.length;
		if(l > 0){
			$(".project_row").hide();
			$.each($('[title*="'+f+'"]'), function() {
				console.log(f);
			    $(this).show();
			});
			
		}
		else{
			$(".project_row").show();
		}
    });
</script>
@endsection
