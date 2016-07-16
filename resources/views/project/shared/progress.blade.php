<div class="panel panel-default">
    <div class="panel-heading">Project Progress:</div>
    <div class="panel-body">
        <div class="progress">
            <?php $percent = get_project_completion_percentage($sections); ?>
            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent; ?>%;">
                <?php echo $percent; ?>%
            </div>
        </div>
    </div>
</div>
