<?php
$link = mysqli_connect('localhost', 'unidescription', 'Td#vx222', 'unidescription');

// 91  -> 278 | TEST - Yellowstone Copy
// 101 -> 279 | TEST - Denali Copy
// 123 -> 280 | TEST - Truman Copy
//$old_project_id = 91;
//$new_project_id = 278;
//$old_project_id = 101;
//$new_project_id = 279;
$old_project_id = 123;
$new_project_id = 280;
exit;

$new_sections = array();

$q = $link->query("SELECT * FROM project_sections WHERE project_id = $old_project_id");
while ($qd = $q->fetch_assoc()) {
    //echo "<PRE>".print_r($qd,true)."</pre>";
    $new_sections[$qd['project_section_id']][] = $qd;
}

$map = array();

//echo "<PRE>".print_r($new_sections,true)."</pre>";
foreach ($new_sections as $project_section_id => $children) {
    foreach ($children as $child) {
        if ($project_section_id == 0) {
            // It's a parent, so just insert and update the map.
            $query = "INSERT INTO project_sections (";
            $values = "(";
            $child['project_id'] = $new_project_id;
            foreach ($child as $k => $v) {
                if ($k != 'id') {
                    $query .= "$k, ";
                    $values .= "'".mysqli_real_escape_string($link, $v)."', ";
                }
            }
            $query = preg_replace("/, $/", '', $query);
            $query .= ")";
            $values = preg_replace("/, $/", '', $values);
            $values .= ")";

            $link->query($query." VALUES ".$values);
            $insert_id = mysqli_insert_id($link);

            $map[$child['id']] = $insert_id;
        }
        else {
            $query = "INSERT INTO project_sections (";
            $values = "(";
            $child['project_id'] = $new_project_id;
            foreach ($child as $k => $v) {
                if ($k != 'id') {
                    if ($k == 'project_section_id') {
                        $v = $map[$v];
                    }
                    $query .= "$k, ";
                    $values .= "'".mysqli_real_escape_string($link, $v)."', ";
                }
            }
            $query = preg_replace("/, $/", '', $query);
            $query .= ")";
            $values = preg_replace("/, $/", '', $values);
            $values .= ")";

            $link->query($query." VALUES ".$values);
        }
    }
}

