<?php
if (count($section->project_section_versions)):
?>

<div class="panel panel-default">
    <div class="panel-heading">Revision History:</div>
    <div class="panel-body">
        <div class="version">
			<?php
                $count = 0;
				foreach ($section->project_section_versions->reverse() as $v) {
                    if ($count++ > 10) {
                        break;
                    }

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

$count = 0;
foreach ($section->project_section_versions as $v):
        if ($count++ > 10) {
            break;
        }
	?>
	
	<script>
	jQuery(function(){
		jQuery("#tabs_<?php echo $v->id;?>").tabs();
	});
	</script>
	
		<div class="modal fade" id="<?php echo $v->id; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php $v->id; ?>Label">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
			  <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="<?php $v->id; ?>Label">Revision on <?php echo $v->created_at->addHours(-7)->format('D, d M Y h:i:s'); ?></h4>
		      </div>
		      <div class="modal-body">

				<div class="row">
				  	  
					<div id="tabs_<?php echo $v->id;?>">
						<?php
							$l = array(
								array('name'=>'Component Name', 'column'=>'title'),
								array('name'=>'Phonetic Component Name', 'column'=>'phonetic_title'),
								array('name'=>'Description', 'column'=>'description'),
								array('name'=>'Phonetic Description', 'column'=>'phonetic_description'),
								array('name'=>'Notes', 'column'=>'notes'),
							);
						?>
						<ul>
							<?php
								foreach($l AS $t){
									if(trim($v->{$t['column']}) != trim($section->{$t['column']})){$this_bold = 'style="font-weight:bold"';}else{$this_bold = FALSE;}
									echo '<li><a href="#tab_'.$v->id.'_'.$t["column"].'" class="tab_'.$v->id.'_'.$t["column"].'"'.$this_bold.'>'.$t['name'].'</a></li>';
								}
							?>
						</ul>
						
						<?php foreach($l AS $t){ ?>
							
							<div id="tab_<?php echo $v->id;?>_<?php echo $t["column"];?>">
								<div class="row">							
									<h3 style="text-align:center"><?php echo $t['name'];?></h3>
									<div class="panel panel-default">
										<div class="panel-heading" style="text-align:center;">
											Changed Text Diff
										</div>
										<div class="panel-body col-md-12">
											<div class="col-md-12">
												<?php 
													$htmlDiff = new Icap\HtmlDiff\HtmlDiff($v->{$t['column']}, $section->{$t['column']}, true);
													$out = $htmlDiff->outputDiff();
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
														Current Version: <i class="fa fa-files-o btn" aria-hidden="true" data-clipboard-target="#content_<?php echo $v->id;?>_current"></i>
													</div>
													<div class="panel-body" id="content_<?php echo $v->id;?>_current">
														<?php echo $section->{$t['column']}; ?>
													</div>
												</div>
										    </div>
										    <div class="col-md-6">
												<div class="panel panel-default">
													<div class="panel-heading">
														Old Version: <i class="fa fa-files-o btn" aria-hidden="true" data-clipboard-target="#content_<?php echo $v->id;?>_old"></i>
													</div>
													<div class="panel-body" id="content_<?php echo $v->id;?>_old">
														<?php echo $v->{$t['column']}; ?>
													</div>
												</div>
										    </div>
										</div>
									</div>
								</div>
							</div>
							
							
						<?php } ?>
						
						
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
?>


<script>
	new Clipboard('.btn');
</script>
