<?php

$link = mysqli_connect('localhost', 'unidescription', 'Td#vx222', 'unidescription');

$project_ids = array();
$projects_he_has = array();

$q = $link->query("SELECT * FROM project_user WHERE user_id = 24");
while ($qd = $q->fetch_assoc()) {
   $projects_he_has[$qd['project_id']] = true;
}


$q = $link->query("SELECT * FROM projects");
while ($qd = $q->fetch_assoc()) {
    if ($qd['user_id'] == 24) {
        $projects_he_has[$qd['id']] = true;
    }

    if (!array_key_exists($qd['id'], $projects_he_has)) {
        echo "INSERT INTO project_user (project_id, user_id, can_edit, created_at, updated_at) VALUES ($qd[id], 24, 1, NOW(), NOW())\n";
        $link->query("INSERT INTO project_user (project_id, user_id, can_edit, created_at, updated_at) VALUES ($qd[id], 24, 1, NOW(), NOW())");
    }
    else {
        // Nothing to do.
    }
}
