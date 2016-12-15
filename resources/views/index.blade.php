@extends('layouts.app')

@section('title', 'Home');

@section('content')

    <!-- Header Carousel -->
    
    <header>
	    <div class="centerpiece" style="background-image:url({{ SITEROOT }}/slideshow/ad_photo1-cropped.jpg)">
			<div style="padding-top: 25%;">
				<div class="getting-started" style="margin-left: 55%; width: 24%;">
					<p style="font-size: 22px;"><a href="{{ SITEROOT }}/auth/register">Create a free account</a><br />... AUDIO DESCRIBE THE WORLD</p>
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
                    <div class="panel-heading" style="font-size: 17px;">
                        <em style="font-size: 30px;" class="fa fa-fw fa-comment"></em> See something, give it voice:
                    </div>
                    <div class="panel-body">
                        <p>Translate our visual world into an audible one, helping to make it more accessible</p>
                        <a href="{{ SITEROOT }}/auth/login" class="btn btn-default">DESCRIBE NOW</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 17px;">
                        <img src="{{ SITEROOT }}/images/uh_logo_60x60.png" style="float: left; border: 0; top: -1px; position: relative;" height="34" /><span style="font-size: 34px;">&nbsp;</span>Free, open-source, and university-backed project
                    </div>
                    <div class="panel-body">
                        <p>This government-funded effort features research, community engagement and many public benefits </p>
                        <a href="{{ SITEROOT }}/about" class="btn btn-default">ABOUT US</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size: 17px;">
                        <em style="font-size: 30px; position: relative; top: 4px;" class="fa fa-fw fa-audio-description"></em> Embracing diversity, inclusion, and accessibility
                    </div>
                    <div class="panel-body">
                        <p>As a grant-funded project, led by academics and federal employees, we want to openly share and develop this project, so we have built it in open-source code and offer it freely to anyone who wants to participate.</p>
                        <a href="{{ SITEROOT }}/unid-academy" class="btn btn-default">LEARN MORE</a>
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
	            <p style="color: white;">Anything visual can be made more accessible through acoustic media, simply by having a sighted person thoughtfully describe its appearance. When audio description began, this process usually was just friend to friend, voice to ear. Emerging technologies, though, have expanded the possibilities. With our free web tool, anyone can create audio description about anything, including visual media and attractions (such as audio versions of photographs, illustrations, maps, paintings, sculptures, historical artifacts, architecture, natural landscapes, etc.). All you have to do is login and start describing the world you see. Then, let our tool create an audio file, web text, or mobile app for you to share with others.</p><br />
            </div>
        </div>

        <!-- Portfolio Section -->
        <div class="row" style="background-color: #f9f7f1">
            <div class="col-lg-12">
                <h2 class="page-header">Featured Audio Descriptions</h2>
            </div>
            
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/yellowstone_rainbow_pool_homepage.jpg" alt="Yellowstone Rainbow Pool">
				<p>Yellowstone National Park</p>
			</div>
			
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/sf_maritime_homepage.jpg" alt="Photo of a tall ship at SF Maritime national park">
				<p>San Francisco Maritime National Historical Park</p>
			</div>
			
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/denali_homepage.jpg" alt="Photo of Denali with a tourbus in the foreground">
				<p>Denali National Park and Preserve</p>
			</div>
        </div>
        <!-- /.row -->
        
        <div class="row" style="background-color: #7a8f52">
            <div class="col-lg-12">
                <h2 class="page-header" style="color: white;">About the UniD Project</h2>
            </div>
            <div class="col-lg-1">&nbsp;</div>
	        <div class="col-lg-10">	
                <p style="color: white;">The UniDescription project was designed as a research initiative with public benefits. We needed certain web tools to conduct our academic studies, so we thought we might as well design those for the greater good while we were at it. This site includes a UniD Academy, as a place for you to learn more about audio description and its best practices, as well as the unique UniD builder tool, which allows you to easily create and share audio description. More about this project can be found on the <a href="{{ SITEROOT }}/about" style="color: white; text-decoration: underline;">About Us</a> page. If you have specific questions or comments, please contact the principal investigator, <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank" style="color: white; text-decoration: underline;">Dr. Brett Oppegaard</a>, at University of Hawaii. 
</p><br />
	        </div>
        </div>

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
