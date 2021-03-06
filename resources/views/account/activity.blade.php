@extends('layouts.app')

@section('title', 'About')

@section('content')


<style>
.hover:hover{
	background-color:rgba(122,143,82,0.5);
	color:#FFF
}
.hover:hover a{
	color:#FFF
}
</style>

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
    
    	<?php $count = 0; ?>
    	
    	@if($activity)
    		<div class="col-xs-12">
		    	@foreach ($activity as $a)
		    		<?php ++$count;?>
			    	<div class="row hover">
				    	<div class="row">
					    	<div class="col-xs-6 col-sm-4 col-md-4">{{$a->name}}</div>
					    	<div class="col-xs-6 col-sm-4">{{$a->email}}</div>
					    	<div class="col-xs-12 col-sm-4">{{timeAgo($a->last_url_time)}}</div>
				    	</div>
				    	<div class="row">
					    	<div class="col-xs-12"><a href="{{$a->last_url}}" target="_blank">{{$a->last_url}}</a></div>
				    	</div>
			    	</div>
		    	@endforeach
    		</div>
	    @else
	    	There is no user activity currently logged.
	    @endif
		@if(!$count)
			There is no user activity currently logged.
		@endif
	</div>
</div>

<!-- /.row -->
		
@endsection
		    