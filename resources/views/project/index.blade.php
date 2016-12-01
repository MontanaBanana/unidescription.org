@extends('layouts.app')

@section('title', 'My Projects');

@section('content')
 
<?php 

/**
 * get projects
 * also gets $sortBy and $direction values from URL or defaults to 'created' 'asc'
 */
$projects = Auth::user()->all_projects($sortBy, $direction); 

?>

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
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
        <!-- /.row -->
        
        <!-- Project Filter -->
        <div class="row">
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
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Project Listing -->
        @foreach ($projects as $project)
        	<!-- row -->
	        <div class="row">
	            <div class="col-md-5">
					<a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">
	                    <img class="img-responsive img-hover thumbnail" src="<?php if ($project->image_url) { echo $project->image_url; } else { echo 'https://placeholdit.imgix.net/~text?txtsize=14&txt=Project Placeholder Image&w=380&h=250'; } ?>" alt="{{ $project->title }}">
	                </a>
					@include('project.shared.progress')
	            </div>
	            <div class="col-md-7">
	                <h3><a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">{{ $project->title }}</a></h3>
	                <small>
	                	Created: {{ date('F jS, Y', strtotime($project->created_at)) }}<br />
						Updated: {{ date('F jS, Y', strtotime($project->updated_at)) }}<br />
					</small>
					<?php if (strlen($project->author)): ?>
						<strong>Author:</strong> {{ $project->author }}<br />
					<?php endif; ?>
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
							<strong>Shared with:</strong>
								@foreach ($project->users as $user)
									{{ $user->email }}&nbsp;
								@endforeach
						</p>
					<?php endif; ?>
	                <a class="btn btn-primary btn-icon" href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}"><span class="fa fa-eye"></span> Edit Project</i></a>
	                <a class="btn btn-primary btn-icon label-danger delete-project" href="/account/project/deleteconfirm/{{ $project->id }}" data-id="{{ $project->id }}"><span class="fa fa-times"></span> Delete Project</i></a>
	            </div>
	        </div>
	        <!-- /.row -->
	        <hr />
        @endforeach
	    
@endsection
