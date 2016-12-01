<?php
if (count($section->project_section_versions)):
?>

<div class="panel panel-default">
    <div class="panel-heading">Revision History:</div>
    <div class="panel-body">
        <div class="version">
			<?php
				foreach ($section->project_section_versions as $v) {
                    if ($v->user_id) {
                        $user = App\User::find($v->user_id);
                    }
					?>
					<a data-toggle="modal" href="#<?php echo $v->id; ?>" data-target="#<?php echo $v->id; ?>">
						<?php echo prettyDate($v->created_at->addHours(-7)->format('D, d M Y h:i:s')); ?>
                    </a> @if ($v->user_id) - <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>@endif <br />
					<?php
				}
			?>
        </div>
    </div>
</div>

<?php
endif;

foreach ($section->project_section_versions as $v):
	?>
		<div class="modal fade" id="<?php echo $v->id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php $v->id; ?>Label">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
			  <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="<?php $v->id; ?>Label">Revision on <?php echo $v->created_at->addHours(-7)->format('D, d M Y h:i:s'); ?></h4>
		      </div>
		      <div class="modal-body">

			  	  <div class="row">
				      <div class="panel panel-default">
						<div class="panel-heading" style="text-align:center;">
							Change text
						</div>
						<div class="panel-body col-md-12">
					      <div class="col-md-12">
							<?php 
								
						        $htmlDiff = new Icap\HtmlDiff\HtmlDiff($v->description, $section->description, true);
								$out = $htmlDiff->outputDiff();
						    	//$modifications = $out->getModifications();
							    //echo "<span>Modifications added: ".$modifications['added']."</span><br/>";
							    //echo "<span>Modifications removed: ".$modifications['removed']."</span><br/>";
							    //echo "<span>Modifications changed: ".$modifications['changed']."</span>";
							    //echo "<PRE>out: ".print_R($out,true)."</pre>";
						    	echo $out->toString();

						    ?>
					      </div>
						</div>
				      </div>
			      </div>
			      
			      
			      <div class="row">
				      <div class="panel panel-default">
						<div class="panel-heading" style="text-align:center;">
							Side-by-side comparison
						</div>
						<div class="panel-body col-md-12">
						    <div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Current Version:
									</div>
									<div class="panel-body">
										<?php echo $section->description; ?>
									</div>
								</div>
						    </div>
						    <div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Old Version:
									</div>
									<div class="panel-body">
										<?php echo $v->description; ?>
									</div>
								</div>
						    </div>
						</div>
					  </div>
			      </div>

			      
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
	<?php
endforeach;
