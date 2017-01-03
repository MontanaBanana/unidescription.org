@extends('layouts.app')

@section('title', 'Account Activity');

@section('content')


<div class="row settings">
    <div class="col-lg-12">
	    
	    <h1>User Activity for the last hour</h1>
    
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

@endsection
