<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{{ $project->title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="{{ $project->description }}">
		<meta name="author" content="{{ $project->user->email }}">
	    
	     <!-- phonegap -->
	    <!--<script type="text/javascript" src="phonegap.js"></script>-->
	    
	    <!-- Bootstrap -->
	    <!--<link rel="stylesheet" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/css/nps-bootstrap.css">-->
	    
	    <!-- Custom Fonts -->
	    <!--<link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
	
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    
	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script type="text/javascript" src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <!--<script type="text/javascript" src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/nps-bootstrap.min.js"></script>-->
        <!--<script type="text/javascript" src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/autosize.js"></script>-->
        <!--<script type="text/javascript" src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/jquery-sortable.min.js"></script>-->

	
	    <!-- Unidescription custom JS -->
	    <!--<script type="text/javascript" src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/js/unidescription.js"></script>	-->
	    
	    <!--<link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/css/unidescription.css" rel="stylesheet">-->

        <!-- Dependencies -->
        <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/ableplayer/thirdparty/modernizr.custom.js"></script>
        <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/ableplayer/thirdparty/js.cookie.js"></script>

        <!-- CSS --> 
        <link rel="stylesheet" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/ableplayer/build/ableplayer.min.css" type="text/css"/>

        <!-- JavaScript -->
        <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/ableplayer/build/ableplayer.min.js"></script>

        <style>
/*
        html, body {
            height: 100%;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }
*/
        </style>

	</head>
	<body>

        <div id="toc">
            <h1>{{ $project->title }}</h1>
            <!--<p>{{ $project->description }}</p>-->
        </div>
        
        <main>
            <nav>
                <div width="50%">
                        <ul>
            <?php foreach ($project->section_tree() as $section): ?>
                <?php if ($section['completed'] && !$section['deleted']): ?>
                        <?php echo '<li><a href="#'.$section['id'].'">'.$section['title'].'</a>'; ?>
                            @if (count($section->children))
                                <ul>
                                @foreach ($section->children as $s)
                                    @if ($s->completed && !$s->deleted)
                                            <?php echo '<li><a href="#'.$s['id'].'">'.$s['title'].'</a>'; ?>
                                            @if (count($s->children))
                                                <ul>
                                                @foreach ($s->children as $chch)
                                                    @if ($chch->completed && !$chch->deleted)
                                                    <?php echo '<li><a href="#'.$chch['id'].'">'.$chch['title'].'</a></li>'; ?>
                                                    @endif
                                                @endforeach
                                                </ul>
                                            @endif
                                            <?php echo '</li>'; ?>
                                    @endif
                                @endforeach
                                </ul>
                            @endif
                        <?php echo '</li>'; ?>
                <?php endif; ?>
            <?php endforeach; ?> 
                        </ul>
                </div>
            </nav>

            <?php $count = 0; ?>
            <?php foreach ($project->section_tree() as $section): ?>
                <?php if ($section['completed'] && !$section['deleted']): ?>
                      <?php $count++; ?>

                      <h2 id="{{ $section->id }}">{{ $section->title }}</h2>
                      <a name="{{ $section->id }}"></a>

                      <?php
                          if($section->audio_title!=''){$this_audio = '/audio/'.$section->audio_title;}
                          else{$this_audio = $section->audio_file_title;}
                      ?>

                            <?php if (strlen($section->description) OR strlen($section->audio_description)): ?>
                                <?php if (strlen($section->image_url) && $section->has_image_rights): ?>
                                    <img width="100%" src="<?php echo $section->image_url; ?>" alt="{{ $section->title }} section image" />
                                <?php endif; ?>
                                <?php if (preg_match("/</", $section->description)) { echo $section->description; } else { echo nl2br($section->description); } ?>
                                    <div>
                                <?php
                                    $description_audio = $section->audio_file_description;
                                    if($section->audio_description!='') {
                                        $description_audio = $section->audio_description;
                                    }
                                ?>
                                        <audio id="audio-{{ $section->id }}" preload="auto" data-able-player> </audio>
                                        <!-- first playlist (embedded) -->
                                        <ul class="able-playlist" data-player="audio-{{ $section->id }}" data-embedded>
                                          <li data-mp3="{{ $this_audio }}" >{{ $section->title }}</li>
                                          <li data-mp3="{{ $description_audio }}">Description of {{ $section->title }}</li>
                                        </ul>
                                        <a href="#toc">&uarr; back to top</a>
                                    </div>
                            <?php endif; ?>

                            <?php if (strlen($section->image_url) && !strlen($section->description) && $section->has_image_rights): ?>
                                <img width="100%" src="<?php echo $section->image_url; ?>" alt="{{ $section->title }} section image" />
                            <?php endif; ?>
                            
                            @if (count($section->children))
                                @foreach ($section->children as $s)
                                    @if ($s->completed && !$s->deleted)
                                            <h3 style="font-weight:bold; margin-top:5px; margin-bottom:5px; padding:12px 0; border-top:1px dotted #000;"> {{ $s->title }} </h3>
                                            <a name="{{ $s->id }}"></a>

                                            <?php if (strlen($s->description)): ?>
                                                <?php if (strlen($s->image_url) && $s->has_image_rights): ?>
                                                    <img width="100%" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $s->image_url; ?>" alt="{{ $s->title }} section image" />
                                                <?php endif; ?>
                                                <?php if (preg_match("/</", $s->description)) { echo $s->description; } else { echo nl2br($s->description); } ?>
                                                <div>
                                                    <audio id="audio-{{ $s->id }}" preload="auto" data-able-player> </audio>
                                                    <!-- first playlist (embedded) -->
                                                    <ul class="able-playlist" data-player="audio-{{ $s->id }}" data-embedded>
                                                      <li data-mp3="{{ $s->audio_title ? '/audio/'.$s->audio_title : $s->audio_file_title }}" >{{ $s->title }}</li>
                                                      <li data-mp3="{{ $s->audio_description ? '/audio/'.$s->audio_description : $s->audio_file_description }}">Description of {{ $s->title }}</li>
                                                    </ul>
                                                </div>
                                                <a href="#toc">&uarr; back to top</a>

                                            <?php endif; ?>

                                            <?php if (strlen($s->image_url) && !strlen($s->description) && $section->has_image_rights): ?>
                                                <img width="100%" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $s->image_url; ?>" alt="{{ $s->title }} section image" />
                                            <?php endif; ?>
                                            @if (count($s->children))
                                                @foreach ($s->children as $chch)
                                                    @if ($chch->completed && !$chch->deleted)
                                                    <p style="margin-left: 20px; padding:12px 0; border-top:1px dotted #000;">
                                                        <h4>{{ $chch->title }}</h4> 
                                                        <a name="{{ $chch->id }}"></a>
                                                        <?php if (strlen($chch->description)): ?>
                                                            <?php if (strlen($chch->image_url) && $chch->has_image_rights): ?>
                                                                <img width="100%" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $chch->image_url; ?>" alt="{{ $chch->title }} section image" />
                                                            <?php endif; ?>

                                                            <div style="margin-left: 20px;"><?php if (preg_match("/</", $chch->description)) { echo $chch->description; } else { echo nl2br($chch->description); } ?></div>
                                                            <div>
                                                                <audio id="audio-{{ $chch->id }}" preload="auto" data-able-player> </audio>
                                                                <!-- first playlist (embedded) -->
                                                                <ul class="able-playlist" data-player="audio-{{ $chch->id }}" data-embedded>
                                                                  <li data-mp3="{{ $chch->audio_title ? '/audio/'.$chch->audio_title : $chch->audio_file_title }}" >{{ $chch->title }}</li>
                                                                  <li data-mp3="{{ $chch->audio_description ? '/audio/'.$chch->audio_description : $chch->audio_file_description }}">Description of {{ $chch->title }}</li>
                                                                </ul>
                                                            </div>
                                                            <a href="#toc">&uarr; back to top</a>

                                                        <?php endif; ?>

                                                        <?php if (strlen($chch->image_url) && !strlen($chch->description) && $chchection->has_image_rights): ?>
                                                            <img width="100%" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/<?php echo $chch->image_url; ?>" alt="{{ $chch->title }} section image" />
                                                        <?php endif; ?>
                                                    </p>
                                                    @endif
                                                @endforeach
                                            @endif
                                    @endif
                                @endforeach
                            @endif
                <?php endif; ?>
            <?php endforeach; ?>

        </main>

<script type="text/javascript">
// Select all links with hashes
$(document).ready(function() {
console.log('in docready');
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    event.stopPropagation();
console.log('inside clicky');
    {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

});
</script>

        
	</body>
</html>
