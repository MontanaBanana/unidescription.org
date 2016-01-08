<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Project;
use App\SectionTemplate;
use App\ProjectSection;
use App\User;
use App\Http\Controllers;
use Auth;
use Validator;

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
				curl_setopt($ch, CURLOPT_POSTFIELDS, 't='.$s->description);
				
				//execute post
				$result = json_decode(curl_exec($ch));
				
				$s->audio_file_url = $result->fn;
				$s->audio_file_needs_update = false;
				$s->save();
			}
		}
		return view('project.export', ['project' => $project]);
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
				error_reporting(E_ALL);
				ini_set('display_errors', true);
				
		        Mail::send('emails.invited', ['user' => $new_user, 'invited_by' => $invited_by, 'password' => $password, 'project' => $project], function ($m) use ($new_user, $invited_by, $project) {
		            $m->from('support@unidescription.com', 'UniDescription');
		            $m->to($new_user->email, $new_user->email)->subject('UniDescription - ' . $project->title . ' shared with you');
		        });
			}
		}

		return response()->json( ['status' => true, 'users' => $project->users ]);
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
							if ($ps->description != $v) {
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