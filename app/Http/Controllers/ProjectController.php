<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Illuminate\Http\Request;
use App\Library;
use App\Project;
use App\SectionTemplate;
use App\ProjectSection;
use App\ProjectSectionVersion;
use App\ProjectTodo;
use App\ProjectAsset;
use App\User;
use App\Http\Controllers;
use Response;
use Auth;
use Input;
use Validator;
use PhonegapBuildApi;
use GrahamCampbell\GitHub\Facades\GitHub;
use Icap\HtmlDiff\HtmlDiff;


class ProjectController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth', ['except' => array('getZip', 'getExport', 'getJsonExport', 'getTextExport', 'getNpsProjects')]);
	}
	
    private function _cleanText($text)
    {
        $text = preg_replace("/<p>/", "", $text);
        $text = preg_replace("/<\/p>/", "\n", $text);
        $text = preg_replace("/&nbsp;/", " ", $text);
        $text = strip_tags($text);
        return $text;
    }
    
	public function index(Request $request, $sortBy = null, $direction = null)
	{
		return view('project.index', ['sortBy' => $sortBy, 'direction' => $direction]);
	}
    
    public function view($id, $title)
    {
	    $project = Project::find($id);
	    
	    return view('project.view', ['project' => $project]);
    }

    public function getZip($id)
    {
	    $project = Project::find($id);
		
		$fn = $_SERVER['DOCUMENT_ROOT'].'/projects/zips/'.$project->title.'.html';
		$html = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/account/project/export/'.$id);
		if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/projects/zips/')) {
			mkdir($_SERVER['DOCUMENT_ROOT'].'/projects/zips/');
		}
		file_put_contents($fn, $html);

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($fn));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($fn));
		ob_clean();
		flush();
		readfile($fn);
		exit;
		//echo "<PRE>".print_R($_SERVER,true)."</pre>";exit;
		//return view('project.export', ['project' => $project]);
    }

    public function getNpsProjects()
    {
        $name_items = array(
                    array('id' => '281', 'title' => 'About Us - The UniDescription Project'),
                    array('id' => '97', 'title' => 'Cabrillo National Monument - California'),
                    array('id' => '141', 'title' => 'Cape Cod National Seashore - Massachusetts'),
                    array('id' => '124', 'title' => 'César E. Chávez National Monument - California'),
                    array('id' => '125', 'title' => 'Channel Islands National Park - California'),
                    array('id' => '101', 'title' => 'Denali National Park and Preserve - Alaska'),
                    array('id' => '256', 'title' => 'Devils Postpile National Monument - California'),
                    array('id' => '257', 'title' => 'Eugene O\'Neill National Historic Site - California'),
                    array('id' => '103', 'title' => 'Everglades National Park - Florida'),
                    array('id' => '154', 'title' => 'Flight 93 National Memorial - Pennsylvania'),
                    array('id' => '275', 'title' => 'Fort Point National Historic Site - California'),
                    array('id' => '126', 'title' => 'Fort Smith National Historic Site - Arkansas'),
                    array('id' => '143', 'title' => 'Fort Stanwix National Monument - New York'),
                    array('id' => '89', 'title' => 'Fort Vancouver National Historic Site - Washington'),
                    array('id' => '144', 'title' => 'Gates of the Arctic National Park and Preserve - Alaska'),
                    array('id' => '128', 'title' => 'George Washington Memorial Parkway - Virginia, Maryland, District of Columbia'),
                    array('id' => '76', 'title' => 'Golden Gate National Recreation Area - California'),
                    array('id' => '136', 'title' => 'Hagerman Fossil Beds National Monument - Idaho'),
                    array('id' => '123', 'title' => 'Harry S Truman National Historic Site - Missouri'),
                    array('id' => '252', 'title' => 'Hawaii Volcanoes National Park - Hawaii'),
                    array('id' => '107', 'title' => 'Herbert Hoover National Historic Site - Iowa'),
                    array('id' => '145', 'title' => 'Home of Franklin D. Roosevelt National Historic Site - New York'),
                    array('id' => '142', 'title' => 'Jamestowne at Colonial National Historical Park - Virginia'),
                    array('id' => '99', 'title' => 'John Day Fossil Beds National Monument - Oregon'),
                    array('id' => '277', 'title' => 'John Muir National Historic Site - California'),
                    array('id' => '146', 'title' => 'Johnstown Flood National Memorial - Pennsylvania'),
                    array('id' => '102', 'title' => 'Joshua Tree National Park - California'),
                    array('id' => '131', 'title' => 'Katmai National Park and Preserve - Alaska'),
                    array('id' => '258', 'title' => 'Lava Beds National Monument - California'),
                    array('id' => '254', 'title' => 'Lassen Volcanic National Park - California'),
                    array('id' => '132', 'title' => 'Lowell National Historical Park - Massachusetts'),
                    array('id' => '133', 'title' => 'Manzanar National Historic Site - California'),
                    array('id' => '147', 'title' => 'Minute Man National Historical Park - Massachusetts'),
                    array('id' => '134', 'title' => 'Morristown National Historical Park - New Jersey'),
                    array('id' => '276', 'title' => 'Muir Woods National Monument - California'),
                    array('id' => '149', 'title' => 'New River Gorge National River - West Virginia'),
                    array('id' => '53', 'title' => 'NPS System Map and Guide - District of Columbia'),
                    array('id' => '270', 'title' => 'NPS Unigrid Guide - District of Columbia'),
                    array('id' => '267', 'title' => 'Pinnacles National Park - California'),
                    array('id' => '261', 'title' => 'Point Reyes National Seashore - California'),
                    array('id' => '273', 'title' => 'Port Chicago Naval Magazine National Memorial - California'),
                    array('id' => '94', 'title' => 'Pu‘ukohola Heiau National Historic Site - Hawaii'),
                    array('id' => '262', 'title' => 'Redwood National Park - California'),
                    array('id' => '271', 'title' => 'Rosie the Riveter/World War II Home Front National Historic Park - California'),
                    array('id' => '92', 'title' => 'San Francisco Maritime National Historical Park - California'),
                    array('id' => '108', 'title' => 'Sitka National Historical Park - Alaska'),
                    array('id' => '150', 'title' => 'Statue of Liberty National Monument - New York, New Jersey'),
                    array('id' => '122', 'title' => 'Steamtown National Historic Site - Pennsylvania'),
                    array('id' => '93', 'title' => 'Thomas Edison National Historical Park - New Jersey'),
                    array('id' => '151', 'title' => 'Valley Forge National Historical Park - Pennsylvania'),
                    array('id' => '242', 'title' => 'Washington Monument - District of Columbia'),
                    array('id' => '274', 'title' => 'Whiskeytown—Shasta—Trinity National Recreation Area - California'),
                    array('id' => '152', 'title' => 'Women\'s Rights National Historical Park - New York'),
                    array('id' => '91', 'title' => 'Yellowstone National Park - Wyoming, Idaho, Montana'),
                    array('id' => '266', 'title' => 'Yosemite National Park - California'),
        );

        $state_items = [];
        foreach ($name_items as $ni) {
            $si = $ni;
            $si['title'] = preg_replace("/(^[^-]*) - (.*$)/", '\2 - \1', $si['title']);
            $state_items[] = $si;
        }

        $type_items = [];
        foreach ($name_items as $ni) {
            $ti = $ni;
            if (preg_match("/(^.*) (National Seashore) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";
            }
            elseif (preg_match("/(^.*) (National Monument) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Park) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Park and Preserve) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Memorial) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Historic Site) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Historic Park) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (Memorial Parkway) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Military Park) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Recreation Area) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National Historical Park) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (Monument) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (National River) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";

            }
            elseif (preg_match("/(^.*) (System Map and Guide) - (.*$)/", $ti['title'], $m)) {
                $ti['title'] = "$m[2] - $m[1] - $m[3]";
            }
            elseif (preg_match("/NPS Unigrid Guide - (.*$)/", $ti['title'], $m)) {
                //array('id' => '270', 'title' => 'NPS Unigrid Guide - District of Columbia'),
                $ti['title'] = $ti['title'];
            }
            else {
                //echo "Fix: $ti[title]";
                $ti['title'] = $ti['title'];
            }
            $type_items[] = $ti;
        }

        usort($state_items, "title_cmp");
        usort($type_items, "title_cmp");

        echo json_encode(array(
            'name' => $name_items,
            'state' => $state_items,
            'type' => $type_items
        ));
        exit;
    }

    
    public function getTextExport($id)
    {
	    $project = Project::find($id);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/projects/'.preg_replace("/\s+/", '_', $project->title).'.txt', view('project.export_text', ['project' => $project]));
		return Response::download($_SERVER['DOCUMENT_ROOT'].'/projects/'.preg_replace("/\s+/", '_', $project->title).'.txt');
    }
    
    public function getExport($id)
    {
	    $project = Project::find($id);
		
		foreach ($project->project_sections as $s) {
			if (!strlen($s->audio_file_title) || $s->audio_file_needs_update){
				//////////////////////////////////
				// Generate the TITLE audio file
				//////////////////////////////////
				$ch = curl_init();
	
				$text = $s->phonetic_title ? $s->phonetic_title : $s->title;
                $text = $this->_cleanText($text);
				//$text = preg_replace("/(<([^>]+)>)/i", '', $text);
				//$text = preg_replace("/&#?[a-zA-Z0-9]{2,8};/", '', $text);

				curl_setopt($ch, CURLOPT_URL, 'https://api.montanab.com/tts/tts.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
                if (strlen($s->phonetic_title)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text.'&use_library=false');
                }
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text);
                }
				
				$result = json_decode(curl_exec($ch));
				
				$s->audio_file_title = $result->fn;
				$s->audio_file_needs_update = false;
				$s->audio_file_url = '';
				$s->save();
			}
			if (!strlen($s->audio_file_description) || $s->audio_file_needs_update){
				//////////////////////////////////
				// Generate the DESCRIPTION audio file
				//////////////////////////////////
				$ch = curl_init();
	
				$text = $s->phonetic_description ? $s->phonetic_description : $s->description;
                $text = $this->_cleanText($text);
				
				curl_setopt($ch, CURLOPT_URL, 'https://api.montanab.com/tts/tts.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
                if (strlen($s->phonetic_description)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text.'&use_library=false');
                }
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text);
                }
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				
				$result = json_decode(curl_exec($ch));
				
				$s->audio_file_description = $result->fn;
				$s->audio_file_needs_update = false;
				$s->audio_file_url = '';
				$s->save();
			}
		}
		return view('project.export', ['project' => $project]);
    }

    public function getJsonExport($id)
    {
	    $project = Project::find($id);
		
		foreach ($project->project_sections as $s) {
			if (!strlen($s->audio_file_title) || $s->audio_file_needs_update){
				//////////////////////////////////
				// Generate the TITLE audio file
				//////////////////////////////////
				$ch = curl_init();
	
				$text = $s->phonetic_title ? $s->phonetic_title : $s->title;
                $text = $this->_cleanText($text);
				//$text = preg_replace("/(<([^>]+)>)/i", '', $text);
				//$text = preg_replace("/&#?[a-zA-Z0-9]{2,8};/", '', $text);

				curl_setopt($ch, CURLOPT_URL, 'https://api.montanab.com/tts/tts.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
                if (strlen($s->phonetic_title)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text.'&use_library=false');
                }
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text);
                }
				
				$result = json_decode(curl_exec($ch));
				
				$s->audio_file_title = $result->fn;
				$s->audio_file_needs_update = false;
				$s->audio_file_url = '';
				$s->save();
			}
			if (!strlen($s->audio_file_description) || $s->audio_file_needs_update){
				//////////////////////////////////
				// Generate the DESCRIPTION audio file
				//////////////////////////////////
				$ch = curl_init();
	
				$text = $s->phonetic_description ? $s->phonetic_description : $s->description;
                $text = $this->_cleanText($text);
				
				curl_setopt($ch, CURLOPT_URL, 'https://api.montanab.com/tts/tts.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
                if (strlen($s->phonetic_description)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text.'&use_library=false');
                }
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text);
                }
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				
				$result = json_decode(curl_exec($ch));
				
				$s->audio_file_description = $result->fn;
				$s->audio_file_needs_update = false;
				$s->audio_file_url = '';
				$s->save();
			}
		}
		return view('project.export_json', ['project' => $project]);
    }
    
    public function getBuildIndex(Request $request, $id)
    {
	    // This will start the process of building the app through PG build...
	    // First step is to do some sanity checks...
	    $project = Project::find($id);
	    $owner = User::find($project->user_id);
	    if (!$owner->pg_build_code || !$owner->pg_build_access_token) {
		    // The owner of this project needs to authorize us w/ PG build
		    if ($owner->id == Auth::user()->id) {
			    // They own this project, so just send them through the PG build auth process
		    	header('Location: ' . SITEROOT . '/phonegapbuild/authorize');
		    	exit;
		    }
		    else {
			    // They don't own the project, so give them a message as to why they can't do this
		    	return view('project.authorize', ['project' => $project, 'owner' => $owner]);
		    }
	    }

        // Create a new branch of the master template in github
        $project->create_github_branch();
        // Now, update the assets from the template
        $project->create_build_assets();
	    
	    // If we're here, then the owner of this project has a PG Build access token.
	    // So, let's do some stuff on their behalf.
	    $api = new PhonegapBuildApi($owner->pg_build_access_token);
	    
	    // See if this project already has been created
	    $was_created = false;
	    if (! $project->pg_build_application_id) {
			// Not yet created, so create it.
			$was_created = true;

			$res = $api->createApplicationFromRepo('https://github.com/MontanaBanana/unidescription-projects', array(
			  'title' => 'Not used (it uses the config.xml title)',
			  'private' => false,
			  'hydrates' => true,
              'share' => true,
              'tag' => $project->github_branch // replace with real branch name
			  // see docs for all options
			));

					
		    if ($api->success()) {
    			$project->pg_build_application_id = $res['id'];
				$project->pg_build_version = $res['version'];  
				$project->save();
		    }
		    else {
			    echo "Error: " . $api->error();
			    exit;
		    }
	    }
	    
	    $pg_build = $api->getApplication( $project->pg_build_application_id );
	    if ($api->success()) {
			//echo "<PRE>".print_R($res,true)."</pre>";
			//exit;
			if (!$was_created) {
				$update_res = $api->updateApplicationFromRepo($project->pg_build_application_id, array(
                    'title' => 'Not used (it uses the config.xml title)',
                    'repo' => 'https://github.com/MontanaBanana/unidescription-projects',
                    'tag' => $project->github_branch // replace with real branch name
				));
			}
		}
		else {
			echo "Error: " . $api->error();
            exit;
		}
		
		//$pg_build['android_download'] = $api->downloadApplicationPlatform($project->pg_build_application_id, \PhonegapBuildApi::ANDROID);
		//$pg_build['ios_download'] = $api->downloadApplicationPlatform($project->pg_build_application_id, \PhonegapBuildApi::IOS);

		return view('project.build', ['project' => $project, 'owner' => $owner, 'pg_build' => $pg_build]);
    }
    
    /**
     * Accept user permission
     *
     * @return Response
     */
    public function changePermissions(Request $request)
    {
	    $project_id = $request->project_id;
	    $user_id = $request->user_id;
	    $can_edit = $request->can_edit;
	    
	    $project = Project::find($project_id);
		if (!$project->id) {
			return response()->json([ 'status' => false ]); exit;
		}
		$user = User::find($user_id);
		if (!$user->id) {
			return response()->json([ 'status' => false ]); exit;
		}
		
		$u = DB::update('UPDATE project_user SET can_edit=:canedit WHERE project_id=:projectid AND user_id=:userid', ['canedit'=>$can_edit, 'projectid'=>$project_id, 'userid'=>$user_id]);
		if($u){
			return response()->json(['status' => true ]);
		}
		else{
			return response()->json(['status' => false ]);
		}
    }    

    /**
     * Accept owner change update
     *
     * @return Response
     */
    public function postChangeOwner(Request $request)
    {
	    //$project_id, $email, $add_or_del,
	    $project_id = $request->project_id;
	    $email = $request->email;
		if (preg_match("/.*<(.*)>/", $email, $m)) {
			$email = $m[1];
		}
		//echo "$email";exit;
	    
	    $project = Project::find($project_id);
		if (!$project->id) {
			return response()->json([ 'status' => false ]);
		}

	    // Only allow the owner of the project to modify the owner
	    if ($project->user->id != Auth::user()->id) {
		    return response()->json([ 'status' => false ]);
		}

	    $project = Project::find($project_id);
		$user = User::where('email', $email)->first();
		
		if ($user && $user->id) {
			// User already exists in the database, good.
            // Lets change the owner
		    $project->user_id = $user->id;	
            $project->save();
		}
		else {
			return response()->json([ 'status' => false ]);
		}

		return response()->json(['status' => true ]);
    }
        
    /**
     * Accept share update, return a list of currently shared users.
     *
     * @return Response
     */
    public function postShare(Request $request)
    {
	    //$project_id, $email, $add_or_del,
	    $project_id = $request->project_id;
	    $email = $request->email;
		if (preg_match("/.*<(.*)>/", $email, $m)) {
			$email = $m[1];
		}
		//echo "$email";exit;
	    $add_or_del = $request->add_or_del;

	    $project = Project::find($project_id);
		if (!$project->id) {
			return response()->json([ 'status' => false ]);
		}

	    // Only allow the owner of the project to modify the shared users
        /*
	    if ($project->user->id != Auth::user()->id) {
		    return response()->json([ 'status' => false ]);
		}
         */
	    
		$user = User::where('email', $email)->first();
				
		if ($user && $user->id) {
			// User already exists in the database,
			// now see if they are already shared with this
			// project. Then, add or delete them from the list
			
			if ($user->id == Auth::user()->id) {
				// Don't do anything if we're trying to add or delete
				// the owner of the project
				return response()->json([ 'status' => false ]);
			}
		
			if ($add_or_del == 'add') {
				// Not in the shared users, so add them
				$project->users()->sync([ $user->id ], false);
				
		        Mail::send('emails.shared', ['invited_by' => Auth::user(), 'project' => $project], function ($m) use ($user, $project) {
		            $m->from('support@unidescription.com', 'UniDescription');
		            $m->to($user->email, $user->name)->subject('UniDescription - ' . $project->title . ' shared with you');
		        });
			}
			elseif ($add_or_del == 'del') {
				// del
				$project->users()->detach($user->id);
			}
		}
		else {
			// User doesn't exist on the website and it is an
			// add, so create the user with a random password
			// and email the user with the info.
			if ($add_or_del == 'add') {
				$password = random_str(8);
				$invited_by = Auth::user();
				
				$new_user = User::create([
		            'name' => '',
		            'email' => $email,
		            'password' => bcrypt($password),
		        ]);
				$project->users()->sync([ $new_user->id ], false);
				//error_reporting(E_ALL);
				//ini_set('display_errors', true);
				
		        Mail::send('emails.invited', ['user' => $new_user, 'invited_by' => $invited_by, 'password' => $password, 'project' => $project], function ($m) use ($new_user, $invited_by, $project) {
		            $m->from('support@unidescription.com', 'UniDescription');
		            $m->to($new_user->email, $new_user->email)->subject('UniDescription - ' . $project->title . ' shared with you');
		        });
			}
		}

		return response()->json( ['status' => true, 'users' => $project->users ]);
    }
    
    public function getDetails($project_id)
    {
	    if (!$project_id) {
	    	$sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
		    return view('project.details', ['sections' => $sections, 'project' => new Project]);
	    }
	    else {
			$project = Project::find($project_id);
			if (!$project) {
				abort(404);
			}
			$sections = buildTree($project->project_sections, 'project_section_id');
			return view('project.details', ['sections' => $sections, 'project' => $project]);
		}
    }

	public function postSectionCrop(Request $request)
    {
        $destination_fn = '/assets/projects/' . $request->project_id . '/sections/' . $request->project_section_id . '-cropped.jpg';
        base64_to_jpeg($request->photo, $_SERVER['DOCUMENT_ROOT'].$destination_fn);
		$ps = ProjectSection::find($request->project_section_id);
        $ps->image_url = $destination_fn;
        $ps->save();
        return json_encode( array('status' => 'success', 'file' => $destination_fn) );
    }
    
	public function postDeleteProjectImage(Request $request)
    {
		$p = Project::find($request->project_id);
        $p->image_url = '';
        $p->save();
        return json_encode( array('status' => 'success') );
    }
    
	public function postDeleteImage(Request $request)
    {
		$ps = ProjectSection::find($request->project_section_id);
        $ps->image_url = '';
        $ps->original_image = '';
        $ps->save();
        return json_encode( array('status' => 'success') );
    }
   
	public function postHasImageRights(Request $request)
    {
		$ps = ProjectSection::find($request->project_section_id);
		$ps->has_image_rights = $request->has_image_rights;
        $ps->save();
        return json_encode( array('status' => 'success') );
    }
    
	public function postDetails(Request $request)
    {
	    //echo "<PRE>".print_R($request->all(),true)."</pre>";exit;
	    
        $this->validate($request, [
	        'title' => 'required',
		]);
    
	    if ($request->id) {
		    $project = Project::find($request->id);
		    $project->title = $request->title;
		    $project->description = $request->description;
		    $project->gpo = $request->gpo;
		    $project->version_number = $request->version_number;
		    $project->version = $request->version;
		    $project->author = $request->author;
		    $project->metatags= $request->metatags;
		    $project->publication_date = $request->publication_date;

		    
		    if ($request->hasFile('project_image')) {
			    $imageName = $project->id . '.' . $request->file('project_image')->guessExtension();
		
			    $request->file('project_image')->move(
			        base_path() . '/public/images/projects/', $imageName
			    );
			    
			    $project->image_url = '/images/projects/'.$imageName;
			    $project->save();
			}
		    
			$project_sections = $project->project_sections;
			//foreach ($project_sections as $k => $v) {
				//echo "<PRE>".print_R($v->getAttributes(),true)."</pre>";
				//echo dd($v->getAttributes());
			//}
			//echo "<PRE>".print_R($request->all(),true)."</pre>";exit;
			foreach ($request->all() as $k => $v) {
			    if (preg_match("/section-(\d+)-description/", $k, $m)) {
				    $found = false;
					foreach ($project_sections as $ps) {
						if ($ps->id == $m[1]) {
							if ($ps->description != $v || $ps->title != $request->input('section-'.$m[1].'-title')) {
								$ps->audio_file_needs_update = 1;
							}
							$ps->fill(array('description' => $v, 'title' => $request->input('section-'.$m[1].'-title')));
							$ps->save();
							$found = true;
						}
					}
					
					if (!$found) {
					    $parent = $request->input("section-$m[1]-parent");
					    if (!$parent) {
						    $parent = 0;
					    }
						$ps = ProjectSection::create(['project_id' => $project->id, 'description' => $v, 'title' => $request->input('section-'.$m[1].'-title'), 'project_section_id' => $parent]);
						$ps->save();
					}
			    }
		    }
    	    
    	    $project->save();
			return redirect()->back();
		    
	    }
	    else {
		    $project = Project::create([
		    	'title' => $request->title, 
		    	'description' => $request->description,
		    	'user_id' => Auth::user()->id
		    ]);
		    
		    if ($request->hasFile('project_image')) {
			    $imageName = $project->id . '.' . $request->file('project_image')->guessExtension();
		
			    $request->file('project_image')->move(
			        base_path() . '/public/images/projects/', $imageName
			    );
			    
			    $project->image_url = '/images/projects/'.$imageName;
			}
			$project->save();
		    
		    if ($request->chosen_template == 'template-nps') {
			    $sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
				
				$section_template_ids = array();
				foreach ($sections as $idx => $section) {
					$parent_id = 0;
					
					$ps = ProjectSection::create(['project_id' => $project->id, 'title' => $section->title, 'sort_order' => $section->sort_order, 'project_section_id' => 0]);
					$ps->save();
					
					if ($section->children) {
						foreach ($section->children as $child) {
							$ps_child = ProjectSection::create(['project_id' => $project->id, 'title' => $child->title, 'sort_order' => $child->sort_order, 'project_section_id' => $ps->id]);
							$ps_child->save();
						}
					}
				}
			}
			
		    
			return redirect()->action('ProjectController@getToc', [ $project->id, $project->id ]);
	    }
	    

    }
    
    public function getAssets($project_id)
    {
		$project = Project::find($project_id);
		if (!$project) {
			abort(404);
		}
		$sections = buildTree($project->project_sections, 'project_section_id');
		$assets = ProjectAsset::where('project_id', $project_id)->orderBy('priority', 'asc')->get();
		
	    return view('project.assets', ['sections' => $sections, 'project' => $project, 'assets' => $assets]);
    }
    
	public function postAssets(Request $request)
	{
		//echo "<PRE>".print_R($_FILES,true)."</pre>";exit;
		$p = Project::find($request->project_id);
		// NOW UPDATE THE PROJECT updated_at
		$p->updated_at = date("Y-m-d H:i:s", time());
		$p->save();
		
		$files = Input::file('asset');
		$file_count = count($files);
		$uploadcount = 0;
		foreach ($files as $file) {
			$destinationPath = 'uploads';
			$filename = $file->getClientOriginalName();
			$upload_success = $file->move(base_path() . '/public/assets/projects/' . $request->project_id . '/assets/', $filename);
			$uploadcount ++;
			
			
			$pa = ProjectAsset::create(
				[
					'project_id' => $request->project_id,
					'user_id' => Auth::user()->id, 
					'title' => $filename,
					'description' => '',
					'priority' => 1
				]
			);
			$pa->save(); 
		}
		
		return redirect("/account/project/assets/".$request->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $p->title)));
	}
	
	public function postDeleteAsset(Request $request)
	{
		//echo "<PRE>".print_R($_FILES,true)."</pre>";exit;
		//var_dump($request);
		//exit;
		//echo "<PRE>".print_R($request,true)."</pre>";exit;
		$asset = ProjectAsset::find($request->id);
		$asset->delete();
		//echo "<PRE>"."/account/project/assets/".$request->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $p->title))."</pre>";exit;

	    $response_array['status'] = 'success';
	    $response_array['message'] = 'Asset Deleted';
	    header('Content-type: application/json');
		echo json_encode($response_array); exit;
		
		//return redirect("/account/project/assets/".$request->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $p->title)));
	}
	
    public function getDeleteconfirm($id)
    {
	    if (!$id) {
			abort(404);
	    }
	    else {
			$project = Project::find($id);
		    $auth_user = Auth::user();

			if (!$project || $project->user_id != $auth_user->id) {
				abort(404);
			}
		    return view('project.deleteconfirm', ['project' => $project]);
	    }
    }
    
    public function getDelete($id)
    {
	    if (!$id) {
		    abort(404);
	    }
	    else {
			$project = Project::find($id);
		    $auth_user = Auth::user();

			if (!$project || $project->user_id != $auth_user->id) {
				abort(404);
			}
			else {
				$project->delete();
			}
	    }
	    
	    return redirect()->action('ProjectController@index');
    }
    
    public function getEdit($id)
    {
	    if (!$id) {
			$sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
		    return view('project.edit', ['sections' => $sections, 'project' => new Project]);
	    }
	    else {
			$project = Project::find($id);
			if (!$project) {
				abort(404);
			}
			$sections = buildTree($project->project_sections, 'project_section_id');
		    return view('project.edit', ['sections' => $sections, 'project' => $project]);
	    }
    }
    
    public function saveAudioFile($project, $section){
	    $project_data = Project::find($project);
		$section_data = ProjectSection::find($section);
		
		$audio = base64_decode($_POST['link']);
		$title = $_POST['t'];
		
		if(!$project_data OR !$section_data OR !$title OR !$audio){abort(404);}

		//process - but first delete the old file off the server if one exists
	    if($section_data->$title!=''){
		    $old_file = base_path().'/public/audio/'.$section_data->$title;
		    if(file_exists($old_file)){
				if(!unlink($old_file)){
				    $response_array['status'] = 'error';
				    $response_array['message'] = 'Could not delete the existing audio file.';
				    header('Content-type: application/json');
					echo json_encode($response_array); exit;
				}
			}
		}
		
		$filename = str_random(6).'-'.str_slug($project_data->title,'').'-'.str_slug($section_data->title,'').'.wav';
		$file = base_path().'/public/audio/'.$filename;
		
		file_put_contents(base_path().'/public/audio/'.$filename, $audio);
		
		$section_data->$title = $filename;
		$section_data->save();
		
	    $response_array['status'] = 'success';
	    $response_array['message'] = 'Your audio file was saved. This page will refresh. <script>setTimeout(function() { window.location=window.location;},1000);</script>';
	    header('Content-type: application/json');
		echo json_encode($response_array); exit;

	}
	
	
    public function postAudioFile($project, $section, $title, Request $request){
	    
	    $project_data = Project::find($project);
		$section_data = ProjectSection::find($section);
		$type = $title;
		
		if(!$project_data OR !$section_data OR !$title){abort(404);}
		
	    if ($request->hasFile('audio') && $request->file('audio')->isValid()) {
		    if($request->file('audio')->guessExtension()!='wav'){
			    $response_array['status'] = 'error';
			    $response_array['message'] = 'Only audio WAV files can be uploaded.';
			    header('Content-type: application/json');
				echo json_encode($response_array); exit;
		    }
		    else{
			    //process - but first delete the old file off the server if one exists
			    if($section_data->$type!=''){
				    $old_file = base_path().'/public/audio/'.$section_data->$type;
				    if(file_exists($old_file)){
						if(!unlink($old_file)){							
						    $response_array['status'] = 'error';
						    $response_array['message'] = 'Could not delete the existing audio file.';
						    header('Content-type: application/json');
							echo json_encode($response_array); exit;
						}
					}
				}
			    
			    $file = $request->file('audio');
			    $audio_filename = str_random(6).'-'.str_slug($project_data->title, '').'-'.str_slug($section_data->title, '').'.'.$request->file('audio')->guessExtension();
			    $request->file('audio')->move(base_path() . '/public/audio/', $audio_filename);
			    
				$section_data->$title = $audio_filename;
				$section_data->save();
				
			    $response_array['status'] = 'success';
			    $response_array['message'] = 'Your audio file was completed. This page will refresh. <script>setTimeout(function() { window.location=window.location;},1000);</script>';
			    header('Content-type: application/json');
				echo json_encode($response_array); exit;
			}
		}else{
		    $response_array['status'] = 'error';
		    $response_array['message'] = 'You must select an audio WAV file before uploading.';
		    header('Content-type: application/json');
			echo json_encode($response_array); exit;
		}
	}
	
	
    
    public function addAudioFile($project, $section, $title)
    {
		$project_data = Project::find($project);
		$section_data = ProjectSection::find($section);
		
		if(!$project_data OR !$section_data OR !$title){abort(404);}
		
	    if ($project && $section && $title) {
		    return view('project.audio.upload', ['project' => $project, 'section' => $section, 'title' => $title]);
	    }else{
    		abort(404);
    	}
    }
    
    
    public function deleteAudioFile($project, $section, $title)
    {
		$project_data = Project::find($project);
		$section_data = ProjectSection::find($section);

		if(!$project_data OR !$section_data OR !$title){abort(404);}
		
		if($section_data->$title){ 
			$old_file = base_path().'/public/audio/'.$section_data->$title;
	
			$section_data->$title = '';
			$section_data->save();
			
			$section_data = ProjectSection::find($section);
			if($section_data->$title==''){
				if(file_exists($old_file)){
					if(unlink($old_file)){
						$section_data->audio_file_description='';
						$section_data->save();
						$response_array['status'] = 'success';
					    $response_array['message'] = 'Your audio file was deleted.';
					}
					else{					
						$response_array['status'] = 'error';
					    $response_array['message'] = 'The audio file was not deleted.';
					}
				}
				else{				
					$response_array['status'] = 'error';
				    $response_array['message'] = 'The audio file was not found on the server.';
				}
			}
			else{
				$response_array['status'] = 'error';
			    $response_array['message'] = 'The audio file was not deleted from the database.';
			}
		}
		else{
			$response_array['status'] = 'error';
			$response_array['message'] = 'There was no audio file found in the database.';
		}
	    header('Content-type: application/json');
		echo json_encode($response_array); exit;
    }
    
    public function getSection($project_id, $project_section_id)
    {
		$project = Project::find($project_id);
		if (!$project) {
			abort(404);
		}
		$ps = ProjectSection::find($project_section_id);
		
		$was_locked = false;
		if (! $ps->locked) {
			// Lock it.
			$ps->locked = true;
			$ps->locked_by_user_id = Auth::user()->id;
			$ps->locked_at = date('Y-m-d H:i:s');
			$ps->save();
			$was_locked = true;
		}

        if (isset($_GET['force_unlock']) && $_GET['force_unlock'] == 1) {
            $ps->locked = false;
            $ps->save();
            header('Location: /account/project/section/'.$project->id.'/'.$ps->id);
            exit;
        }

        $parent_deleted = true;
        $sort_order = $ps->sort_order;
        $count = 0;
        while ($parent_deleted) {
            if ($count++ > 20) { break; }
            $prev_ps = DB::table('project_sections')
                ->where('project_id', '=', $project_id)
                ->where('sort_order', '<', $sort_order--)
                ->where('deleted', '=', 0)
                ->orderBy('sort_order', 'desc')
                ->first();

            if ($prev_ps) {
                if ($prev_ps->project_section_id == 0 || !$prev_ps->id) {
                    $parent_deleted = false;
                }
                else {
                    // There is a parent, so we need to check if it was deleted.
                    $prev_ps_parent = ProjectSection::find($prev_ps->project_section_id);
                    if ($prev_ps_parent->deleted) {
                        $prev_ps = false;
                    }
                    elseif ($prev_ps_parent->project_section_id) {
                        // There is a parent, so we need to check if it was deleted.
                        $prev_ps_gparent = ProjectSection::find($prev_ps->project_section_id);
                        if ($prev_ps_gparent->deleted) {
                            $prev_ps = false;
                        }
                        else {
                            $parent_deleted = false;
                        }
                    }
                    else {
                        $parent_deleted = false;
                    }
                }
            }
            else {
                $parent_deleted = false;
            }
        }

        $parent_deleted = true;
        $sort_order = $ps->sort_order;
        $count = 0;
        while ($parent_deleted) {
            if ($count++ > 20) { break; }
            $next_ps = DB::table('project_sections')
                ->where('project_id', '=', $project_id)
                ->where('sort_order', '>', $sort_order++)
                ->where('deleted', '=', 0)
                ->orderBy('sort_order', 'asc')
                ->first();

            if ($next_ps) {
                if ($next_ps->project_section_id == 0 || !$next_ps->id) {
                    $parent_deleted = false;
                }
                else {
                    // There is a parent, so we need to check if it was deleted.
                    $next_ps_parent = ProjectSection::find($next_ps->project_section_id);
                    if ($next_ps_parent->deleted) {
                        $next_ps = false;
                    }
                    elseif ($next_ps_parent->project_section_id) {
                        // There is a parent, so we need to check if it was deleted.
                        $next_ps_gparent = ProjectSection::find($next_ps->project_section_id);
                        if ($next_ps_gparent->deleted) {
                            $next_ps = false;
                        }
                        else {
                            $parent_deleted = false;
                        }
                    }
                    else {
                        $parent_deleted = false;
                    }
                }
            }
            else {
                $parent_deleted = false;
            }
        }

        /*
        $next_ps = DB::table('project_sections')
            ->where('project_id', '=', $project_id)
            ->where('sort_order', '>', $ps->sort_order)
            ->where('deleted', '=', 0)
            ->orderBy('sort_order', 'asc')
            ->first();
         */
        //$next_ps = DB::table('project_sections')->where('project_id', $project_id)->where('sort_order', ($ps->sort_order+1))->first();

		//echo '<PRE>'.print_R($ps->project_section_versions,true)."</pre>";exit;
		$sections = buildTree($project->project_sections, 'project_section_id');
	    return view('project.section', ['sections' => $sections, 'section' => $ps, 'project' => $project, 'was_locked' => $was_locked, 'prev_ps' => $prev_ps, 'next_ps' => $next_ps]);
    }
    
    public function postSection(Request $request)
    {
		//return redirect("/account/project/toc/".$ps->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $ps->project_id)));
        if (!isset($request->project_section_id)) {
			return redirect('/account/');
        }
		$ps = ProjectSection::find($request->project_section_id);

		// Save a version of this section with timestamps. Only save if the section is different enough.
		if (
			$request->description != $ps->description || 
			$request->phonetic_description != $ps->phonetic_description || 
			$request->title != $ps->title || 
			$request->phonetic_title != $ps->phonetic_title || 
			$request->notes != $ps->notes ||
			$request->audio_file_url != $ps->audio_file_url
		){
			$psv = ProjectSectionVersion::create(
				[
					'project_section' => $ps->project_section_id,
					'project_section_id' => $ps->id, 
					'project_id' => $ps->project_id,
					'user_id' => Auth::user()->id,
					'title' => trim($request->title), 
					'phonetic_title' => trim($request->phonetic_title),
					'description' => trim($request->description),
					'phonetic_description' => trim($request->phonetic_description),
					'notes' => $request->notes,
					'audio_file_url' => $ps->audio_file_url,
					'audio_file_needs_update' => $ps->audio_file_needs_update,
					'sort_order' => $ps->sort_order,
					'completed' => $ps->completed,
					'deleted' => $ps->deleted,
					'version' => $ps->version,
					'image_url' => $ps->image_url,
					'original_image' => $ps->original_image,
					'has_image_rights' => $ps->has_image_rights
				]
			);
			$psv->save();
		}
		
		$go_back = false;
        if ($request->hasFile('section_image')) {
            $imageName = $ps->id . '.' . $request->file('section_image')->guessExtension();

            $request->file('section_image')->move(
                base_path() . '/public/assets/projects/' . $request->project_id . '/sections/', $imageName
            );

            $ps->image_url = '/assets/projects/' . $request->project_id . '/sections/' . $imageName;
            $ps->original_image = '/assets/projects/' . $request->project_id . '/sections/' . $imageName;
			$ps->has_image_rights = 1;
			$go_back = true;
        }

		//combined the if statement, previous statement was redundant and repeating

		if ($ps->title != $request->title || $ps->description != $request->description || $ps->phonetic_title != $request->phonetic_title || $ps->phonetic_description != $request->phonetic_description) {
			
			//////////////////////////////////
			// Generate the TITLE audio file
			//////////////////////////////////
				if($ps->title != $request->title || $ps->phonetic_title != $request->phonetic_title){
					$ch = curl_init();
				
					$text = $request->phonetic_title ? $request->phonetic_title : $request->title;
                    $text = $this->_cleanText($text);
					
					//$text = preg_replace("/(<([^>]+)>)/i", '', $text);
					//$text = preg_replace("/&#?[a-zA-Z0-9]{2,8};/", '', $text);
					
					curl_setopt($ch, CURLOPT_URL, 'https://api.montanab.com/tts/tts.php');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    if (strlen($request->phonetic_title)) {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text.'&use_library=false');
                    }
                    else {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text);
                    }
					
					$result = json_decode(curl_exec($ch));
					
					$ps->audio_file_title = $result->fn;
				}
			
			//////////////////////////////////
			// Generate the DESCRIPTION audio file
			//////////////////////////////////
				if($ps->description != $request->description || $ps->phonetic_description != $request->phonetic_description){
					$ch = curl_init();
		
					$text = $request->phonetic_description ? $request->phonetic_description : $request->description;
                    $text = $this->_cleanText($text);
					
					//$text = preg_replace("/(<([^>]+)>)/i", '', $text);
					//$text = preg_replace("/&#?[a-zA-Z0-9]{2,8};/", '', $text);
					
					curl_setopt($ch, CURLOPT_URL, 'https://api.montanab.com/tts/tts.php');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    if (strlen($request->phonetic_description)) {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text.'&use_library=false');
                    }
                    else {
                        curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$text);
                    }
					
					$result = json_decode(curl_exec($ch));
					
					$ps->audio_file_description = $result->fn;
				}
			$ps->audio_file_needs_update = true;
		}
		$ps->description = $request->description;
		$ps->title = trim($request->title);
		$ps->phonetic_description = $request->phonetic_description;
		$ps->phonetic_title = $request->phonetic_title;

		$ps->notes = $request->notes;

		$ps->locked = false;
		if ($request->was_autosave == 1) {
			$ps->locked = true; 
			$ps->locked_by_user_id = Auth::user()->id;
			$ps->locked_at = date('Y-m-d H:i:s');
		}
		
		if($ps->save()){
			$p = Project::find($request->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}

        if ($go_back) {
			return redirect('/account/project/section/'.$ps->project_id.'/'.$ps->id);
		}
		return redirect("/account/project/toc/".$ps->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $ps->project_id)));
    }

    public function getArrowToc($id)
    {
	    if (!$id) {
			$sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
		    return view('project.toc', ['sections' => $sections, 'project' => new Project]);
	    }
	    else {
			$project = Project::find($id);
			if (!$project) {
				abort(404);
			}
			$new_sections = 0;
			$sections = buildTree($project->project_sections, 'project_section_id');
			/*if (!count($sections)) {
				$sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
				$new_sections = 1;
			}*/
			//echo "<PRE>".print_R($sections,true)."</pre>";exit;
		    return view('project.arrowtoc', ['sections' => $sections, 'project' => $project, 'new_sections' => $new_sections]);
	    }
	    
    }
    
    public function getToc($id)
    {
	    if (!$id) {
			$sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
		    return view('project.toc', ['sections' => $sections, 'project' => new Project]);
	    }
	    else {
			$project = Project::find($id);
			if (!$project) {
				abort(404);
			}
			$new_sections = 0;
			$sections = buildTree($project->project_sections, 'project_section_id');
			/*if (!count($sections)) {
				$sections = buildTree(SectionTemplate::all()->sortBy('sort_order'), 'section_template_id');
				$new_sections = 1;
			}*/
			//echo "<PRE>".print_R($sections,true)."</pre>";exit;
		    return view('project.toc', ['sections' => $sections, 'project' => $project, 'new_sections' => $new_sections]);
	    }
	    
    }
    
    public function postToc(Request $request)
    {
	    $sort_order = 1;
	    
	    if ($request->id) {
		    if (strlen($request->json_toc)) {
			    $data = json_decode($request->json_toc);
			    if (is_array($data[0])) {
				    //echo "<PRE>".print_r($data[0],true)."</pre>";
				    foreach ($data[0] as $parent) {
					    
	    				$ps = ProjectSection::find($parent->sectionId);
						$ps->sort_order = $sort_order++;
						$ps->project_section_id = 0;
						$ps->save();

					    if (isset($parent->children)) {
						    foreach ($parent->children[0] as $child) {

							    if (isset($child->sectionId)) {
		    	    				$child_ps = ProjectSection::find($child->sectionId);
									$child_ps->sort_order = $sort_order++;
									$child_ps->project_section_id = $parent->sectionId;
									$child_ps->save();

                                    if (isset($child->children)) {
                                        foreach ($child->children[0] as $chch) {
                                            if (isset($chch->sectionId)) {
                                                $chch_ps = ProjectSection::find($chch->sectionId);
                                                $chch_ps->sort_order = $sort_order++;
                                                $chch_ps->project_section_id = $child->sectionId;
                                                $chch_ps->save();

                                                if (isset($chch->children)) {
                                                    foreach ($chch->children[0] as $chchch) {
                                                        $chchch_ps = ProjectSection::find($chchch->sectionId);
                                                        $chchch_ps->sort_order = $sort_order++;
                                                        $chchch_ps->project_section_id = $child->sectionId;
                                                        $chchch_ps->save();

                                                        if (isset($chchch->children)) {
                                                            foreach ($chchch->children[0] as $chchchch) {
                                                                $chchchch_ps = ProjectSection::find($chchchch->sectionId);
                                                                $chchchch_ps->sort_order = $sort_order++;
                                                                $chchchch_ps->project_section_id = $child->sectionId;
                                                                $chchchch_ps->save();

                                                            }
                                                        }

                                                    }
                                                }

                                            }
                                        }
                                    }

								}
						    }
					    }

				    }
			    }
		    }
		}
		//exit;
/*
	    echo "<PRE>".print_R($request->json_toc,true)."</pre>";exit;
	    if ($request->id) {
			foreach ($request->sort_order as $sort_order => $section_id) {
				if ($request->new_sections) {
					//$ps = ProjectSection::create(['project_id' => $request->id, 'title' => $request->title, 'sort_order' => 99]);
				}
				$ps = ProjectSection::find($section_id);
				$ps->sort_order = $sort_order+1;
				$ps->save();
			}

	    }
*/
		
		$p = Project::find($request->id);
		// NOW UPDATE THE PROJECT updated_at
		$p->updated_at = date("Y-m-d H:i:s", time());
		$p->save();
		
		return redirect()->back();
	}    

	public function postTodoAdd(Request $request)
	{
		$pt = ProjectTodo::create(['title' => $request->title, 'user_id' => Auth::user()->id, 'project_id' => $request->project_id]);
        if (isset($request->project_section_id)) {
            $pt->project_section_id = $request->project_section_id;
        }
		if($pt->save()){
			$p = Project::find($request->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}
		return response()->json([ 'status' => true ]);
	}

	public function postTodoUpdate(Request $request)
	{
		$pt = ProjectTodo::find($request->id);
        if ($request->title) {
            $pt->title= $request->title;
        }
        elseif ($request->description) {
            $pt->description = $request->description;
        }
		if($pt->save()){
			$p = Project::find($request->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}
		return response()->json([ 'status' => true ]);
	}

	public function postTodoCompleted(Request $request)
	{
		$pt = ProjectTodo::find($request->id);
		$pt->completed = $request->completed;
		if($pt->save()){
			$p = Project::find($pt->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}
		return response()->json([ 'status' => true ]);
	}
	
	public function postTodoDeleted(Request $request)
	{
		$pt = ProjectTodo::find($request->id);
		$pt->deleted = $request->deleted;
		if($pt->save()){
			$p = Project::find($pt->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}
		return response()->json([ 'status' => true ]);		
	}
	
	public function postCompleted(Request $request)
	{
		$ps = ProjectSection::find($request->id);
		$ps->completed = $request->completed;
		if($ps->save()){
			$p = Project::find($ps->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}
		return response()->json([ 'status' => true ]);
	}
	
	public function postDeleted(Request $request)
	{
		$ps = ProjectSection::find($request->id);
		$ps->deleted = $request->deleted;
		if($ps->save()){
			$p = Project::find($ps->project_id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
		}
		return response()->json([ 'status' => true ]);		
	}
	
	public function postAddSection(Request $request)
	{		
		if (strlen($request->title)) {
			$status = true;
			$ps = ProjectSection::create(['project_id' => $request->project_id, 'project_section_id' => $request->project_section_id, 'title' => $request->title, 'sort_order' => 99]);
		}
		else {
			$status = false;
			$ps = false;
		}
		
		$p = Project::find($request->project_id);
		// NOW UPDATE THE PROJECT updated_at
		$p->updated_at = date("Y-m-d H:i:s", time());
		$p->save();
		
		return response()->json([ 'status' => $status, 'section' => $ps ]);
	}
	        
    public function postEdit(Request $request)
    {
//	    echo "<PRE>".print_R($request->all(),true)."</pre>";exit;
	    if ($request->id) {
		    $project = Project::find($request->id);
		    $project->title = $request->title;
		    $project->description = $request->description;
		    
		    if ($request->hasFile('project_image')) {
			    $imageName = $project->id . '.' . $request->file('project_image')->guessExtension();
		
			    $request->file('project_image')->move(
			        base_path() . '/public/images/projects/', $imageName
			    );
			    
			    $project->image_url = '/images/projects/'.$imageName;
			    $project->save();
			}
		    
			$project_sections = $project->project_sections;
			//foreach ($project_sections as $k => $v) {
				//echo "<PRE>".print_R($v->getAttributes(),true)."</pre>";
				//echo dd($v->getAttributes());
			//}
			//echo "<PRE>".print_R($request->all(),true)."</pre>";exit;
			foreach ($request->all() as $k => $v) {
			    if (preg_match("/section-(\d+)-description/", $k, $m)) {
				    $found = false;
					foreach ($project_sections as $ps) {
						if ($ps->id == $m[1]) {
							if ($ps->description != $v || $ps->title != $request->input('section-'.$m[1].'-title')) {
								$ps->audio_file_needs_update = 1;
							}
							$ps->fill(array('description' => $v, 'title' => $request->input('section-'.$m[1].'-title')));
							$ps->save();
							$found = true;
						}
					}
					
					if (!$found) {
					    $parent = $request->input("section-$m[1]-parent");
					    if (!$parent) {
						    $parent = 0;
					    }
						$ps = ProjectSection::create(['project_id' => $project->id, 'description' => $v, 'title' => $request->input('section-'.$m[1].'-title'), 'project_section_id' => $parent]);
						$ps->save();
					}
			    }
		    }
			$project->updated_at = date("Y-m-d H:i:s", time());
    	    $project->save();
    	    
    	    $p = Project::find($request->id);
			// NOW UPDATE THE PROJECT updated_at
			$p->updated_at = date("Y-m-d H:i:s", time());
			$p->save();
			
			return redirect()->back();
		    
	    }
	    else {
		    $project = Project::create([
		    	'title' => $request->title, 
		    	'description' => $request->description,
		    	'user_id' => Auth::user()->id
		    ]);
		    
		    if ($request->hasFile('project_image')) {
			    $imageName = $project->id . '.' . $request->file('project_image')->guessExtension();
		
			    $request->file('project_image')->move(
			        base_path() . '/public/images/projects/', $imageName
			    );
			    
			    $project->image_url = '/images/projects/'.$imageName;
			}
			$project->save();
		    
		    $sections = array();
		    $sections[0] = 0;
		    
		    foreach ($request->all() as $k => $v) {
			    if (preg_match("/section-(\d+)-description/", $k, $m)) {
				    $template_parent = $request->input("section-$m[1]-parent");
				    if (!$template_parent) {
					    $parent = 0;
				    }
				    else {
					    $parent = $sections[$template_parent];
				    }
				    
				    $ps = ProjectSection::create(['project_id' => $project->id, 'description' => $v, 'title' => $request->input('section-'.$m[1].'-title'), 'project_section_id' => $parent]);
					$ps->save();
					$sections[$m[1]] = $ps->id;
			    }
		    }
		    
			return redirect()->action('ProjectController@index');
	    }
	    

    }
    
}

