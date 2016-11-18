@extends('layouts.app')

@section('title', 'Site Map');

@section('content')

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Site Map
	            	<small>Find what you're looking for</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ SITEROOT }}/">Home</a>
                    </li>
                    <li class="active">Site Map</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
				<ul>
                    <li><a href="{{ SITEROOT }}">Home</a></li>
                    <li><a href="{{ SITEROOT }}/guide">Guide</a></li>
                    <li><a href="{{ SITEROOT }}/faq">FAQ</a></li>
                    <li><a href="{{ SITEROOT }}/forum">Forum</a></li>
                    <li><a href="{{ SITEROOT }}/about">About</a></li>
                    <li><a href="{{ SITEROOT }}/auth/login">Sign In</a></li>
                    <li><a href="{{ SITEROOT }}/auth/register">Register</a></li>
                    <li>
                        My Account
                        <ul>
                            <li>
                                <a href="{{ SITEROOT }}/account/project">My Projects</a>
                            </li>
                            <li>
                                <a href="{{ SITEROOT }}/account/settings">Settings</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        <hr>

@endsection
