<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	</head>

<body>

<div style="min-height:80px; min-width:300px; max-width:600px; margin: 20px auto; padding:10px; background-color:#fff; color:#000; text-align:center; position: relative">
    <button title="Close (Esc)" type="button" class="mfp-close" style="color:#333">×</button>
    <h3>Upload your audio file to the field: <?php echo ucwords(preg_replace("/_/", " ", $title));?></h3>
    
    <form enctype="multipart/form-data" id="upload_audio" role="form" method="POST">
		<div class="form-group">
			<input type="file" id="audio" name="audio" accept=".wav" style="text-align: center;display: block;margin: 15px auto;padding: 5px 20px;border: 1px dotted #999;">
			<p class="">Upload your audio file. Only .wav format is accepted</p>
		</div>
		
		<input type="hidden" name="_token" value="{{ csrf_token()}}">
		<div><button id="submit" value="Submit">SUBMIT</button></div>
	</form>
	
</div>

<script>
	$("#submit").click(function(e){
		e.preventDefault();
		
		var formData = new FormData($("#upload_audio")[0]);
		$.ajax({
			url:"{{url('account/project/edit/audio/add/'.$project.'/'.$section.'/'.$title)}}",
			data:formData,
			dataType:"json",
			async:true,
			type:"post",
			processData: false,
			contentType: false,
			beforeSend: function() {
               console.log('about to send: {{$title}}');
            },
			success:function(response){
				if(response.status == 'success'){
					$("button.mfp-close").css("background-color", "yellow");
					$("#upload_audio").html(response.message);
				}
				if(response.status == 'deleted'){
					$("#upload_audio").html(response.message);
					alert(response.message);
				}
				if(response.status == 'error'){
					alert(response.message);
				}
			},
			error:function(response){
				console.log('error: '+response.statusText);
			}
		});
	});
</script>

</body>

</html>