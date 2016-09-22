<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{{ $project->title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="{{ $project->description }}">
		<meta name="author" content="{{ $project->user->email }}">
	    
	     <!-- phonegap -->
	    <script type="text/javascript" src="phonegap.js"></script>
	    
	    <!-- Bootstrap -->
	    <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/nps-bootstrap.css">
	    
	    <!-- Custom Fonts -->
	    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/nps-bootstrap.min.js"></script>
	
	    <!-- Unidescription custom JS -->
	    <script type="text/javascript" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/js/unidescription.js"></script>	
	    
	    <link href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/css/unidescription.css" rel="stylesheet">

	</head>
	<body style="padding: 0 5px 0 5px;">

		<div class="row">
	    	<div class="col-md-12">
				<h1>{{ $project->title }}</h1>
				<p>{{ $project->description }}</p>
				
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					
					<?php foreach ($project->section_tree() as $section): ?>
						<?php if ($section['completed'] && !$section['deleted']): ?>
				    	<div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="section-{{ $section->id }}-heading">
						      <h4 class="panel-title">
						        
						          {{ $section->title }}
						        
						      </h4>
						    </div>
						    <div id="section-{{ $section->id }}" class="panel" role="tabpanel" aria-labelledby="section-{{ $section->id }}-heading">
						    	<div class="panel-body">
                                    <?php if (strlen($section->description)): ?>
                                        <audio controls>
                                            <source src='{{ $section->audio_file_url }}' type='audio/wav'>
                                        </audio>

                                        <?php if (strlen($section->image_url) && $section->has_image_rights): ?>
                                            <img width="100%" src="<?php echo $section->image_url; ?>" alt="{{ $section->title }} section image" />
                                        <?php endif; ?>

                                        <p><?php echo nl2br($section->description); ?></p>
                                    <?php endif; ?>

                                    <?php if (strlen($section->image_url) && !strlen($section->description) && $section->has_image_rights): ?>
                                        <img width="100%" src="<?php echo $section->image_url; ?>" alt="{{ $section->title }} section image" />
                                    <?php endif; ?>
									
									@if (count($section->children))
										@foreach ($section->children as $s)
											@if ($s->completed && !$s->deleted)
											<p>
												<b>{{ $s->title }}</b><br />
                                                <?php if (strlen($s->description)): ?>
                                                    <audio controls>
                                                        <source src='{{ $s->audio_file_url }}' type='audio/wav'>
                                                    </audio>

                                                    <?php if (strlen($s->image_url) && $s->has_image_rights): ?>
                                                        <img width="100%" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $s->image_url; ?>" alt="{{ $s->title }} section image" />
                                                    <?php endif; ?>

                                                    <!--<p><?php echo nl2br($s->description); ?></p>-->
                                                    <p><?php echo nl2br($s->description); ?></p>
                                                    <!--<p>{{ $s->description }}</p>-->
                                                <?php endif; ?>

                                                <?php if (strlen($s->image_url) && !strlen($s->description) && $section->has_image_rights): ?>
                                                    <img width="100%" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $s->image_url; ?>" alt="{{ $s->title }} section image" />
                                                <?php endif; ?>
											</p>
											@endif
										@endforeach
									@endif
						    	</div><!-- end panel-body -->
						    </div>
				    	</div><!-- end panel-default -->
				    	<?php endif; ?>
					<?php endforeach; ?>
			  	</div>
	    	</div>
		</div>
	
	</body>
</html>
