@extends('layouts.app')

@section('content')


        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $project->title }}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="/account">Account</a></li>
                    <li><a href="/account/project">My Projects</a></li>
                    <li class="active">{{ $project->title }}</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
      
        <hr>

@endsection