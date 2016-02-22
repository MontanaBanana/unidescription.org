@extends('layouts.app')

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
                <img class="img-responsive" src="{{ SITEROOT }}/images/showing_ipad_apps.jpg" alt="Campfires & Candlelight">
            </div>
            <div class="col-md-6">
                <h2>About The UniD Project:</h2>
                <p>The UniD (“UniDescription”) Project officially began in the fall of 2014, when principal investigator <a href="http://www.socialsciences.hawaii.edu/profile/index.cfm?email=brett.oppegaard@hawaii.edu" target="_blank">Dr. Brett Oppegaard</a> moved from <a href="https://www.wsu.edu" target="_blank">Washington State University</a> to <a href="https://www.hawaii.edu" target="_blank">University of Hawai‘i</a>. During this transition, he was working with Michele Hartley at <a href="http://www.nps.gov/hfc" target="_blank">Harpers Ferry Center</a> on <a href="http://www.nps.gov/hfc/accessibility" target="_blank">accessibility issues</a> related to printed <a href="http://www.nps.gov" target="_blank">National Park Service</a> products, such as the <a href="https://www.nps.gov/hfc/products/pubs/pubs-04a-c.cfm" target="_blank">“Unigrid” brochures</a>, and started envisioning the potential of mobile technologies to remediate and translate those static texts into acoustic forms. Once in <a href="https://en.wikipedia.org/wiki/Manoa" target="_blank">Manoa</a>, he began collaborating with two scholars who have spent their careers focused upon issues of accessibility, <a href="https://coe.hawaii.edu/directory/?person=mconway" target="_blank">Megan Conway</a> and <a href="https://coe.hawaii.edu/directory/?person=tconway" target="_blank">Tom Conway</a>, both serving in the UH <a href="https://www.cds.hawaii.edu/" target="_blank">Center on Disability Studies</a>. For a behind-the-scenes look at the process of developing this project, please see the <a href="https://npsaudiodescription.wordpress.com/" target="_blank">blog</a>.</p>


            </div>
        </div>
        <!-- /.row -->

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
                        <li><a href="https://www.facebook.com/uhmanoa/" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/university-of-hawaii" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/uhmanoa" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
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
                        <li><a href="https://www.facebook.com/nationalparkservice" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/national-park-service" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/NatlParkService" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
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
                        <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
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
                        <li><a href="https://www.facebook.com/montanabweb/" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/company/montana-banana-web-design-&-development" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/montanabweb" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- List of people involved -->
        <div class="row">
            <div class="col-md-2 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/brett-oppegaard.jpg" alt="Brett Oppegaard's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Brett Oppegaard<br>
                            <small>Principal Investigator</small>
                        </h4>
                        <p>An Assistant Professor in the UH School of Communications</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/brettoppegaard" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/megan-conway.jpg" alt="Megan Conway's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Megan Conway<br>
                            <small>Co-PI</small>
                        </h4>
                        <p>An Assistant Professor in the UH Center on Disability Studies</p>
                    </div>
                   <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/thomas-conway.jpg" alt="Thomas Conway's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Thomas Conway<br>
                            <small>Co-PI</small>
                        </h4>
                        <p>Media Coordinator in the UH Center on Disability Studies</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/michele-hartley.jpg" alt="Michele Hartley's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Michele Hartley<br>
                            <small>NPS Liaison</small>
                        </h4>
                        <p>Media accessibility coordinator at Harpers Ferry Center</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="{{ SITEROOT }}/images/team/joe-oppegaard.png" alt="Joe Oppegaard's bio photo">
                    <div class="caption" style="height: 205px;">
                        <h4>Joe Oppegaard<br>
                            <small>Chief Technology Officer</small>
                        </h4>
                        <p>Montana Banana</p>
                    </div>
                    <ul class="list-inline">
                        <li><a href="https://www.facebook.com/montanabweb/" target="_blank"><i class="fa fa-2x fa-facebook-square"></i></a>
                        </li>
                        <li><a href="https://www.linkedin.com/in/joe-oppegaard-38957811" target="_blank"><i class="fa fa-2x fa-linkedin-square"></i></a>
                        </li>
                        <li><a href="https://twitter.com/JoeOppegaard" target="_blank"><i class="fa fa-2x fa-twitter-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="thumbnail">
                    <img class="img-responsive" style="height: 150px; width: 110px" src="http://placehold.it/110x150" alt="">
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
                <img class="img-responsive customer-img" src="{{ SITEROOT }}/images/washington_monument.jpg" alt="">
                <p>Washington Monument</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <img class="img-responsive customer-img" src="{{ SITEROOT }}/images/golden_gate.jpg" alt="">
                <p>Golden Gate</p>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <img class="img-responsive customer-img" src="{{ SITEROOT }}/images/volcanoes.jpg" alt="">
                <p>Hawaii Volcanoes</p>
            </div>
        </div>
        <!-- /.row -->

        <hr>
        
@endsection
