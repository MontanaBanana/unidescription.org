@extends('layouts.app')

@section('title', 'Home');

@section('content')

    <!-- Header Carousel -->
    
    <header>
	    <div class="centerpiece" style="background-image:url({{ SITEROOT }}/slideshow/ad_photo1-cropped.jpg)">
			<div style="padding-top: 25%;">
				<div class="getting-started" style="margin-left: 50%; width: 40%;">
					<p style="font-size: 22px;"><strong>How do you get started?</strong> Just <a href="{{ SITEROOT }}/auth/register">create a free account</a>, <a href="{{ SITEROOT }}/auth/login">sign in</a>, and start a new project.</p>
				</div>
			</div>
    </header>

    <!-- Page Content -->
    <div class="container">
        <div class="row" style="background-color: #f9f7f1">
            <div class="col-lg-12">
		        <h1 class="page-header" style="font-family: Helvetica;">
		            <center><strong style="font-size: 42px">The UniD Project</strong>
		            <div class="small">To Create Acoustic Spaces and More Accessible Places</div></center>
		        </h1>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="row home-boxes" style="background-color: #f9f7f1">         
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><em class="fa fa-fw fa-comment"></em> Discuss that in our forums:</strong>
                    </div>
                    <div class="panel-body">
                        <p>If you want to talk about any aspect of audio description, our forums provide a focused place for debates, questions, and learning about related issues. </p>
                        <a href="{{ SITEROOT }}/forum" class="btn btn-default">Forum!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><em class="fa fa-fw fa-volume-up"></em> Make audio description available</strong>
                    </div>
                    <div class="panel-body">
                        <p>If you want to audio describe anything, our tool can help, and when you are ready to share your work, it is available in multiple forms, including text, audio files, and upload-ready mobile apps.</p>
                        <a href="{{ SITEROOT }}/account/project/details/0/new" class="btn btn-default">Create now!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><em class="fa fa-fw fa-gift"></em> Free and open source</strong>
                    </div>
                    <div class="panel-body">
                        <p>As a grant-funded project, led by academics and federal employees, we want to openly share and develop this project, so we have built it in open-source code and offer it freely to anyone who wants to participate.</p>
                        <a href="https://github.com/MontanaBanana/unidescription.org" target="_blank" class="btn btn-default">Fork on Github!</a>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="row" style="background-color: #7a8f52">
            <div class="col-lg-12">
                <h2 class="page-header" style="color: white;">What can the UniD project do for you?</h2>
            </div>
            <div class="col-lg-1">&nbsp;</div>
            <div class="col-lg-10">
	            <p style="color: white;">Nulla justo arcu, lobortis et risus vel, imperdiet tristique nunc. Phasellus elementum erat id fringilla sodales. Nunc faucibus enim vel tempor placerat. Curabitur scelerisque sit amet ligula a semper. Suspendisse tincidunt faucibus facilisis. Donec quam erat, finibus et lorem et, imperdiet sodales sapien. Vivamus gravida, nisi eu volutpat congue, odio ex faucibus sapien, eu tincidunt mi mi et libero. Nunc ac quam ac nibh dignissim semper. Sed sit amet commodo lacus. Donec in ultrices risus. Vestibulum at mauris neque. Vestibulum metus neque, auctor ac fringilla eu, condimentum eu quam. Nam ut nunc consequat, mattis urna a, tristique quam. Vivamus auctor dignissim nisi in eleifend.</p><br />
            </div>
        </div>
        
        <div class="row" style="background-color: #f9f7f1">
            <div class="col-lg-12">
                <h2 class="page-header">About the UniD Project</h2>
            </div>
            <div class="col-lg-1">&nbsp;</div>
	        <div class="col-lg-10">	
	            <p>Nulla justo arcu, lobortis et risus vel, imperdiet tristique nunc. Phasellus elementum erat id fringilla sodales. Nunc faucibus enim vel tempor placerat. Curabitur scelerisque sit amet ligula a semper. Suspendisse tincidunt faucibus facilisis. Donec quam erat, finibus et lorem et, imperdiet sodales sapien. Vivamus gravida, nisi eu volutpat congue, odio ex faucibus sapien, eu tincidunt mi mi et libero. Nunc ac quam ac nibh dignissim semper. Sed sit amet commodo lacus. Donec in ultrices risus. Vestibulum at mauris neque. Vestibulum metus neque, auctor ac fringilla eu, condimentum eu quam. Nam ut nunc consequat, mattis urna a, tristique quam. Vivamus auctor dignissim nisi in eleifend.</p><br />
	        </div>
        </div>

        <!-- Portfolio Section -->
        <div class="row" style="background-color: #7a8f52">
            <div class="col-lg-12">
                <h2 class="page-header" style="color: white;">Featured Audio Descriptions</h2>
            </div>
            
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/washington_monument.jpg" alt="Arial view photo of the Washington Monument">
				<p style="color: white;">Washington Monument</p>
			</div>
			
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/golden_gate.jpg" alt="Photo of the Golden Gate Bridge">
				<p style="color: white;">Golden Gate</p>
			</div>
			
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/volcanoes.jpg" alt="Photo of a lava flow from Hawaii Volcanoes">
				<p style="color: white;">Hawaii Volcanoes</p>
			</div>
        </div>
        <!-- /.row -->

    </div>
@endsection

@section('js')
        <!-- Script to Activate the Carousel -->
	    <script type="text/javascript">
		    $( document ).ready(function() { 
			    $('.carousel').carousel({
			        interval: 5000 //changes the speed
			    })
	    	});
	    </script>
@endsection
