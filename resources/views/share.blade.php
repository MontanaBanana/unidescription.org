@extends('layouts.app')

@section('title', 'License')

@section('content')

		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="container">
				<div class="col-lg-12">
					<h1 class="page-header">Share
						<small>Download the App</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="{{ SITEROOT }}/">Home</a>
						</li>
						<li class="active">Share</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="container">
				<div class="col-lg-12">

                        <p>The UniDescription App is currently available in both the Apple and Google Play stores.</p>
                        <p><a href="https://itunes.apple.com/us/app/unidescription/id1288434078?mt=8" target="_blank" title=""><img src="/images/app_store_available.png" alt="Available on the Apple App store" width="159"></a>&nbsp;
                        <a href="https://play.google.com/store/apps/details?id=org.unidescription.npsapp&amp;hl=en" target="_blank" title=""><img src="/images/play_store_available.png" alt="Available on the Google Play store" width="159"></a></p>    

				</div>
			</div>
		</div>

		<hr>

@endsection
