@extends('layouts.app')

@section('title', 'About');

@section('content')

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">About
                    <small>UniDescription</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ SITEROOT }}/">Home</a>
                    </li>
                    <li class="active">About Unidescription</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive" src="{{ SITEROOT }}/images/haleakala-np-tech-user-and-map.jpg" alt="Haleakala - User and Map">
            </div>
            <div class="col-md-6">
                <h2>About The UniD Project:</h2>
                <p>The UniD (“UniDescription”) Project officially began in the fall of 2014, when principal investigator <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank">Dr. Brett Oppegaard</a> moved from <a href="https://www.wsu.edu" target="_blank">Washington State University</a> to <a href="https://www.hawaii.edu" target="_blank">University of Hawai‘i</a>. During this transition, he was working with Michele Hartley at <a href="http://www.nps.gov/hfc" target="_blank">Harpers Ferry Center</a> on <a href="http://www.nps.gov/hfc/accessibility" target="_blank">accessibility issues</a> related to printed <a href="http://www.nps.gov" target="_blank">National Park Service</a> products, such as the <a href="https://www.nps.gov/hfc/products/pubs/pubs-04a-c.cfm" target="_blank">“Unigrid” brochures</a>, and started envisioning the potential of mobile technologies to remediate and translate those static texts into acoustic forms. Once in <a href="https://en.wikipedia.org/wiki/Manoa" target="_blank">Manoa</a>, he began collaborating with two scholars who have spent their careers focused upon issues of accessibility, <a href="https://coe.hawaii.edu/directory/?person=mconway" target="_blank">Dr. Megan Conway</a> and <a href="https://coe.hawaii.edu/directory/?person=tconway" target="_blank">Tom Conway</a>, both serving in the UH <a href="https://www.cds.hawaii.edu/" target="_blank">Center on Disability Studies</a>. For a behind-the-scenes look at the process of developing this project, please see the <a href="https://npsaudiodescription.wordpress.com/" target="_blank">blog</a>.</p>


            </div>
        </div>
        <!-- /.row -->
        
	    <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <p>
	            	In the late 1970s, designer <a href="http://www.vignelli.com/intro.html" target="_blank">Massimo Vignelli</a> worked with Harpers Ferry Center staff to create the "<a href="http://www.nps.gov/parkhistory/online_books/brochures/unigrid/index.htm" target="_blank">Unigrid System</a>,"  upon which all National Park Service brochures since have been based. The self-described "information architect," who also designed the innovative <a href="http://www.designishistory.com/1960/massimo-vignelli/" target="_blank">New York subway map</a>, favored a modular system with a subtextual grid that facilitated order and consistency.
                </p>
                <p>
					Our web-based project – with direct connections to Harpers Ferry, the National Park Service, those brochures, and those basic beliefs – has been called UniD, in tribute. That name should be pronounced like "unity," serving as both an abbreviation of the more wonky original label of "unidescription" and as an inspiration for our mission: <br /><br />

					<strong>To bring unity to the world of audio description. </strong>
	
	                </br /><br />
                
					Audio description (often called verbal description) can be thought of as a medium equivalent to open and closed captioning, only for audiences that prefer information in acoustic rather than visual forms. In some cases, that involves the simple verbalization of a transcript (as in text-to-voice translation), but what we mostly are concerned with here is the more complex audiovisual translation of visual into audible material. For example, how would you describe an Ansel Adams photograph of a scene within Yellowstone National Park to a person who cannot see, or has low vision, or has difficulty interpreting print materials, or simply prefers information in audible forms? Those varied audiences (including people who are blind, with low-vision, print dyslexic, and audio-oriented) deserve full access to public discourse, and this project has been created to serve them, under the core principles of <a href="http://www.universaldesign.com/" target="_blank">Universal Design</a>.
                </p>
                <p>
					In turn, this UniD project has been developed to help people create more audio description and to be a robust resource for those interested in this topic, including "best practices" guidelines, updated scholarly research, and a forum for related thoughts and discussions. Our hope is that like the impact Vignelli's system had on NPS brochures, the UniD Project will bring higher clarity and quality to this acoustic communication form, especially in public spaces.
                </p>
            </div>   
	    </div>
	    
	    <div class="well">
		    <div class="row">
		        <div class="col-md-8">
		            <p>This federally funded project is free and open source. To start making your own audio description, <a href="{{ SITEROOT }}/auth/register">just create an account</a>, <a href="{{ SITEROOT }}/auth/login">sign in</a>, and follow the directions. </p>
		        </div>
		        <div class="col-md-4">
	                <?php if (Auth::check()): ?>	
			            <a class="btn btn-lg btn-default btn-block" href="{{ SITEROOT }}/account/project/details/0/new">Create now!</a>
					<?php else: ?>                    	
			            <a class="btn btn-lg btn-default btn-block" href="{{ SITEROOT }}/auth/register">Join now!</a>
			        <?php endif; ?>
		        </div>
		    </div>
	        <!-- /.row -->
	    </div>
	    
	    <hr>
	    

        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">About The UniD Project:</h2>
            </div>
            <div class="col-md-6">
                <p><strong>What can the UniD project do for you?</strong></p>
                <ul>
					<li>It can help you translate static visual media of any kind (texts, photographs, paintings, posters, statues, etc.) into audio content that can be freely shared</li>
					<li>It will convert text to speech (in an audio file format)</li>
					<li>It will help you manage multiple text-to-speech projects, which can be created around any type of audiovisual translation context, including the need to translate a static media source (such as a brochure), a grouping of artifacts (either by theme or location), or whatever other ways in which you might find it useful</li>
					<li>It provides templates for common audiovisual translation contexts</li>
					<li>It provides best practices and scholarly research related to audiovisual translation issues</li>
					<li>It includes a forum for discourse about audiovisual translation, including audio description, verbal description, and many of the other terms used for the similar process of verbally describing something visual and sharing that description with others</li>
					<li>It creates deliverables that are accessible in many ways; your audiovisual translation can be exported as text, audio files, or even mobile apps (in Android and iOS formats)</li>
					
                </ul>

            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="{{ SITEROOT }}/slideshow/sajja_koirala_hands.png" alt="Sajja Koirala hands on mobile device">
            </div>
        </div>
        <div class="row">
	        <div class="col-lg-12">
		        <ul style="top: -10px; position: relative;">
					<li>This is a grant-sponsored program (details about the collaborators in the About section), so all of this is offered to you for free – and its products created for free distribution – in the hopes of making the world a more accessible place to people of all abilities. </li>
				</ul>
                <p>
                	Our collaborators are listed, in detail, on the <a href="{{ SITEROOT }}/about">About</a> page, including contact information.
                </p>
                <p>
					For quick reference, though, the principal investigator on this project is: <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank">Dr. Brett Oppegaard</a> in the School of Communications in the College of Social Sciences at the University of Hawai‘i. 
				</p>
				<p>	
					All inquiries about this project should be directed to him, either <a href="mailto:brett.oppegaard@gmail.com">by email</a> or <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu">phone</a>
				</p>
				<p>
					More behind-the-scenes: Our regularly updated blog about this project also is available on <a href="https://npsaudiodescription.wordpress.com/" target="_blank">our blog</a>.
				</p>
	        </div>
        </div>
        <!-- /.row -->

		<hr>

        <!-- The Team -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">The Team</h2>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <a href="https://manoa.hawaii.edu/" target="_blank"><img class="img-responsive" src="{{ SITEROOT }}/images/uh_logo.jpg" alt="University of Hawaii Logo"></a>
                    <div class="caption" style="height: 352px;">
                        <h3>University of Hawai‘i at Manoa<br>
                            <small>Collaborator</small>
                        </h3>
                        <p>A transdisciplinary collaboration between the School of Communications and the Center on Disability Studies</p>
                    </div>
                   <ul class="list-inline">
                        <li><a href="https://www.facebook.com/uhmanoa/" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/university-of-hawaii" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/uhmanoa" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <a href="http://www.nps.gov" target="_blank"><img class="img-responsive" src="{{ SITEROOT }}/images/nps_square_logo.png" alt="National Park Service Logo"></a>
                    <div class="caption" style="height: 352px;">
                        <h3>National Park Service<br>
                            <small>Collaborator</small>
                        </h3>
                        <p>Including Harpers Ferry Center, the design hub of the bureau, and park sites nationwide</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/nationalparkservice" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/national-park-service" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/NatlParkService" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <a href="http://hilo.hawaii.edu/hpicesu/" target="_blank"><img class="img-responsive" src="{{ SITEROOT }}/images/hpi_cesu_logo.jpg" alt="HPI CESU Logo"></a>
                    <div class="caption" style="height: 352px;">
                        <h3>The Hawaii-Pacific Islands Cooperative Ecosystem Studies Unit <br>
                            <small>Collaborator</small>
                        </h3>
                        <p>A coalition of governmental agencies, non-governmental organizations and universities, promoting research within the Pacific region</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <a href="http://www.montanab.com/" target="_blank"><img class="img-responsive" src="{{ SITEROOT }}/images/mb_logo.png" alt="Montana Banana Logo"></a>
                    <div class="caption" style="height: 352px;">
                        <h3>Montana Banana<br>
                            <small>Developer</small>
                        </h3>
                        <p>Seattle-based web and mobile app development company</p>
                    </div>
	                <ul class="list-inline">
                        <li><a href="https://www.facebook.com/montanabweb/" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/montana-banana-web-design-&-development" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/montanabweb" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- List of people involved -->
        <div class="row">
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/brett-oppegaard.jpg" alt="Brett Oppegaard's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Brett Oppegaard<br>
                            <small>Principal Investigator</small>
                        </h4>
                        <p>An Assistant Professor in the UH School of Communications</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/brettoppegaard" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/megan-conway.jpg" alt="Megan Conway's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Megan Conway<br>
                            <small>Co-PI</small>
                        </h4>
                        <p>An Assistant Professor in the UH Center on Disability Studies</p>
                    </div>
                   <ul class="list-inline">
                        <li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#" title="LinkedIN"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/thomas-conway.jpg" alt="Thomas Conway's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Thomas Conway<br>
                            <small>Co-PI</small>
                        </h4>
                        <p>Media Coordinator in the UH Center on Disability Studies</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/michele-hartley.jpg" alt="Michele Hartley's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Michele Hartley<br>
                            <small>NPS Liaison</small>
                        </h4>
                        <p>Media accessibility coordinator at Harpers Ferry Center</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
		</div>
		<div class="row">
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/joe-oppegaard.png" alt="Joe Oppegaard's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Joe Oppegaard<br>
                            <small>Chief Technology Officer</small>
                        </h4>
                        <p>Montana Banana</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/montanabweb/" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/in/joe-oppegaard-38957811" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/JoeOppegaard" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/jason-mug-shot.jpg" alt="Jason Kenison's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Jason Kenison<br>
                            <small>Senior Programmer</small>
                        </h4>
                        <p>Montana Banana</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/montanabweb/" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/in/jasonkenison" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/jasonkenison" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="/images/team/tuyet-hayes.jpg" alt="Tuyet Hayes's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Tuyet Hayes<br>
                            <small>Research Assistant</small>
                        </h4>
						<p>University of Hawai‘i</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="/images/team/phil-jordan.jpg" alt="Philipp Jordan's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Philipp Jordan<br>
                            <small>Research Assistant</small>
                        </h4>
                        <p>University of Hawai‘i</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        
        <div class="row">
	        <div class="col-lg-12">
		        <p><strong>Additional contributions by:</strong> Sean Zdenek (Texas Tech University) and Marsha Matta (graphic designer)</p>
	        </div>
        </div>

        <!-- Our Customers -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Research Partners</h2>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <img class="img-responsive customer-img" src="{{ SITEROOT }}/images/washington_monument.jpg" alt="Washington Monument photo from the air">
                <p>Washington Monument</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <img class="img-responsive customer-img" src="{{ SITEROOT }}/images/golden_gate.jpg" alt="Golden Gate photo from the distance">
                <p>Golden Gate</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <img class="img-responsive customer-img" src="{{ SITEROOT }}/images/volcanoes.jpg" alt="Lava aerial view">
                <p>Hawaii Volcanoes</p>
            </div>
        </div>
        <!-- /.row -->

        <hr>
        
@endsection
