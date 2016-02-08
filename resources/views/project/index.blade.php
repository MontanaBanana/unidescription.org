@extends('layouts.app')

@section('content')


        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">My Projects
                    <small>list of your projects</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/account">Account</a></li>
                    <li class="active">My Projects</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Project Listing -->
        <?php $projects = Auth::user()->all_projects(); ?>
        @foreach ($projects as $project)
        	<!-- row -->
	        <div class="row">
	            <div class="col-md-5">
					<a href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">
	                    <img class="img-responsive img-hover thumbnail" src="{{ $project->image_url }}" alt="{{ $project->title }}">
	                </a>
	            </div>
	            <div class="col-md-7">
	                <h3>{{ $project->title }}</h3>
	                <small>
	                	Created: {{ date('F jS, Y', strtotime($project->created_at)) }}<br />
						Updated: {{ date('F jS, Y', strtotime($project->updated_at)) }}
					</small>
	                <p>
		            	{{ $project->description }}
	                </p>
	                <a class="btn btn-primary" href="/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">View Project</i></a>
	            </div>
	        </div>
	        <!-- /.row -->
	        <hr />
        @endforeach

@endsection