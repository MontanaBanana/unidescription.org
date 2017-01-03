@extends('layouts.app')

@section('title', 'About')

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
	<div class="container">	
		<div class="col-lg-12">
			<h1 class="page-header">Account
				<small>Activity</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="{{ SITEROOT }}/">Home</a>
				</li>
				<li class="active">Account Activity</li>
			</ol>
		</div>
	</div>
</div>
<!-- /.row -->

<!-- Content -->
<div class="row" style="margin-bottom:40px">
	<div class="container">	
	    
	    <h2 class="page-header" style="margin-top:0; text-align:center">User Activity for the last hour</h2>
    
    	@if($activity)
    		<div class="col-xs-12">
		    	@foreach ($activity as $a)
			    	<div class="row">
				    	<div class="col-xs-3 col-lg-4">{{$a->name}}</div>
				    	<div class="col-xs-5 col-lg-4"><a href="{{$a->last_url}}" target="_blank">{{$a->last_url}}</a></div>
				    	<div class="col-xs-4 col-lg-4">{{timeAgo($a->last_url_time)}}</div>
			    	</div>
		    	@endforeach
    		</div>
	    @else
	    	There is no user activity currently logged.
	    @endif
    
	</div>
</div>

<!-- /.row -->
		
@endsection
		    