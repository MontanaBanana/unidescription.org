@extends('layouts.app')

@section('title', 'Phonetic Library')

@section('content')

		<!-- Page Heading/Breadcrumbs -->
		<div class="row">
			<div class="container">
                <div class="col-lg-12">
                        <h1 class="page-header">Phonetic Library
                            <small>list of words automatically replaced with their phonetic version</small>
                        </h1>
                </div>
			</div>
		</div>
		<!-- /.row -->
		
        <div class="row">
            <div class="container">
                <div class="col-lg-12"> 

                                <div class="panel panel-default">
                                    <div class="panel-heading">Phonetic library:</div>
                                    <div class="panel-body white">
                                        <table width="100%">
                                            <tr><th width="28%">Word</th><th width="10%">Play</th><th width="28%">Phonetic</th><th width="10%">Play</th><th width="24%" align="right" style="text-align: right"></th></tr>

<!--
    <tr>
        <td><input class="new_word_input" type="text" id="add_word" name="add_word" style="width: 90%" /></td>
        <td><input class="new_word_input" type="text" id="p-add_word" name="p-add_word" style="width: 90%" /></td>
        <td style="padding-left: 5px; padding-right: 5px;"> </td>
        <td></td>
        <td align="right"><span class="btn btn-sm btn-primary btn-inline add-word" style="width: 80px;" id="btn-add-word"><i id="plus-icon" class="fa fa-plus fa-fw"></i> ADD</span></td>
    </tr>
-->

<?php 

/**
 * get projects
 * also gets $sortBy and $direction values from URL or defaults to 'created' 'asc'
 */
//$libraries = App\Library::orderBy('word')->get();
$lib = App\Library::find($library_id);

    ?>
    <tr>
        <td><input type="text" id="<?php echo $lib->id; ?>" name="<?php echo $lib->id; ?>" value="<?php echo $lib->word; ?>" style="width: 90%" /></td>
        <td style="padding-left: 5px; padding-right: 5px;">
            <a class="btn btn-sm btn-primary play-audio" rel="<?php echo $lib->id; ?>" style="">
                <span id="player-icon" class="fa fa-play"></span>
            </a>
           <div class="audio-player play-title">
                <audio id="play-<?php echo $lib->id; ?>" controls></audio>
            </div>

        </td>
        <td><input type="text" id="p-<?php echo $lib->id; ?>" name="p-<?php echo $lib->id; ?>" value="<?php echo $lib->phonetic_word; ?>" style="width: 90%" /></td>
        <td style="padding-left: 5px; padding-right: 5px;">
            <a class="btn btn-sm btn-primary play-audio" rel="p-<?php echo $lib->id; ?>" style="">
                <span id="player-icon" class="fa fa-play"></span>
            </a>
           <div class="audio-player play-title">
                <audio id="play-p-<?php echo $lib->id; ?>" controls></audio>
            </div>

        </td>
        <td align="center">
            <!--<span class="btn btn-sm label-warning btn-inline update-word" style="width: 120px; background-color: #7a8f52; margin-top: 5px;" data-library_id="<?php echo $lib->id; ?>" id="btn-update-word-<?php echo $lib->id; ?>"><i id="plus-icon" class="fa fa-plus fa-fw"></i> UPDATE</span>-->
            <!--<a href="/library/update/<?php echo $lib->id; ?>" class="btn btn-sm btn-primary btn-inline" style="width: 120px;"><i id="plus-icon" class="fa fa-plus fa-fw"></i> UPDATE</a>-->
        </td>
        <td align="right">
            <!--<span class="btn btn-sm label-danger btn-inline del-word" style="width: 120px; background-color: #d9534f; margin-top: 5px;" data-library_id="<?php echo $lib->id; ?>" id="btn-del-word-<?php echo $lib->id; ?>"><i id="minus-icon" class="fa fa-minus fa-fw"></i> DELETE</span>-->
            <span class="btn btn-sm label-warning btn-inline update-word" style="width: 120px; background-color: #7a8f52; margin-top: 5px;" data-library_id="<?php echo $lib->id; ?>" id="btn-update-word-<?php echo $lib->id; ?>"><i id="plus-icon" class="fa fa-plus fa-fw"></i> UPDATE</span>
        </td>
    </tr>
    <?php

?>

    </table>

                </div>
            </div>
        </div>

                                    </div>
                                    </div>
                                </div>


