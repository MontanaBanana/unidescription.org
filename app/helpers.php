<?php
	
//use App\SectionTemplate;

	
function buildTree(Illuminate\Database\Eloquent\Collection $elements, $parent_column, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element->$parent_column == $parentId) {
            $children = buildTree($elements, $parent_column, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }

    return $branch;
}

function prettyDate($date){
    $time = strtotime($date);
    $now = time();
    $ago = $now - $time;
    if ($ago < 60) {
        $when = round($ago);
        $s = ($when == 1)?"second":"seconds";
        return "$when $s ago";
    } elseif ($ago < 3600) {
        $when = round($ago / 60);
        $m = ($when == 1)?"minute":"minutes";
        return "$when $m ago";
    } elseif ($ago >= 3600 && $ago < 86400) {
        $when = round($ago / 60 / 60);
        $h = ($when == 1)?"hour":"hours";
        return "$when $h ago";
    } elseif ($ago >= 86400 && $ago < 2629743.83) {
        $when = round($ago / 60 / 60 / 24);
        $d = ($when == 1)?"day":"days";
        return "$when $d ago";
    } elseif ($ago >= 2629743.83 && $ago < 31556926) {
        $when = round($ago / 60 / 60 / 24 / 30.4375);
        $m = ($when == 1)?"month":"months";
        return "$when $m ago";
    } else {
        $when = round($ago / 60 / 60 / 24 / 365);
        $y = ($when == 1)?"year":"years";
        return "$when $y ago";
    }
}

function random_str(
    $length,
    $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
) {
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    if ($max < 1) {
        throw new Exception('$keyspace must be at least two characters long');
    }
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

function get_project_completion_percentage($sections)
{
	$total = 0;
	$completed = 0;
	foreach ($sections as $section):
		//echo "<PRE>".print_R($section->all(),true)."</pre>";
		if ($section->deleted) { 
			$total--; 
		}
		
		$total++;
		if ($section->completed) {
			$completed++;
		}
		if ($section->children) {
			foreach ($section->children as $child) {
				if ($child->deleted) {
					$total--;
				}
				$total++;
				if ($child->completed) {
					$completed++;
				}
			}
		}
	endforeach;
	if (!$total) { $total = 1; }
	$percent = floor(($completed / $total) * 100);
	
	return $percent;
}

function get_placeholder_text($section_title)
{
	//ini_set('display_errors', true); error_reporting(E_ALL);
	$section_template = App\SectionTemplate::where('title', $section_title)->first();
	//echo "<PRE>".print_r($section_template,true)."</pre>";exit;
	return $section_template->description;

}