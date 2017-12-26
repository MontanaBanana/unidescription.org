<?php
	
//use App\SectionTemplate;


function title_cmp($a, $b)
{
    if ($a['title'] == $b['title']) {
        return 0;
    }
    return ($a['title'] < $b['title']) ? -1 : 1;
}

	
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
        if ($section->deleted) {
            continue; 
        }

		$total++;

		if ($section->completed && !$section->deleted) {
			$completed++;
		}
		if ($section->children) {
			foreach ($section->children as $child) {
				if ($child->deleted) {
					$total--;
				}
				$total++;

				if ($child->completed && !$child->deleted) {
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
	if ($section_template) {
		return $section_template->description;
	}
	return '';

}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
}

function replace_string_in_file($filename, $string_to_replace, $replace_with) {
    $content=file_get_contents($filename);
    $content_chunks=explode($string_to_replace, $content);
    $content=implode($replace_with, $content_chunks);
    file_put_contents($filename, $content);
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[1])); 
    fclose($ifp); 

    return $output_file; 
}

// creates a compressed zip file 
// From https://davidwalsh.name/create-zip-php
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


function timeAgo($time_ago) {
	$time_ago =  strtotime($time_ago) ? strtotime($time_ago) : $time_ago;
    $time  = time() - $time_ago;
	switch($time):
		// seconds
		case $time <= 60; return 'less than a minute ago'; break;
		// minutes
		case $time >= 60 && $time < 3600; return (round($time/60) == 1) ? 'a minute ago' : round($time/60).' minutes ago'; break;
		// hours
		case $time >= 3600 && $time < 86400; return (round($time/3600) == 1) ? 'a hour ago' : round($time/3600).' hours ago'; break;
		// days
		case $time >= 86400 && $time < 604800; return (round($time/86400) == 1) ? 'a day ago' : round($time/86400).' days ago'; break;
		// weeks
		case $time >= 604800 && $time < 2600640; return (round($time/604800) == 1) ? 'a week ago' : round($time/604800).' weeks ago'; break;
		// months
		case $time >= 2600640 && $time < 31207680; return (round($time/2600640) == 1) ? 'a month ago' : round($time/2600640).' months ago'; break;
		// years
		case $time >= 31207680; return (round($time/31207680) == 1) ? 'a year ago' : round($time/31207680).' years ago' ; break;
	endswitch;
}
