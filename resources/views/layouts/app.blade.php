<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/favicons/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicons/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
	<link rel="manifest" href="/favicons/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/favicons/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<title>UniD - @yield('title')</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ SITEROOT }}/css/nps-bootstrap.css">
	
	<!-- Custom Fonts -->
	<link href="{{ SITEROOT }}/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="//fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,600,700" rel="stylesheet" type="text/css">

	<!-- RTE -->
	<link rel="stylesheet" href="{{ SITEROOT }}/css/trumbowyg.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript" src="{{ SITEROOT }}/js/canvas-to-blob.min.js"></script>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css">
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<!--<script type="text/javascript" src="http://www.nps.gov/lib/bootstrap/3.3.2/js/nps-bootstrap.min.js"></script>-->
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ SITEROOT }}/js/bootstrap-filestyle.min.js"></script>
	<script type="text/javascript" src="{{ SITEROOT }}/js/jquery-sortable.min.js"></script>
	<script type="text/javascript" src="{{ SITEROOT }}/js/autosize.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script>
	<!--<script type="text/javascript" src="{{ SITEROOT }}/js/jquery.mjs.nestedSortable.js"></script>-->

	<!-- RTE -->
	<script type="text/javascript" src="{{ SITEROOT }}/js/trumbowyg.js"></script>

	<!-- Unidescription custom JS -->
	<script type="text/javascript" src="{{ SITEROOT }}/js/unidescription.js?ts=1234"></script>

	<!-- cropper -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.2/cropper.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.2/cropper.min.js"></script>

	<script type="text/javascript" src="{{ SITEROOT }}/js/dropzone.js"></script>
	
	<link href="{{ SITEROOT }}/css/unidescription.css" rel="stylesheet">
	<link href="{{ SITEROOT }}/css/responsive.css" rel="stylesheet">

	@yield('header')
	
  </head>
  <body>
	@section('navbar')
		@include ('common.nav')
	@show
	
	@if (count($errors))
		<div class="alert alert-danger" role="alert">
			<div class="container">
				@foreach($errors->all() as $error)
				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  <span class="sr-only">Error:</span>
				  {{$error}}<br />
				@endforeach
			</div>
		</div>
	@endif
	  	  
	@yield('content')
	
	@section('footer')
		@include ('common.footer')
	@show

	@section('js')
	@show

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-74229208-1', 'auto');
	  ga('send', 'pageview');

	</script>

	<script type="text/javascript" src="https://seattlemb.atlassian.net/s/facec166f3b90481a98c70aef7999867-T/mzwzae/100012/c/1000.0.9/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=c8cf07bc"></script>

  </body>
</html>
