@extends('layouts.app')

@section('title', 'About')

@section('content')

		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="container">	
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
		</div>
		<!-- /.row -->

		<!-- Intro Content -->
		<div class="row blade">
			<div class="container">	
				<div class="col-md-12">
                    <h2 class="page-header" style="top: -70px; position: relative;">About the UniD Project:</h2>
                    <div style="position: relative; top: -70px;">
                        <center><iframe width="560" height="315" src="https://www.youtube.com/embed/nxbgvqkWLh0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></center>
                        <br /><center style="font-size: 24px;">UniD: Our backstory, our mission, and our plans for future development</center><br />
					<!--<img class="photo" src="{{ SITEROOT }}/images/haleakala-np-tech-user-and-map.jpg" alt="Haleakala - User and Map">
                    <p class="caption">UniD researcher Megan Conway, from UH, who is visually and hearing impaired, has made many national park site visits, examining and assessing media accessibility, including this recent visit to Haleakalā National Park on Maui in Hawaii.</p>-->
					
                        <div style="float: right; align: right; width: 660px; margin-left: 15px;"><img class="photo" src="{{ SITEROOT }}/images/conference-room.jpg" alt="Conference room at Harpers Ferry"> <p class="caption">Some of the Unid research team members in Harpers Ferry Center, W.V., in September 2016, working on the National Park Service's first "Descriptathon," an event that brought together parks from throughout the country to audio describe their brochures. Clockwise, from the far right, is principal investigator Brett Oppegaard, research assistant Phil Jordan, web developer Joe Oppegaard, and NPS Media Accessibility Coordinator Michele Hartley.</p></div>
						<p>The UniD (“UniDescription”) Project officially began in the fall of 2014, when principal investigator <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank">Dr. Brett Oppegaard</a> moved from <a href="https://www.wsu.edu" target="_blank">Washington State University</a> to <a href="https://www.hawaii.edu" target="_blank">University of Hawai‘i</a>. During this transition, he was working with Michele Hartley at <a href="http://www.nps.gov/hfc" target="_blank">Harpers Ferry Center</a> on <a href="http://www.nps.gov/hfc/accessibility" target="_blank">accessibility issues</a> related to printed <a href="http://www.nps.gov" target="_blank">National Park Service</a> products, such as the <a href="https://www.nps.gov/hfc/products/pubs/pubs-04a-c.cfm" target="_blank">“Unigrid” brochures</a>, and started envisioning the potential of mobile technologies to remediate and translate those static texts into acoustic forms. Once in <a href="https://en.wikipedia.org/wiki/Manoa" target="_blank">Manoa</a>, he began collaborating with two scholars who have spent their careers focused upon issues of accessibility, <a href="https://coe.hawaii.edu/directory/?person=mconway" target="_blank">Dr. Megan Conway</a> and <a href="https://coe.hawaii.edu/directory/?person=tconway" target="_blank">Dr. Thomas Conway</a>, both serving in the UH <a href="https://www.cds.hawaii.edu/" target="_blank">Center on Disability Studies</a>. For a behind-the-scenes look at the process of developing this project, please see the <a href="https://npsaudiodescription.wordpress.com/" target="_blank">blog</a>.</p>
						<p>For a bit of additional background, in the late 1970s, designer <a href="http://www.vignelli.com/intro.html" target="_blank">Massimo Vignelli</a> worked with Harpers Ferry Center staff to create the "<a href="http://www.nps.gov/parkhistory/online_books/brochures/unigrid/index.htm" target="_blank">Unigrid System</a>,"  upon which all National Park Service brochures since have been based. The self-described "information architect," who also designed the innovative <a href="http://www.designishistory.com/1960/massimo-vignelli/" target="_blank">New York subway map</a>, favored a modular system with a subtextual grid that facilitated order and consistency.</p>
						<p>Our web-based project – with direct connections to Harpers Ferry Center, the National Park Service, those brochures, and those basic beliefs – has been called UniD, in tribute. That name should be pronounced like "unity," serving as both an abbreviation of the more wonky original label of "unidescription" and as an inspiration for our mission:</p>
						<blockquote>To bring unity to the world of audio description. </blockquote>
                        <div style="float: right; align: right; width: 400px; margin-left: 15px;"><img class="photo"src="{{ SITEROOT }}/images/phil-at-map.jpg" style="width: 400px;" alt="Philipp Jordan -- a German graduate student at the University of Hawaii, dressed in jeans and a black t-shirt -- stands to the left of a tactile table-top map showing the Monocacy National Battlefield in the Frederick, MD, visitors center. He is looking down at the map and its details. " /><p class="caption">Translating a map from a visual experience to an acoustic experience has been one of the most complicated challenges of the UniD project. As part of our research, UH Communication and Information Science Ph.D. student, and Unid research assistant, Philipp Jordan went to Monocacy National Battlefield in Frederick, MD, to examine and experiment with the sights and sounds of its three-dimensional, fiber-optic map, which also included a soundtrack and closed captioning.</p></div>
                        <p>Audio description (often called verbal description) can be thought of as a medium equivalent to open and closed captioning, only for audiences that need or want information in acoustic rather than visual forms. In some cases, that involves the simple verbalization of a transcript (as in text-to-voice translation), but what we mostly are concerned with here is the more complex audiovisual translation of visual into audible information, in particular, the organization and expression of complicated collages of visual media into an unavoidably more linear format without compromising the rich and dynamic experience visuals often present in the original format. For example, how would you describe an Ansel Adams photograph of a scene within Yellowstone National Park to a person who cannot see, or has low vision, or has difficulty interpreting print materials, or simply prefers information in audible forms? Those varied audiences (including people who are blind, with low-vision, print dyslexic, and audio-oriented) deserve full access to public discourse, and this project has been created to serve them.</p>
						<p>In turn, this UniD project has been developed to help people create more audio description and to be a robust resource for those interested in this topic, including "best practices" guidelines, updated scholarly research, and a forum for related thoughts and discussions. Our hope is that like the impact Vignelli's system had on NPS brochures, the UniD Project will bring higher clarity and quality to this acoustic communication form, especially in public spaces.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		
		<!-- Join Now Section -->
		<div class="row blade green">
			<div class="container">	
				<div class="col-md-8">
					<p>This federally funded project is free and open source. To start making your own audio description, <a href="{{ SITEROOT }}/auth/register">just create an account</a>, <a href="{{ SITEROOT }}/auth/login">sign in</a>, and follow the directions. </p>
				</div>
				<div class="col-md-4">
					<?php if (Auth::check()): ?>	
						<a class="btn btn-lg btn-primary btn-block btn-big" href="{{ SITEROOT }}/account/project/details/0/new">Create now!</a>
					<?php else: ?>						
						<a class="btn btn-lg btn-primary btn-block btn-big" href="{{ SITEROOT }}/auth/register">Free Account</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- /.row -->
		
		<!-- Features Section -->
		<div class="row blade">
			<div class="container">
				<div class="col-lg-12">
					<h2 class="page-header">What can the UniD project do for you?</h2>
				</div>
				<div class="col-md-6">
					<div>
						<ul>
							<li>It can help you translate static visual media of any kind (texts, photographs, paintings, posters, statues, etc.) into audio content that can be freely shared</li>
							<li>It will convert text to speech (in an audio file format)</li>
							<li>It will help you manage multiple text-to-speech projects, which can be created around any type of audiovisual translation context, including the need to translate a static media source (such as a brochure), a grouping of artifacts (either by theme or location), or whatever other ways in which you might find it useful</li>
							<li>It provides templates for common audiovisual translation contexts</li>
							<li>It provides best practices and scholarly research related to audiovisual translation issues</li>
							<li>It includes a forum for discourse about audiovisual translation, including audio description, verbal description, and many of the other terms used for the similar process of verbally describing something visual and sharing that description with others</li>
							<li>It creates deliverables that are accessible in many ways; your audiovisual translation can be exported as text, audio files, or even mobile apps (in Android and iOS formats)</li>
							<li>This is a grant-sponsored program, so all of this is offered to you for free – and its products created for free distribution – in the hopes of making the world a more accessible place to people of all abilities. </li>
							
						</ul>
						<p>
							The principal investigator on this project is: <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank">Dr. Brett Oppegaard</a> in the School of Communications in the College of Social Sciences at the University of Hawai‘i. 
						</p>
						<p>	
							All inquiries about this project should be directed to him, either <a href="mailto:brett.oppegaard@gmail.com">by email</a> or <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu">phone</a>
						</p>
					</div>
				</div>
				<div class="col-md-6">
					<img class="photo" src="{{ SITEROOT }}/images/sushil_at_lincoln_memorial.jpg" alt="Sushil at the Lincoln Memorial">
					<p class="caption">During their fall 2016 visit to the Lincoln Memorial, Sushil Adhikari, from Nepal (right), and Nang Attal, from Afghanistan, discovered there was no audio description available at the site. So, Attal read the wall text to Adhikari and did his best to describe the surroundings. The UniD project is intended to help visitors, like Adhikari, who are blind or visually impaired, have equivalent experiences, vetted by park staff, which allow more people to participate fully in important societal and cultural discussions.</p>
				</div>
			</div>
		</div>
		<!-- /.row -->

		<!-- Accessibility Standards we use -->
		<div class="row blade green">
			<div class="container">	
                <div class="col-lg-12">
                    <h2 class="page-header">Accessibility Standards We Use</h2>
                </div>
				<div class="col-md-6">
