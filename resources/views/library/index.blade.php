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
<?php 

/**
 * get projects
 * also gets $sortBy and $direction values from URL or defaults to 'created' 'asc'
 */
$libraries = App\Library::all();
foreach ($libraries as $lib):

    ?>
    <p>
    <label for="<?php echo $lib->id; ?>">Word:</label> <input type="text" id="<?php echo $lib->id; ?>" name="<?php echo $lib->id; ?>" value="<?php echo $lib->word; ?>" />&nbsp;
    <label for="p-<?php echo $lib->id; ?>">Phonetic text:</label> <input type="text" id="p-<?php echo $lib->id; ?>" name="p-<?php echo $lib->id; ?>" value="<?php echo $lib->phonetic_word; ?>" />
        <span class="btn btn-sm label-danger btn-inline del-word" style="width: 120px; background-color: #d9534f;" data-library_id="<?php echo $lib->id; ?>" id="btn-del-word-<?php echo $lib->id; ?>"><i id="minus-icon" class="fa fa-minus fa-fw"></i> DELETE</span>
    </p>
    <?php

endforeach;
?>

    <label for="add_word">Add word:</label> <input class="new_word_input" type="text" id="add_word" name="add_word">&nbsp;
    <label for="p-add_word">Phonetic text:</label> <input class="new_word_input" type="text" id="p-add_word" name="p-add_word" />
    <span class="btn btn-sm btn-primary btn-inline add-word" style="width: 80px;" id="btn-add-word"><i id="plus-icon" class="fa fa-plus fa-fw"></i> ADD</span>

                </div>
            </div>
        </div>

@section('js')
<script type="text/javascript">

    $('body').on('click', '.del-word', function(e) {
        var data = new FormData();
        console.log($(this).data('library_id'));
        data.append('id', $(this).data('library_id'));
        data.append('_token', '{{csrf_token()}}');

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

</script>
@endsection
