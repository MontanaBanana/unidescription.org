		
            @if($editable)
            <!-- app store assets -->
            <div class="panel panel-default">
                <div class="panel-heading">Project assets:</div>
                <div class="panel-body white">
                    <p style="margin-top: 5px;">
                        <!--<input type="file" id="asset" name="asset[]" onchange="javascript:location.reload();" multiple><br />-->
                        This section allows you to store all assets related to this project.
                        The assets are not automatically included in the export of the app.<br />
                    </p>
                    <div class="panel-note">
                        <form method="POST" action="/account/project/assets" enctype="multipart/form-data" id="section_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="project_id" id="id" value="{{ $project->id }}"  />
                            <p>
                                <input type="file" id="asset" name="asset[]" onchange="javascript:location.reload();" multiple><br />
                                This section allows you to store all assets related to this project.
                                The assets are not automatically included in the export of the app.<br />
                            </p>
                        </form>
                    </div>
                    <?php if (isset($assets)): ?>
                    <?php $c = false; foreach ($assets as $a): ?>
                        <div class="row" style="<?php echo (($c = !$c)?'background-color: #f5f5f5':'') ?>; padding: 10px;">
                            <h4 class="media-heading"><a target="_blank" href="/assets/projects/<?php echo $project->id; ?>/assets/<?php echo $a['title']; ?>"><?php echo $a['title']; ?></a><span data-asset_id="<?php echo $a['id']; ?>" class="toc-icon asset-delete label pull-right label-danger" style="width: 28px;" data-toggle="tooltip" data-placement="left" title="Delete"><span class="fa fa-times"></span></span></h4>
                            
                            Uploaded by <a href="mailto:<?php echo $a->user->email; ?>"><?php echo $a->user->name; ?></a> on <?php echo date('F jS, Y', strtotime($a->created_at)); ?>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            @endif

@if($editable)
<script type="text/javascript">

Dropzone.autoDiscover = false;

var token = "{!! csrf_token() !!}";

$('div#dropit').dropzone({
    url: "/account/project/assets",
    paramName: "asset",
    maxFilesize: 50,
    params: {
        _token: token
    },
    init: function() {
        this.on("addedfile", function(file) {
            //alert("Added file.");
        }),
        this.on("success", function(file, response) {
            location.reload();
        })
    }
});
	
	$(document).ready(function() {
	  	$('.asset-delete').on('click', function(event) {

/*
	    	var section_id = $(this).data('section_id');
			var section = $(this);
			
			//$(section).addClass('label-success');
			//$(section).removeClass('label-default');

			var deleted = 0;
			if ($(section).children().hasClass("fa-times")) {
				$(section).children().removeClass('fa-times');
				deleted = 1;
			}
			else {
				$(section).children().removeClass('fa-undo');
			}
			
			$(section).children().addClass("fa-spinner fa-spin");
*/
			
			var formData = { 
				_token: $('input[name=_token]').val(),
				deleted: 1,
				id: $(this).data('asset_id')
			};

			if (confirm('Are you sure you want to delete this?')) {	
				// Set it completed
				$.ajax({
					url : "/account/project/asset/delete",
					type: "POST",
					data : formData,
					success: function(data, textStatus, jqXHR)
					{
						if (data.status) {
							location.reload();
							//$(section).children().removeClass("fa-spinner fa-spin");
							//$(section).removeClass('label-success');
							//$(section).addClass('label-default');
							//location.reload();
						}
						else {
							alert('Error: contact the site admin');
						}
					}
				});
			}
	  	});

	});

</script>
@endif
