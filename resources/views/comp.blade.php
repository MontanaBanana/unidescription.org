@extends('layouts.app')

@section('header')

@endsection

@section('content')

<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
	    <p>&nbsp;</p>
        <ol class="breadcrumb">
            <li><a href="{{ SITEROOT }}">Home</a></li>
            <li><a href="{{ SITEROOT }}/account">Account</a></li>
            <li><a href="{{ SITEROOT }}/account/project">My Projects</a></li>
            <li class="active">
            	Name of Project
            </li>
        </ol>
    </div>
    <div class="col-lg-12">
        <nav class="navbar navbar-default">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<span class="navbar-brand">My Project:</span>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-project-navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Project Details <span class="sr-only">(current)</span></a></li>
						<li><a href="#">App Store Assets</a></li>
						<li><a href="#">Table of Contents</a></li>
						<li><a href="#">Planning Your Visit</a></li>
						<li><a href="#">Geographic Orientation</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
    </div>
    
    <!-- editable form column -->
    <div class="row project">
        <div class="col-md-8 edit-column">
            <div class="wrapper">
	            
	            <!-- warning -->
	            <div class="warning">
		            <span class="desktop-only">This content is currently being edited by <a href="#">Thomas Edison</a>.</span>
		            <span class="mobile-only">Locked by <a href="#">Thomas Edison</a>.</span>
		            <a href="#" class="btn btn-primary">Unlock</a>
	            </div>
	            
	            <!-- project details -->
	            <div class="panel panel-default">
					<div class="panel-heading">Project Template:</div>
					<div class="panel-body">
						<div class="select-template selected">
							<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							<p>No Template</p>
						</div>
						<div class="select-template">
							<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							<p>NPS Brochure</p>
						</div>
						<div class="select-template">
							<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							<p>Something Else</p>
						</div>
						<div class="select-template">
							<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							<p>Placeholder</p>
						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						Project Name:
						<span class="label pull-right label-info">Good Text Length</span>
					</div>
					<div class="panel-body form-element">
						<input type="text" class="large" name="" placeholder="Enter a project name here.." />
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						Project Description:
						<span class="label pull-right label-info">Good Text Length</span>	
					</div>
					<div class="panel-body form-element">
						<textarea name="" placeholder="Enter a project description here..."></textarea>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">Project Photo:</div>
					<div class="panel-body white">
						<div class="col-md-6">
							<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
						</div>
						<div class="col-md-6">
							<p>This photo is used for vivamus sagittis lacinia turpis. Uploaded image should be at least 800x600 pixels.</p>
							<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload Photo</a>
						</div>
					</div>
				</div>

				<!-- app store assets -->
				<div class="panel panel-default">
					<div class="panel-heading">App Store Icons:</div>
					<div class="panel-body white">
						<div class="col-md-6">
							<p><b>Icon for iOS (Apple Devices):</b></p>
							<div class="col-md-6 no-left-padding">
								<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
							</div>
							<div style="clear:both;"></div>
							<p>iOS App Store icon should be square, at least 1024x1024. The system will create all smaller sizes for you.</p>
						</div>
						<div class="col-md-6">
							<p><b>Icon for Android:</b></p>
							<div class="col-md-6 no-left-padding">
								<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
							</div>
							<div style="clear:both;"></div>
							<p>Android App Store icon should be a  PNG file with optional transparency, at least 1024x1024.</p>
						</div>
						<div style="clear:both;"></div>
						<div class="panel-note">
							<img class="icon" src="{{ SITEROOT }}/images/icon-psd.png" alt="Photoshop Icon" width="56" height="56" />
							<p><a href="#">Download</a> this Photoshop (PSD) template with the National Park Service logo for branding consistency. You’ll find a layer in this PSD file to place your artwork.</p>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">Loading Screen/App Screenshots:</div>
					<div class="panel-body white">
						<div class="col-md-6">
							<p><b>Splash/Loading Screen:</b></p>
							<div class="col-md-6 no-left-padding">
								<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
							</div>
							<div style="clear:both;"></div>
							<p>
								iOS and Android splash screen image sizes can be found at these URLs:<br>
								<a href="#">Apple.com</a> | <a href="#">Android.com</a>
							</p>
						</div>
						<div class="col-md-6">
							<p><b>App Store Screenshot:</b></p>
							<div class="col-md-6 no-left-padding">
								<img class="thumbnail" src="{{ SITEROOT }}/images/campfires_and_candlelight.jpg" alt="">
							</div>
							<div class="col-md-6">
								<a href="#" class="btn btn-primary btn-icon"><span class="fa fa-camera-retro"></span> Upload</a>
							</div>
							<div style="clear:both;"></div>
							<p>
								iOS and Android screenshot image sizes can be found at these URLs:<br>
								<a href="#">Apple.com</a> | <a href="#">Android.com</a>
							</p>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						App Store Description:
						<span class="label pull-right label-info">Good Text Length</span>	
					</div>
					<div class="panel-body form-element">
						<textarea name="" placeholder="Enter a app store description here..."></textarea>
					</div>
				</div>
				
				<!-- table of contents see http://forresst.github.io/2012/06/22/Make-a-list-jQuery-Mobile-sortable-by-drag-and-drop/ -->
				<div class="panel panel-default">
					<div class="panel-heading">Table of Contents:</div>
					<div class="panel-body white table-of-contents">
						<div data-role="content" data-theme="c">
							<ul data-role="listview" data-inset="true" data-theme="d" id="sortable">
								<li id="item-0">
									<span class="fa fa-bars"></span>
									30 Second Overview
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length label-info">Good Text Length</span>
								</li>
								<li id="item-1">
									<span class="fa fa-bars"></span>
									<i class="fa fa-chevron-right toggle"></i> General Description
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length  label-info">Good Text Length</span>
									<div style="clear:both;"></div>
									<ul>
										<li>
											<span class="fa fa-bars"></span>
											Subpage #1
											<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
											<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
											<span class="label pull-right text-length  label-info">Good Text Length</span>
										</li>
										<li>
											<span class="fa fa-bars"></span>
											Subpage #2
											<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
											<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
											<span class="label pull-right text-length  label-info">Good Text Length</span>
										</li>
										<li>
											<span class="fa fa-bars"></span>
											Subpage #3
											<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
											<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
											<span class="label pull-right text-length  label-info">Good Text Length</span>
										</li>
										<li>
											<div class="input-group" id="share-input-group">
												<input type="text" class="form-control" id="share-email" placeholder="Enter a page name here..." aria-describedby="share-button" />
												<span class="btn input-group-addon" id="share-button">ADD</span>
											</div>
										</li>
										<li>
											<p><a href="#" class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add Sub Page</a></p>
										</li>
									</ul>
								</li>
								<li id="item-2">
									<span class="fa fa-bars"></span>
									<i class="fa fa-chevron-right toggle"></i> Planning Your Visit
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length  label-info">Good Text Length</span>
									<div style="clear:both;"></div>
									<ul>
										<li>
											<p><a href="#" class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add Sub Page</a></p>
										</li>
									</ul>
								</li>
								<li id="item-3">
									<span class="fa fa-bars"></span>
									<i class="fa fa-chevron-right toggle"></i> Accessibility
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length  label-info">Good Text Length</span>
								</li>
								<li id="item-4">
									<span class="fa fa-bars"></span>
									<i class="fa fa-chevron-right toggle"></i> Site Highlights
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length  label-info">Good Text Length</span>
								</li>
								<li id="item-5">
									<span class="fa fa-bars"></span>
									<i class="fa fa-chevron-right toggle"></i> For More Information
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length  label-info">Good Text Length</span>
								</li>
								<li id="item-6">
									<span class="fa fa-bars"></span>
									<i class="fa fa-chevron-right toggle"></i> Contact Information
									<span class="label pull-right label-danger"><span class="fa fa-times"></span></span>
									<span class="label pull-right label-success"><span class="fa fa-check"></span></span>
									<span class="label pull-right text-length  label-info">Good Text Length</span>
								</li>
								<li>
									<div class="input-group" id="share-input-group">
										<input type="text" class="form-control" id="share-email" placeholder="Enter a page name here..." aria-describedby="share-button" />
										<span class="btn input-group-addon" id="share-button">ADD</span>
									</div>
								</li>
							</ul>
						</div>
						<p><a href="#" class="btn btn-sm btn-primary btn-icon"><span class="fa fa-plus"></span> Add New Page</a></p>
					</div>
				</div>

				<!-- Edit page -->
				<div class="panel panel-default">
					<div class="panel-heading">
						Page Name:
						<span class="label pull-right label-info">Good Text Length</span>
					</div>
					<div class="panel-body form-element">
						<input type="text" class="large" name="" placeholder="Enter a page name here.." />
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						Page Description:
						<span class="label pull-right label-info">Good Text Length</span>	
					</div>
					<div class="panel-body form-element">
						<textarea class="tall" name="" placeholder="Enter a page description here..."></textarea>
					</div>
				</div>

				<div class="wrapper-footer">
					<a href="#" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-floppy-o"></span> Save Project Details</a>
					<a href="#" class="btn btn-lg btn-success btn-icon"><span class="fa fa-check"></span> Project Details Saved</a>
				</div>

        	</div>
        </div>
        <div class="col-md-4 tips-column">
	        
        	<div class="help">
	        	<span class="fa fa-question-circle"></span>
	        	<p>Need to learn more about best practices for audio descriptions? <a href="#">Read our guide</a> for more details!</p>
        	</div>
        	
        	<div class="panel panel-default">
				<div class="panel-heading">Project Progress:</div>
				<div class="panel-body">
					<div class="progress">
						<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">
							0%
						</div>
					</div>
				</div>
			</div>
        	
        	<div class="panel panel-default">
				<div class="panel-heading">Tip:</div>
				<div class="panel-body">
					<p>When your project is completed, click below to export your app as an Android APK file or iOS project ready to upload to the App Store.</p>
					<a href="#" class="btn btn-lg btn-primary btn-icon"><span class="fa fa-download"></span> Export Project</a>
				</div>
			</div>
        	
        	<div class="panel panel-default">
				<div class="panel-heading">Owner: George Washington</div>
				<div class="panel-body">
					<p>Grant access to other members of your team to view or make changes to your projects.</p>
					
					<p><b>Shared with:</b></p>
					<ul class="list-group share-list-group">
						<li class="list-group-item">
							<span class="glyphicon glyphicon-trash pull-right" style="cursor:pointer;" aria-hidden="true" data-email="thomas.edison@america.org"></span>
							<span class="email">thomas.edison@america.org</span>
						</li>
						<li class="list-group-item">
							<span class="glyphicon glyphicon-trash pull-right" style="cursor:pointer;" aria-hidden="true" data-email="ben.franklin@america.org"></span>
							<span class="email">ben.franklin@america.org</span>
						</li>
					</ul>
					
					<div class="input-group" id="share-input-group">
						<input type="email" class="form-control" id="share-email" placeholder="Email" aria-describedby="share-button" />
						<span class="btn input-group-addon" id="share-button"><i id="share-icon" class="fa fa-plus fa-fw"></i> Share</span>
					</div>
					
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">Content Tips:</div>
				<div class="panel-body">
					<p>Click on the subjects below to read more about the best practices for audio descriptions for this page.</p>
					<ul class="standard-list">
						<li>&bull; <a href="#">Lorem ipsum dolor sit amet</a></li>
						<li>&bull; <a href="#">Consectetur adipiscing elit</a></li>
						<li>&bull; <a href="#">Vivamus sagittis lacinia turpis</a></li>
						<li>&bull; <a href="#">Class aptent taciti sociosqu ad litora</a></li>
					</ul>
					<a href="#" class="btn btn-lg btn-white btn-icon"><span class="fa fa-users"></span> Join Our Forum!</a>
				</div>
			</div>
        	
        </div>
    </div>
    <!-- /.row -->
    
</div>
<!-- /.row -->

@endsection