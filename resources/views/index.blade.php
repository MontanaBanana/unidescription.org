@extends('layouts.app')

@section('content')

    <!-- Header Carousel -->
    
    <header>
	    <img src="{{ SITEROOT }}/slideshow/ad_photo1.jpg" /><br />
		<div style="text-align: center; margin-top: 5px;">
			<p style="font-size: 22px;"><strong>How do you get started?</strong> Just <a href="{{ SITEROOT }}/auth/register">create a free account</a>, <a href="{{ SITEROOT }}/auth/login">sign in</a>, and start a new project.</p>
		</div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header" style="font-family: Helvetica;">
                    <center><strong style="font-size: 42px">The UniD Project</strong><br /> To Create Acoustic Spaces and More Accessible Places</center>
                </h1>
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

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Featured Audio Descriptions</h2>
            </div>
            
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/washington_monument.jpg" alt="Washington Monument">
				Washington Monument
			</div>
			
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/golden_gate.jpg" alt="Golden Gate">
				Golden Gate
			</div>
			
			<div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				<img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/images/volcanoes.jpg" alt="Hawaii Volcanoes">
				Hawaii Volcanoes
			</div>
			
            <?php
	            
	            /*
	            if(is_dir($_SERVER['DOCUMENT_ROOT'].SITEROOT.'/portfolio/')){
	            
		            $dh = opendir($_SERVER['DOCUMENT_ROOT'].SITEROOT.'/portfolio/');
		            $images = array();
		            while ($file = readdir($dh)) {
			            if (preg_match("/.jpg$/", $file)) {
				        	$images[] = $file;
			            }
		            }
		            
		            foreach ($images as $image) {
			            ?>
				            <div class="col-md-4 col-sm-6" style="padding-bottom: 15px;">
				                <a href="{{ SITEROOT }}portfolio-item.html">
				                    <img class="img-responsive img-portfolio img-hover" src="{{ SITEROOT }}/portfolio/<?php echo $image; ?>" alt="">
				                </a>
				                Lorem ipsum dolor sit amet
				            </div>
				        <?
		            }

	            }
	            */
	        ?>
        </div>
        <!-- /.row -->

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

                </ul>

            </div>
            <div class="col-md-6">
                <img class="img-responsive" src="{{ SITEROOT }}/slideshow/mobile_nps.jpg" alt="">
            </div>
        </div>
        <div class="row">
	        <div class="col-lg-12">
		        <ul style="top: -10px; position: relative;">
			        <li>It includes a forum for discourse about audiovisual translation, including audio description, verbal description, and many of the other terms used for the similar process of verbally describing something visual and sharing that description with others</li>
					<li>It creates deliverables that are accessible in many ways; your audiovisual translation can be exported as text, audio files, or even mobile apps (in Android and iOS formats)</li>
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
					More behind-the-scenes: Our regularly updated blog about this project also is available <a href="https://npsaudiodescription.wordpress.com/" target="_blank">here</a>.
				</p>
	        </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row home-boxes">         
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
                        <a href="https://github.com/MontanaBanana/unidescription.com" target="_blank" class="btn btn-default">Fork on Github!</a>
                    </div>
                </div>
            </div>

        </div>

        <hr>

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
