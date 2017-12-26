		<!-- Navigation -->
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" id="main-nav">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ SITEROOT }}/"><img src="/images/unid_logo.svg" alt="UniDescription logo" /></a>
				</div>
				
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="{{ SITEROOT }}/guide" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Guide <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<!--<li><a href="{{ SITEROOT }}/faq">FAQ</a></li>
								<li><a href="{{ SITEROOT }}/tutorials">Tutorials</a></li>-->
								<li><a href="{{ SITEROOT }}/about">About Us</a></li>
								<li><a href="{{ SITEROOT }}/unid-academy">UniD Academy</a></li>
								<li><a href="{{ SITEROOT }}/forum">Forum</a></li>
								<li><a href="{{ SITEROOT }}/research">Research</a></li>
							</ul>
						</li>
<!--
						<li class="dropdown">
							<a href="{{ SITEROOT }}/about" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">About <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ SITEROOT }}/about">About Us</a></li>
								<li><a href="{{ SITEROOT }}/research-partners">Research Partners</a></li>
								<li><a href="https://npsaudiodescription.wordpress.com/" target="_blank">Blog</a></li>
							</ul>
						</li>
-->
					<?php
					/*
						<li><a style="font-size: 18px; line-height: 88px; height: 88px; padding-top: 0px" href="{{ SITEROOT }}/guide">Guide</a></li>
						<li><a style="font-size: 18px; line-height: 88px; height: 88px; padding-top: 0px" href="{{ SITEROOT }}/forum">Forum</a></li>
						<li><a style="font-size: 18px; line-height: 88px; height: 88px; padding-top: 0px" href="https://npsaudiodescription.wordpress.com/" target="_blank">Blog</a></li>
						<li><a style="font-size: 18px; line-height: 88px; height: 88px; padding-top: 0px" href="{{ SITEROOT }}/about">About</a></li>
					*/
					?>
					<?php if (Auth::check()): ?>							
						<li class="dropdown">
							<a href="{{ SITEROOT }}/account" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Projects <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{SITEROOT}}/account/project">All Projects</a></li>
								<li class="divider"></li>
								<li><a href="{{ SITEROOT }}/account/project/details/0/new">Create New Project</a></li>
								<li class="divider"></li>
								<li><a href="{{ SITEROOT }}/account/project">My Recently Edited Projects</a></li>
								<?php 
									$my_projects = Auth::user()->projects->take(3); 
									$shared_projects = Auth::user()->shared_projects->take(3);
								?>
								@foreach ($my_projects as $project)
									<li class="small">
										<a href="{{ SITEROOT }}/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">{{ $project->title }}</a></li>
								@endforeach
								<li class="divider"></li>
								<li><a href="{{ SITEROOT }}/account/project">Recently Edited Shared Projects</a></li>
								@foreach ($shared_projects as $project)
									<li class="small">
										<a href="{{ SITEROOT }}/account/project/details/{{ $project->id }}/{{ strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)) }}">{{ $project->title }}</a></li>
								@endforeach
							</ul>
						</li>	
						<li class="dropdown">
							<a href="{{ SITEROOT }}/account" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">My Account <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ SITEROOT }}/account">Account Activity</a></li>
								<li><a href="{{ SITEROOT }}/account/settings">Settings</a></li>
								<?php if (! Auth::user()->pg_build_code) { ?>
									<li><a href="{{ SITEROOT }}/phonegapbuild/authorize">PhoneGap Build Auth</a></li>
								<?php } ?>
								<li><a href="{{ SITEROOT }}/auth/logout">Sign Out</a></li>
							</ul>
						</li>
					<?php else: ?>
						<li><a href="{{ SITEROOT }}/auth/login">Sign In</a></li>
						<li class="gold"><a href="{{ SITEROOT }}/auth/register"><strong>Register</strong></a></li>

					<?php endif; ?>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container -->
		</nav>
