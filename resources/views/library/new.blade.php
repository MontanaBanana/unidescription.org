@extends('layouts.app')

@section('title', 'Phonetic Library - Add a new word')

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
                        <div class="panel-heading">Add a new word:</div>
                            <div class="panel-body white">

                                <table width="100%">
                                    <thead>
                                        <tr><th width="33%">Word</th><th width="33%">Phonetic</th><th width="10%">Play</th><th width="24%" align="right" style="text-align: right"></th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class="new_word_input" type="text" id="add_word" name="add_word" style="width: 90%" /></td>
                                            <td><input class="new_word_input" type="text" id="p-add_word" name="p-add_word" style="width: 90%" /></td>
                                            <td style="padding-left: 5px; padding-right: 5px;">  
                                               <a class="btn btn-sm btn-primary play-audio" rel="new" style="">
                                                    <span id="player-icon" class="fa fa-play"></span>
                                                </a>
                                               <div class="audio-player play-title">
                                                    <audio id="play-new" controls></audio>
                                                </div> 
                                            </td>
                                            <td></td>
                                            <td align="right"><span class="btn btn-sm btn-primary btn-inline add-word" style="width: 80px;" id="btn-add-word"><i id="plus-icon" class="fa fa-plus fa-fw"></i> ADD</span></td>
                                        </tr>
                                    </tbody>
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
                    setTimeout(function() { window.location='/library/';},0);
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
                    data: { t : $('#p-add_word').val().replace(/(<([^>]+)>)/ig,"\n").replace(/&#?[a-z0-9]{2,8};/ig, ''), use_library : false },
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


</script>
@endsection
