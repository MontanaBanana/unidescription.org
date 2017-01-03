@extends('layouts.app')

@section('title', $project->title . ' Build')

@section('content')


        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">My Projects
                    <small>list of your projects</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ SITEROOT }}/">Home</a></li>
                    <li><a href="{{ SITEROOT }}/account">Account</a></li>
                    <li><a href="{{ SITEROOT }}/account/project/">My Projects</a></li>
                    <li><a href="{{ SITEROOT }}/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">{{ $project->title }}</a></li>
                    <li class="active">Build</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

    	<!-- row -->
        <div class="row">
            <div class="col-md-12">
				<h2>Success!</h2>
				<p>Your app has successfully been built. </p>
				<p>From this page you can preview the generated app in your web browser, go to the mobile app download page, or share a link to the mobile download page.</p>
				<p><strong>Note:</strong> it can take up to 15 minutes before the mobile app packages are ready to download (though usually it only takes about 1 minute).</p>
				<p><a class="btn btn-lg btn-primary btn-icon" target="_blank" href="{{ SITEROOT }}/account/project/export/{{ $project->id }}"><span class="fa fa-eye"></span> Preview project in web browser</a></p>
				<p><a class="btn btn-lg btn-primary btn-icon" target="_blank" href="<?php echo $pg_build['install_url']; ?>"><span class="fa fa-mobile"></span> Mobile download link</a></p>
				<p><input name="share_url" value="<?php echo $pg_build['install_url']; ?>" style="width: 500px;" onclick="this.select();" /></p>
            </div>
        </div>
        <!-- /.row -->

    	<!-- row -->
        <div class="row">
            <div class="col-md-12">
	            <p>Developer debugging:</p>
	            <p><pre><?php print_r($pg_build); ?></pre></p>
            </div>
        </div>
        <!-- /.row -->
        <hr />
	    
@endsection
