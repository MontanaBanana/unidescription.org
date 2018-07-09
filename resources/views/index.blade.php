@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Header Carousel -->
    <header style="background-image:url({{ SITEROOT }}/slideshow/joe_parthenon.jpg)" title="The UniDescription Project's mantra is to 'audio describe the world,' and this image shows UniD developer Joe Oppegaard at the base of the Acropolis in Athens, Greece, testing the UniD system. Joe is wearing a black shirt and dark sunglasses, contrasting with his blond hair and white earbuds, which are connected to his smartphone, as he listens to content on the phone underneath the massive marble columns at the remains of the Parthenon. The UniD Project team has worked with the University of Piraeus in Athens to audio describe parts of the Acropolis as well as various other major public attractions around the world, including more than 50 U.S. National Park Service sites.">
		<div class="container centerpiece">
<!--
			<div class="slide">
				<p class="tagline" id="tagline">Audio Describe the World</p>
				<p class="button"><a id="tagline-learn-more" aria-labelledby="tagline tagline-learn-more" href="{{ SITEROOT }}/auth/register">Learn More</a></p>
			</div>
-->
		</div>
	</header>
        <div width="100%" style="background: black; height: 80px;" class="slide">
            <div style="float: left;"><p class="tagline" id="tagline">Audio Describe the World</p></div>
            <div style="float: right; padding-top: 20px; padding-right: 5px;"><p class="button"><a id="tagline-learn-more" aria-labelledby="tagline tagline-learn-more" href="{{ SITEROOT }}/auth/register">Get Started</a></p></div>
        </div>

    <!-- Page Content -->
	<div class="row blade introduction" style="clear: both;">
		<div class="container">
			<div class="col-lg-12">
				<h1 class="page-header">
					<center><strong>The UniD Project</strong></center>
				</h1>
                <h2><center><strong>To Create Digital Audio Spaces and More Accessible Places</strong></center></h2>
			</div>
		</div>
	</div>
	
	<!-- Call to Action Section -->
	<div class="row blade home-boxes">
		<div class="container">		 
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading heading-single-line">
						See something, give it voice
					</div>
					<div class="panel-body">
						<p>Translate our visual world into an audible one, helping to make it more accessible</p>
						<a href="{{ SITEROOT }}/auth/login" class="btn btn-primary">Get Started</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Free, open-source, and<br/>university-backed
					</div>
					<div class="panel-body">
						<p>This government-funded effort features research, community engagement, and many public benefits </p>
						<a href="{{ SITEROOT }}/research" class="btn btn-primary">LEARN MORE</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Embracing diversity, inclusion, and accessibility
					</div>
					<div class="panel-body">
						<!--<p>As a grant-funded project, led by academics and federal employees, we want to openly share and develop this project, so we have built it in open-source code and offer it freely to anyone who wants to participate.</p>-->
                        <p>This project has included stakeholders who are blind and visually impaired at each and every design phase</p>
						<a href="{{ SITEROOT }}/about" class="btn btn-primary">ABOUT US</a>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="row blade green below-home-boxes">
		<div class="container">
			<div class="col-lg-12">
				<h2 class="page-header">What can the UniD project do for you?</h2>
			</div>
			<div class="col-lg-12">
				<p>Anything visual can be made more accessible through acoustic media, simply by having a sighted person thoughtfully describe its appearance. When audio description began, this process usually was just friend to friend, voice to ear. Emerging technologies, though, have expanded the possibilities. With our free web tool, anyone can create audio description about anything, including visual media and attractions (such as audio versions of photographs, illustrations, maps, paintings, sculptures, historical artifacts, architecture, natural landscapes, etc.). All you have to do is login and start describing the world you see. Then, let our tool create an audio file, web text, or mobile app for you to share with others.</p><br />
			</div>
		</div>
	</div>
	
	<!-- Portfolio Section -->
	<div class="row blade">
		<div class="container">
			<div class="col-lg-12">
				<h2 class="page-header">Featured Audio Descriptions</h2>
			</div>
			
			<div class="col-lg-6 col-md-6 featured-project-thumbnail">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 171 183" style="enable-background:new 0 0 171 183;" xml:space="preserve" class="phone-with-headphones" alt="">
					
					<defs>
						<pattern id="img1" patternUnits="userSpaceOnUse" width="200" height="200">
							<image xlink:href="{{ SITEROOT }}/images/yellowstone_rainbow_pool_homepage.jpg" x="0" y="0" width="200" height="200" />
						</pattern>
						<pattern id="img2" patternUnits="userSpaceOnUse" width="200" height="200">
                            <image xlink:href="{{ SITEROOT }}/images/projects/76.jpeg" x="0" y="0" width="200" height="200" />
						</pattern>
						<pattern id="img3" patternUnits="userSpaceOnUse" width="200" height="200">
							<image xlink:href="{{ SITEROOT }}/images/yosemite_camping_homepage.jpg" x="0" y="0" width="200" height="200" />
						</pattern>
					</defs>

					<path d="M113.7,48.5H59c-3.3,0-6,2.7-6,6v109.2c0,3.3,2.7,6,6,6h54.7c3.3,0,6-2.7,6-6V54.5C119.7,51.2,117,48.5,113.7,48.5z
						 M75.3,53.1c0-0.6,0.4-1,1-1h20.1c0.6,0,1,0.4,1,1v1.6c0,0.6-0.4,1-1,1H76.3c-0.6,0-1-0.4-1-1V53.1z M96.8,163.1c0,0.6-0.4,1-1,1H77
						c-0.6,0-1-0.4-1-1v-2.2c0-0.6,0.4-1,1-1h18.8c0.6,0,1,0.4,1,1V163.1z M116.6,155.3H56.2c-0.6,0-1-0.4-1-1V59.5c0-0.6,0.4-1,1-1h60.4
						c0.6,0,1,0.4,1,1v94.8C117.6,154.9,117.2,155.3,116.6,155.3z"/>
					<path d="M138.2,135.4L138.2,135.4c-3.4,0-6.2-2.8-6.2-6.2V87c0-3.4,2.8-6.2,6.2-6.2l0,0c3.4,0,6.2,2.8,6.2,6.2v42.2
						C144.4,132.6,141.6,135.4,138.2,135.4z"/>
					<path d="M145.6,87.5h2.2v22.3h6.9V89.3c2.2,1.7,3.5,4.3,3.5,7.1v23.4c0,5-4,9-9,9h-3.9V87.5H145.6z"/>
					<path d="M146.9,74.8h6c0.3,0,0.6,0.3,0.6,0.6v33.3H149V86.1h-2c-0.3,0-0.6-0.3-0.6-0.6v-10C146.4,75.2,146.6,74.9,146.9,74.8z"/>
					<path d="M34.5,80.8L34.5,80.8c3.4,0,6.2,2.8,6.2,6.2v42.2c0,3.4-2.8,6.2-6.2,6.2l0,0c-3.4,0-6.2-2.8-6.2-6.2V87
						C28.3,83.6,31.1,80.8,34.5,80.8z"/>
					<path d="M27,87.5h-2.2v22.3h-6.9V89.3c-2.2,1.7-3.5,4.3-3.5,7.1v23.4c0,5,4,9,9,9h3.9V87.5H27z"/>
					<path d="M25.7,74.8h-6c-0.3,0-0.6,0.3-0.6,0.6l0,0v33.3h4.6V86.1h2c0.3,0,0.6-0.3,0.6-0.6l0,0v-10C26.3,75.2,26.1,74.9,25.7,74.8
						C25.7,74.9,25.7,74.9,25.7,74.8z"/>
					<path d="M149,80.9c-0.3-1.3-0.4-2.7-0.4-4c0-7.5-1.4-14.9-4-21.9c-0.5-1.4,0.6-2.7,1.6-3.9C136,27.2,112.4,11.7,86.4,11.7h-0.1l0,0
						l0,0c-26,0-49.6,15.5-59.9,39.4c1.1,1.3,2.2,2.6,1.6,3.9c-2.6,7-4,14.4-4,21.8c0,1.3-0.1,2.7-0.4,4h2.8c-0.1-1.3-0.1-2.6-0.1-4
						c0-33.1,26.9-60,60-60h0.2c33.1,0,60,26.9,60,60c0,1.4,0,2.7-0.1,4L149,80.9L149,80.9z"/>
					<path class="st0" d="M116.6,155.3H56.2c-0.6,0-1-0.4-1-1V59.5c0-0.6,0.4-1,1-1h60.4c0.6,0,1,0.4,1,1v94.8
						C117.6,154.9,117.2,155.3,116.6,155.3z"/>
				</svg>
			</div>
			<div class="col-lg-6 col-md-6">	
				<ul class="featured-projects">
					<li class="selected" data-ref="img1" data-image="{{ SITEROOT }}/images/yellowstone_rainbow_pool_homepage.jpg">
						<a href="/account/project/export/91" target="_blank"><h3>Yellowstone National Park</h3></a>
						<p>Visit Yellowstone and experience the world's first national park. Marvel at a volcano’s hidden power rising up in colorful hot springs, mudpots, and geysers.</p>
					</li>
					<li data-ref="img2" data-image="{{ SITEROOT }}/images/projects/76.jpeg">
						<a href="/account/project/export/76" target="_blank"><h3>Golden Gate National Recreation Area</h3></a>
                        <p>Stretched across 80,000 acres north and south of the Golden Gate Bridge, these parks also constitute one of the world’s largest national parks in an urban setting.</p>
					</li>
