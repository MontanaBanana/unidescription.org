@extends('layouts.app')

@section('title', 'UniD Academy')

@section('content')

		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="container">
				<div class="col-lg-12">
					<h1 class="page-header">UniD Academy
						<small>UniDescription Academy</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="{{ SITEROOT }}/">Home</a>
						</li>
						<li class="active">UniD Academy</li>
					</ol>
				</div>
			</div>
		</div>
		<!-- /.row -->

		<!-- Content Row -->
		<div class="row blade">
			<div class="container">	
				<div class="col-md-12">
                    <img class="photo" src="{{ SITEROOT }}/images/unid-poster.jpg" alt="Brett's UniD research poster">
                    <p class="caption">UniD research poster presented by Brett Oppegaard at the annual Association for Computer Machinery SIG Design of Communication (SIGDOC), held in Silver Spring, Maryland, in 2016.</p>
                            
                    <iframe width="100%" height="1200" src="https://sites.google.com/a/hawaii.edu/unidescriptionproject/" frameborder="0"></iframe>
                </div>
            </div>
		</div>
		<!-- End the content -->

@endsection