<p>The UniDescription Project is committed to ensuring the accessibility of its web and mobile-app content to people with disabilities. All of the content on our website and in our mobile apps meets the World Wide Web Consortium Web Accessibility Initiative - W3C WAI's <a href="https://www.w3.org/TR/WCAG/" target="_blank">Web Content Accessibility Guidelines</a> 2.0, Level AA conformance.</p>

<p>The UniDescription Project reviews its web content policy once a year (in December) to ensure it is up-to-date and reflects the latest standards as directed by the W3C. At that time, we also conduct a review of our content to ensure adherence to those standards. This includes a review of the mobile applications linked to the <a href="http://www.unidescription.org/" target="_blank">www.UniDescription.org website</a> and promoted by the project for use in delivering audio description for blind and visually impaired users.</p>

<p>We try our best to catch any mistakes, but if we missed something, please let us know via email at: <a href="mailto:brett.oppegaard@hawaii.edu">brett.oppegaard@hawaii.edu</a>. </p>

<p>The UniDescription Project was last reviewed Jan. 1, 2018.</p>

				</div>

                <div class="col-md-6">
<img src="{{ SITEROOT }}/images/acb_member_testing_unid_app.jpg" alt="Photo showing an ACB member testing our UniD app at Muir Woods. That member is a middle-aged woman, with long-brown hair, wearing a bright pink sweater, holding a smartphone close to her ear and concentrating on what she's hearing. Courtesy of: The National Park Service." class="photo" />
                    <p class="caption">
