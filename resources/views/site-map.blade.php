@extends('layouts.app')

@section('content')

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Site Map
	            	<small>Find what you're looking for</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">Site Map</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-12">
				<ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/guide">Guide</a></li>
                    <li><a href="/faq">FAQ</a></li>
                    <li><a href="/forum">Forum</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/auth/login">Sign In</a></li>
                    <li><a href="/auth/register">Register</a></li>
                    <li>
                        My Account
                        <ul>
                            <li>
                                <a href="/account/project">My Projects</a>
                            </li>
                            <li>
                                <a href="/account/settings">Settings</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        <hr>

@endsection
