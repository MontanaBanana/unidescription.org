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
		<div class="row blade" style="padding-top: 0;">
            <div class="container">
                <div class="col-md-12">
                    <iframe width="100%" height="1800" src="https://www.cds.hawaii.edu/projects/training/courses/unidescription/" frameborder="0"></iframe>
                    <center><blockquote style="border-left: 0;">UniD Project Research</blockquote></center>
                </div>
            </div>
		</div>
		<!-- End the content -->

@endsection
