<?php
header('Content-Type: application/json');
echo '{"project":'.$project->toJson().'}';
exit;
//echo print_r(json_decode($project->toJson(),true));exit;
