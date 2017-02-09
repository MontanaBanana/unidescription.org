		<div class="row">
			<div class="container">	
				<div class="col-lg-12">
					<h1 class="page-header">Forum
						<small>UniDescription Forum</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="{{ SITEROOT }}/">Home</a></li>
					    <li><a href="{{ url(config('forum.routing.root')) }}">Forum<!--{{ trans('forum::general.index') }}--></a></li>
					    @if (isset($category) && $category)
					        @include ('forum::partials.breadcrumb-categories', ['category' => $category])
					    @endif
					    @if (isset($thread) && $thread)
					        <!--<li><a href="{{ Forum::route('thread.show', $thread) }}">{{ $thread->title }}</a></li>-->
					        <li style="color: white;">{{ $thread->title }}</li>
					    @endif
					    @if (isset($breadcrumb_other) && $breadcrumb_other)
					        <li style="color: white;">{!! $breadcrumb_other !!}</li>
					    @endif
					</ol>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container">	
				<div class="col-lg-12">