<!--
					<li data-ref="img2" data-image="{{ SITEROOT }}/images/sf_maritime_homepage.jpg">
						<a href="/account/project/export/123" target="_blank"><h3>Harry S Truman National Historic Site</h3></a>
						<p>President Harry S Truman took America from its traditional isolationism into the age of international involvement. Despite his power, he never forgot where he came from.</p>
					</li>
-->
<!--
					<li data-ref="img3" data-image="{{ SITEROOT }}/images/denali_homepage.jpg">
						<a href="/account/project/export/101" target="_blank"><h3>Denali National Park and Preserve</h3></a>
						<p>Denali is six million acres of wild land, bisected by one ribbon of road. Wild animals large and small roam un-fenced lands, living as they have for ages. Solitude, tranquility and wilderness await.</p>
					</li>
-->
					<li data-ref="img3" data-image="{{ SITEROOT }}/images/yosemite_camping_homepage.jpg">
						<a href="/account/project/export/266" target="_blank"><h3>Yosemite National Park</h3></a>
                        <p>Not just a great valley, but a shrine to human foresight, the strength of granite, the power of glaciers, the persistence of life, and the tranquility of the High Sierra. </p>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /.row -->
        
	<!-- About Section -->
	<div class="row blade gray">
		<div class="container">
			<div class="col-lg-12">
				<h2 class="page-header">About the UniD Project</h2>
			</div>
			<div class="col-lg-6 col-md-6">
				<img src="{{ SITEROOT }}/images/acb_members_enter_muir_woods.jpg" alt="Photo showing members of the Silicon Valley and San Francisco chapters of the American Council of the Blind field testing the UniD app at Muir Woods National Monument in April 2018. A group of about a dozen people, with three guide dogs in tow, are shown entering the park, with their backs to the camera, underneath an aged and wooden Muir Woods sign that is hung over the middle of an entryway gate. Photo courtesy of: The National Park Service." class="photo" />
                    <p class="caption">
Members of the Silicon Valley and San Francisco chapters of the American Council of the Blind field tested the UniD app at Muir Woods National Monument in April 2018.<br/>Photo courtesy of: Alison Taggart-Barone/NPS.
                    </p>
			</div>
			<div class="col-lg-6 col-md-6">	
				<p>The UniDescription project was designed as a research initiative with public benefits. We needed certain web tools to conduct our academic studies, so we thought we might as well design those for the greater good while we were at it. This site includes a UniD Academy, as a place for you to learn more about audio description and its best practices, as well as the unique UniD builder tool, which allows you to easily create and share audio description. More about this project can be found on the <a href="{{ SITEROOT }}/about" style="color: white; text-decoration: underline;">About Us</a> page. If you have specific questions or comments, please contact the principal investigator, <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank" style="color: white; text-decoration: underline;">Dr. Brett Oppegaard</a>, at University of Hawai‘i.</p><br />
			</div>
		</div>
	</div>
	<!-- /.row -->
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