@section('js')
<script type="text/javascript">

    var audio;

    function stopPlayers(){
        var sounds = document.getElementsByTagName('audio');
        for(i=0; i<sounds.length; i++) sounds[i].pause();
    }

    $('body').on('click', '.update-word', function(e) {
        var data = new FormData();
        console.log($(this).data('library_id'));
        data.append('id', $(this).data('library_id'));
        data.append('_token', '{{csrf_token()}}');
        //data.
        //id="<?php echo $lib->id; ?>" name="<?php echo $lib->id; ?>" value="<?php echo $lib->word; ?>" style="width: 90%" />
        //        <td><input type="text" id="p-<?php echo $lib->id; ?>"
        data.append('word', $('#'+$(this).data('library_id')).val());
        data.append('p_word', $('#p-'+$(this).data('library_id')).val());

        $.ajax({
            url: "/library/update",
            data: data,
            dataType:"json",
            async:true,
            type:"post",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success:function(response){
                if(response.status == "success"){
                    setTimeout(function() { window.location=window.location;},0);
                }
                if(response.status == "error"){
                    alert(response.message);
                }
            },
            error:function(response){
                console.log("error: "+response.statusText);
            }
        });

    });


    $('body').on('click', '.del-word', function(e) {
        var data = new FormData();
        console.log($(this).data('library_id'));
        data.append('id', $(this).data('library_id'));
        data.append('_token', '{{csrf_token()}}');

        if (confirm('Are you sure you want to delete this word? This action cannot be undone.')) {
            $.ajax({
                url: "/library/delete",
                data: data,
                dataType:"json",
                async:true,
                type:"post",
                enctype: "multipart/form-data",
                processData: false,
                contentType: false,
                success:function(response){
                    if(response.status == "success"){
                        setTimeout(function() { window.location=window.location;},0);
                    }
                    if(response.status == "error"){
                        alert(response.message);
                    }
                },
                error:function(response){
                    console.log("error: "+response.statusText);
                }
            });
        }

    });

    $(".new_word_input").on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('.add-word').click();
        }
    });

    $('body').on('click', '.add-word', function (e){
        e.preventDefault();
        var t = $(this).attr('rel');
        var link = $(this).attr('download');

        var data = new FormData();
        data.append('word', $('#add_word').val());
        data.append('phonetic_word', $('#p-add_word').val());
        data.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: "/library/add",
            data: data,
            dataType:"json",
            async:true,
            type:"post",
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success:function(response){
                if(response.status == "success"){
                    setTimeout(function() { window.location=window.location;},0);
                }
                if(response.status == "error"){
                    alert(response.message);
                }
            },
            error:function(response){
                console.log("error: "+response.statusText);
            }
        });
    });


        $('.play-audio').on('click', function(event) {
            var this_section = $(this).attr('rel');
            stopPlayers();

            $.each($('aaudio'), function () {
                this.pause();
                $('.fa-stop').removeClass('fa-stop').addClass('fa-play');
                $('.audio-player').hide();
            });

            // define the audio element
            var audio = $('#play-'+this_section);

            if ($(this).find('#player-icon').hasClass('fa-play')) {
                $(this).find('#player-icon').removeClass('fa-play');
                $(this).find('#player-icon').addClass('fa-stop');
                    //data: { t : $('#'+this_section).val().replace(/(<([^>]+)>)/ig,"\n").replace(/&#?[a-z0-9]{2,8};/ig, '') + ' to ' + $('#p-'+this_section).val().replace(/(<([^>]+)>)/ig,"\n").replace(/&#?[a-z0-9]{2,8};/ig, ''), use_library : false },
                var request = $.ajax({
                    url: "https://api.montanab.com/tts/tts.php", 
                    method: "POST",
                    data: { t : $('#'+this_section).val().replace(/(<([^>]+)>)/ig,"\n").replace(/&#?[a-z0-9]{2,8};/ig, ''), use_library : false },
                    dataType: "json"
                });

                request.done(function( msg ) {
                    console.log(msg.fn);

                    audio.attr('src', msg.fn);
                    audio.attr('autoplay', 'autoplay');
                    audio.load();

                    $('.audio-player.play-'+this_section).show();
                    document.getElementById('play-'+this_section).addEventListener('load', function() {
                        document.getElementById('play-'+this_section).play();
                    }, true);

                    document.getElementById('play-'+this_section).addEventListener('ended', function() {
                        $('.fa-stop').removeClass('fa-stop').addClass('fa-play');
                        $('.audio-player.play-'+this_section).hide();
                    });

                });

                request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed: " + textStatus );
                });
            }
            else {

                $(this).find('#player-icon').removeClass('fa-stop');
                $(this).find('#player-icon').addClass('fa-play');
                $('.audio-player.play-'+this_section).hide();

                document.getElementById('play-'+this_section).pause();
                document.getElementById('play-'+this_section).currentTime = 0;
            }
        });

    $('#filter').on('input',function(e){
        var f = $(this).val().replace(/\s/g,'').replace(/[^a-zA-Z 0-9]+/g, '').toLowerCase();
        var l = f.length;
        if(l > 0){
            $("tr").hide();
            $.each($('[value*="'+f+'"]'), function() {
                console.log(f);
                $(this).parent().parent().show();
            });

        }
        else{
            $("tr").show();
        }
    });

</script>
@endsection
