<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Project;
use App\SectionTemplate;
use App\ProjectSection;
use App\ProjectSectionVersion;
use App\ProjectAsset;
use App\User;
use App\Http\Controllers;
use Auth;
use Validator;
use PhonegapBuildApi;
use GrahamCampbell\GitHub\Facades\GitHub;
use Icap\HtmlDiff\HtmlDiff;


class ProjectController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	
    public function index()
    {
        return view('project.index');
    }
    
    public function view($id, $title)
    {
	    $project = Project::find($id);
	    
	    return view('project.view', ['project' => $project]);
    }

    
    public function getExport($id)
    {
	    $project = Project::find($id);
		
		foreach ($project->project_sections as $s) {
			if (!strlen($s->audio_file_url) || $s->audio_file_needs_update) {
				// Generate the audio file
				$ch = curl_init();
				
				//set the url, number of POST vars, POST data
				curl_setopt($ch, CURLOPT_URL, 'http://api.montanab.com/tts/tts.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
                if (strlen($s->phonetic_description)) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.strip_tags($s->title . " " . $s->phonetic_description));
                }
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.strip_tags($s->title . " " . $s->description));
                }
				
				//execute post
				$result = json_decode(curl_exec($ch));
				
				$s->audio_file_url = $result->fn;
				$s->audio_file_needs_update = false;
				$s->save();
			}
		}
		return view('project.export', ['project' => $project]);
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
	    if ($project->user->id != Auth::user()->id) {
		    return response()->json([ 'status' => false ]);
		}

	    $project = Project::find($project_id);
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

		//echo "<PRE>"."/account/project/assets/".$request->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $p->title))."</pre>";exit;

		if ($request->hasFile('asset')) {
            
            $request->file('asset')->move(
                base_path() . '/public/assets/projects/' . $request->project_id . '/assets/', $_FILES['asset']['name']
            );

			$pa = ProjectAsset::create(
				[
					'project_id' => $request->project_id,
					'user_id' => Auth::user()->id, 
					'title' => $_FILES['asset']['name'],
					'description' => '',
					'priority' => 1
				]
			);
			$pa->save();   
        }
		return redirect("/account/project/assets/".$request->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $p->title)));
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
    
    public function getSection($project_id, $project_section_id)
    {
		$project = Project::find($project_id);
		if (!$project) {
			abort(404);
		}
		$ps = ProjectSection::find($project_section_id);
		//echo '<PRE>'.print_R($ps->project_section_versions,true)."</pre>";exit;
		$sections = buildTree($project->project_sections, 'project_section_id');
	    return view('project.section', ['sections' => $sections, 'section' => $ps, 'project' => $project]);
    }
    
    public function postSection(Request $request)
    {
		$ps = ProjectSection::find($request->project_section_id);
		
		// Save a version of this section with timestamps. Only save if the section is different enough.
		if (
			$request->description != $ps->description || 
			$request->phonetic_description != $ps->phonetic_description || 
			$request->title != $ps->title || 
			$request->notes != $ps->notes ||
			$request->audio_file_url != $ps->audio_file_url
			) {
			
			/*
					       $table->increments('id');
           $table->string('project_section_id');
	       $table->integer('project_id');
	       $table->string('title');
	       $table->text('description')->nullable();
	       $table->text('phonetic_description')->nullable();
	       $table->string('notes');
	       $table->string('audio_file_url')->nullable();
	       $table->boolean('audio_file_needs_update')->default(true);
	       $table->integer('sort_order')->nullable()->unsigned();
	       $table->boolean('completed')->default(false);
	       $table->boolean('deleted')->default(false);
	       $table->boolean('version')->default(1);
	       $table->timestamps(); 
	       $table->string('image_url');
	       $table->string('original_image');
	       $table->tinyInteger('has_image_rights')->default(0);
				*/
			$psv = ProjectSectionVersion::create(
				[
					'project_section' => $ps->project_section_id,
					'project_section_id' => $ps->id, 
					'project_id' => $ps->project_id,
					'title' => trim($ps->title), 
					'description' => $ps->description,
					'phonetic_description' => $ps->phonetic_description,
					'notes' => $ps->notes,
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
		
        if ($request->hasFile('section_image')) {
            $imageName = $ps->id . '.' . $request->file('section_image')->guessExtension();

            $request->file('section_image')->move(
                base_path() . '/public/assets/projects/' . $request->project_id . '/sections/', $imageName
            );

            $ps->image_url = '/assets/projects/' . $request->project_id . '/sections/' . $imageName;
            $ps->original_image = '/assets/projects/' . $request->project_id . '/sections/' . $imageName;
			$ps->has_image_rights = 1;
        }

		if ($ps->description != $request->description || $ps->title != $request->title) {
			// Generate the audio file
			$ch = curl_init();
			
			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, 'http://api.montanab.com/tts/tts.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
            if (strlen($request->phonetic_description)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.strip_tags($request->title . " " . $request->phonetic_description));
            }
            else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.strip_tags($request->title . " " . $request->description));
            }
			
			//execute post
			$result = json_decode(curl_exec($ch));
			
			$ps->audio_file_url = $result->fn;
			$ps->audio_file_needs_update = false;
		}
		$ps->description = $request->description;
		$ps->title = trim($request->title);

		if ($ps->phonetic_description != $request->phonetic_description || $ps->title != $request->title) {
			// Generate the audio file
			$ch = curl_init();
			
			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, 'http://api.montanab.com/tts/tts.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
            if (strlen($request->phonetic_description)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.strip_tags($request->title . " " . $request->phonetic_description));
            }
            else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.strip_tags($request->title . " " . $request->description));
            }
			
			//execute post
			$result = json_decode(curl_exec($ch));
			
			$ps->audio_file_url = $result->fn;
			$ps->audio_file_needs_update = false;
		}
		$ps->phonetic_description = $request->phonetic_description;

		$ps->notes = $request->notes;

		$ps->save();
	    //return redirect()->back();
		return redirect("/account/project/toc/".$ps->project_id."/".strtolower(preg_replace('%[^a-z0-9_-]%six','-', $ps->project_id)));
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
					    //echo "<PRE>p ".print_r($parent,true)."</pre>";
					    if (isset($parent->children)) {
						    foreach ($parent->children[0] as $child) {
							    //echo "<PRE>c ".print_r($child,true)."</pre>";exit;
							    if (isset($child->sectionId)) {
		    	    				$child_ps = ProjectSection::find($child->sectionId);
									$child_ps->sort_order = $sort_order++;
									$child_ps->project_section_id = $parent->sectionId;
									//echo "<PRE>".print_R($child_ps,true)."</pre>";exit;
									$child_ps->save();
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
		return redirect()->back();
	}    
	
	public function postCompleted(Request $request)
	{
		$ps = ProjectSection::find($request->id);
		$ps->completed = $request->completed;
		$ps->save();
		return response()->json([ 'status' => true ]);
	}
	
	public function postDeleted(Request $request)
	{
		$ps = ProjectSection::find($request->id);
		$ps->deleted = $request->deleted;
		$ps->save();
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