An ACB member tests our UniD app at Muir Woods.<br/>Courtesy of: Alison Taggart-Barone/NPS.
                    </p>
                </div>
			</div>
		</div>
		<!-- /.row -->
		
		<!-- The Team -->
		<div class="row blade gray the-team">
			<div class="container">	
				<div class="col-lg-12">
					<h2 class="page-header">The Team</h2>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail tall">
						<a href="https://manoa.hawaii.edu/" target="_blank"><img class="img-responsive img-logo" src="{{ SITEROOT }}/images/uh_logo.jpg" alt="University of Hawaii Logo"></a>
						<div class="caption">
							<h4>University of Hawai‘i at Manoa</h4>
							<h5>Collaborator</h5>
						</div>
						<p>A transdisciplinary collaboration between the School of Communications and the Center on Disability Studies</p>
						<!--
					   <ul class="list-inline">
							<li><a href="https://www.facebook.com/uhmanoa/" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="https://www.linkedin.com/company/university-of-hawaii" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="https://twitter.com/uhmanoa" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail tall">
						<a href="http://www.nps.gov" target="_blank"><img class="img-responsive img-logo" src="{{ SITEROOT }}/images/nps_square_logo.png" alt="National Park Service Logo"></a>
						<div class="caption">
							<h4>National Park Service</h4>
							<h5>Collaborator</h5>
						</div>
						<p>Including Harpers Ferry Center, the design hub of the bureau, and park sites nationwide</p>
						<!--
						<ul class="list-inline">
							<li><a href="https://www.facebook.com/nationalparkservice" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="https://www.linkedin.com/company/national-park-service" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="https://twitter.com/NatlParkService" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail tall">
						<a href="http://hilo.hawaii.edu/hpicesu/" target="_blank"><img class="img-responsive img-logo" src="{{ SITEROOT }}/images/hpi_cesu_logo.jpg" alt="HPI CESU Logo"></a>
						<div class="caption">
							<h4>The Hawaii-Pacific Islands Cooperative Ecosystem Studies Unit</h4>
							<!--<h5>Collaborator</h5>-->
						</div>
						<p>A coalition of governmental agencies, non-governmental organizations and universities, promoting research within the Pacific region</p>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail tall">
						<a href="http://www.montanab.com/" target="_blank"><img class="img-responsive img-logo" src="{{ SITEROOT }}/images/mb_logo.png" alt="Montana Banana Logo"></a>
						<div class="caption">
							<h4>Montana Banana</h4>
							<h5>Developer</h5>
						</div>
						<p>Seattle-based web and mobile app development company</p>
						<!--
						<ul class="list-inline">
							<li><a href="https://www.facebook.com/montanabweb/" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="https://www.linkedin.com/company/montana-banana-web-design-&-development" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="https://twitter.com/montanabweb" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
		
				<!-- List of people involved -->
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<a href="http://www.google.com/" target="_blank"><img class="img-responsive img-logo" src="{{ SITEROOT }}/images/google_logo.png" alt="Google logo"></a>
						<div class="caption" style="height: 165px;">
							<h4>Google</h4>
							<h5>Collaborator</h5>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2017 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<a href="http://acb.org" target="_blank"><img class="img-responsive img-logo" src="{{ SITEROOT }}/images/acb.png" alt="American Council of the Blind Logo"></a>
						<div class="caption" style="height: 165px;">
							<h4>American Council of the Blind</h4>
							<h5>Collaborator</h5>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2017 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="{{ SITEROOT }}/images/team/brett-oppegaard.jpg" alt="Brett Oppegaard's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Brett Oppegaard</h4>
							<h5>Principal Investigator</h5>
							<p>An Associate Professor in the UH School of Communications</p>
						</div>
						<!--
						<ul class="list-inline">
							<li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="https://twitter.com/brettoppegaard" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="{{ SITEROOT }}/images/team/megan-conway.jpg" alt="Megan Conway's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Megan Conway</h4>
							<h5>Co-PI</h5>
							<p>An Assistant Professor in the UH Center on Disability Studies</p>
						</div>
						<!--
					   <ul class="list-inline">
							<li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="#" title="LinkedIN"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="{{ SITEROOT }}/images/team/thomas-conway.jpg" alt="Thomas Conway's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Thomas Conway</h4>
							<h5>Co-PI</h5>
							<p>Media Coordinator in the UH Center on Disability Studies</p>
						</div>
						<!--
						<ul class="list-inline">
							<li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="{{ SITEROOT }}/images/team/michele-hartley.jpg" alt="Michele Hartley's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Michele Hartley</h4>
							<h5>NPS Liaison</h5>
							<p>Media accessibility coordinator at Harpers Ferry Center, WV</p>
						</div>
						<!--
						<ul class="list-inline">
							<li><a href="#" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="#" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="#" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
					
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="{{ SITEROOT }}/images/team/joe-oppegaard.png" alt="Joe Oppegaard's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Joe Oppegaard</h4>
							<h5>Chief Technology Officer</h5>
							<p>Montana Banana<br />Seattle, WA</p>
						</div>
						<!--
						<ul class="list-inline">
							<li><a href="https://www.facebook.com/montanabweb/" target="_blank" title="Facebook"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="https://www.linkedin.com/in/joe-oppegaard-38957811" target="_blank" title="LinkedIn"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="https://twitter.com/JoeOppegaard" target="_blank" title="Twitter"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="{{ SITEROOT }}/images/team/jason-mug-shot.jpg" alt="Jason Kenison's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Jason Kenison</h4>
							<h5>Senior Programmer</h5>
							<p>Montana Banana<br />Seattle, WA</p>
						</div>
						<!--
						<ul class="list-inline">
							<li><a href="https://www.facebook.com/montanabweb/" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
							</li>
							<li><a href="https://www.linkedin.com/in/jasonkenison" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>
							</li>
							<li><a href="https://twitter.com/jasonkenison" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
							</li>
						</ul>
						-->
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2014 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/tuyet-hayes.jpg" alt="Tuyet Hayes's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Tuyet Hayes</h4>
							<h5>Research Assistant</h5>
							<p>University of Hawai‘i<br />Honolulu, HI</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2016 - 2018</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/phil-jordan.jpg" alt="Philipp Jordan's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Philipp Jordan</h4>
							<h5>Research Assistant</h5>
							<p>University of Hawai‘i<br />Honolulu, HI</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2016 - 2018</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/sina.jpg" alt="Sina Bahram's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Sina Bahram</h4>
							<h5>Consultant</h5>
                            <p>Prime Access Consulting, NC</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 117px;">2017</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/annie.jpg" alt="Annie Leist's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Annie Leist</h4>
							<h5>Consultant</h5>
                            <p>Art Beyond Sight, NY</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 117px;">2017</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/sajja.png" alt="Sajja Koirala's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Sajja Koirala</h4>
							<h5>Research Assistant</h5>
							<p>University of Hawai‘i<br />Honolulu, HI</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 90px;">2017 - Present</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/terence.png" alt="Terence Rose's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Terence Rose</h4>
							<h5>Research Assistant</h5>
							<p>University of Hawai‘i<br />Honolulu, HI</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 117px;">2017</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/zdenek_mug.png" alt="Sean Zdenek's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Sean Zdenek</h4>
							<p>Texas Tech University<br />Lubbock, TX</p>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 117px;">2014</small>
				</div>
				<div class="col-md-3 text-center">
					<div class="thumbnail">
						<img class="img-responsive img-person" src="/images/team/matta_mug.png" alt="Marsha Matta's bio photo">
						<div class="caption" style="height: 165px;">
							<h4>Marsha Matta</h4>
							<h5>Graphic Designer</h5>
						</div>
					</div>
                    <small style="font-style: italic; position: absolute; bottom: 30px; margin: auto; color: black; left: 117px;">2014</small>
				</div>
			</div>
		</div>
		<!-- /.row -->


		<div class="row blade">
			<div class="container">
				<div class="col-lg-12">
					<h2 class="page-header">Media Coverage</h2>
				</div>
				<div class="col-md-6">
                    <a style="font-size: 20px;" href="http://www.afb.org/afbpress/pubnew.asp?DocID=aw190303" target="_blank">The UniDescription Project: Seeking to Bring Unity to the World of Audio Description, March 2018</a><br />
                    <a href="http://www.afb.org/afbpress/pubnew.asp?DocID=aw190303" target="_blank"><img style="margin-top: 16px;" src="/images/access_world-20180330.png" width="100%" /></a>
                </div>
				<div class="col-md-6">
                    <a style="font-size: 20px;" href="http://www.honolulumagazine.com/Honolulu-Magazine/March-2018/Hawaii-Residents-Develop-Apps-to-Aid-People-Who-Are-Deaf-and-Blind/" target="_blank">Hawai‘i Residents Develop Apps to Aid People Who Are Deaf and Blind, March 6, 2018</a><br />
                    <a href="http://www.honolulumagazine.com/Honolulu-Magazine/March-2018/Hawaii-Residents-Develop-Apps-to-Aid-People-Who-Are-Deaf-and-Blind/" target="_blank"><img style="margin-top: 16px;" src="/images/honolulu-20180306.png" width="100%" /></a>
                </div>
				<div class="col-md-6">
                    <br /><br /><a style="font-size: 20px;" href="https://www.facebook.com/AmericanCounciloftheBlindOfficial/posts/2085476868161468" target="_blank">Yosemite Audio Description, American Council of the Blind, Dec. 1, 2017</a>
                    <a href="https://www.facebook.com/AmericanCounciloftheBlindOfficial/posts/2085476868161468" target="_blank"><img style="margin-top: 16px;" src="/images/acb-news.png" width="100%" /></a>
                </div>
				<div class="col-md-6">
                    <br /><br /><a style="font-size: 20px;" href="http://www.civilbeat.org/2017/04/reader-rep-why-hawaii-media-need-to-better-serve-the-visually-impaired/" target="_blank">Why Hawaii Media Need To Better Serve The Visually Impaired, CivilBeat.org, April 17, 2017</a><br />
                    <a href="http://www.civilbeat.org/2017/04/reader-rep-why-hawaii-media-need-to-better-serve-the-visually-impaired/" target="_blank"><img style="margin-top: 16px;" src="/images/civil_beat-news.png" width="100%" height="351" /></a>
                </div>
            </div>
        </div>
		
@endsection
