<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers;
use App\User;
use DB;
use Auth;
use Hash;
use Validator;


class AccountController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}

    /**
     * Show a list of all available flights.
     *
     * @return Response
     */
    public function index()
    {
		$activities = array();
		
		/* Fetch all projects this user owns, and use:
			Created
			Shared w/ another
		   Fetch all projects this user belongs to and use:
		    Created
			Shared w/ me
			Shared w/ another
		*/
		$projects = Auth::user()->all_projects();
		foreach ($projects as $project) {
			//echo "<PRE>".print_R($project,true)."</pre>";
			$p_ts = strtotime($project->created_at);
            if (strlen($project->user->name)) {
                $activities[$p_ts]['text'] = '<a href="mailto:'.$project->user->email.'">'.$project->user->name.'</a> created <a href="/account/project/details/'.$project->id.'/'.strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)).'">'.$project->title.'</a>.';
                $activities[$p_ts]['user_image'] = $project->user->image_url;
                $activities[$p_ts]['project_image'] = $project->image_url;
                $activities[$p_ts]['project_title'] = $project->title;
                $activities[$p_ts]['project_description'] = $project->description;
                $activities[$p_ts]['project_link'] = '/account/project/details/'.$project->id.'/'.strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title));
            }
			
			//echo "<PRE>".print_R($project->users,true)."</pre>";
			foreach ($project->users as $u) {
                if (strlen($u->name)) {
                    $ts = strtotime($u->getOriginal()['pivot_created_at']);
                    $activities[$ts]['text'] = '<a href="mailto:'.$u->email.'">'.$u->name.'</a> was invited to collaborate on <a href="/account/project/details/'.$project->id.'/'.strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title)).'">'.$project->title.'</a>';
                    //echo "<PRE>".print_R($u,true)."</pre>";
                    $activities[$ts]['user_image'] = $u->image_url;
                    $activities[$ts]['project_image'] = $project->image_url;					
                    $activities[$ts]['project_title'] = $project->title;
                    $activities[$ts]['project_description'] = $project->description;
                    $activities[$ts]['project_link'] = '/account/project/details/'.$project->id.'/'.strtolower(preg_replace('%[^a-z0-9_-]%six','-', $project->title));
                }
				//echo "<PRE>".print_R(get_class_methods($u),true)."</pre>";
				//echo "<PRE>".print_R($u->getOriginal()['pivot_created_at'],true)."</pre>";
			
			}
			
		}

		krsort($activities);
		//echo "<PRE>".print_R($activities,true).'</pre>';
		   
        return view('account.index', ['activities' => $activities]);
    }
    
    public function getSettings()
    {
	    //return view('project.edit', ['section_templates' => $st, 'project' => new Project]);
	    return view('account.settings');
    }
    
    public function activity()
    {
	    $within = 3600;
		$activity = Auth::user()->latest_activity($within);
	    return view('account.activity', ['activity' => $activity]);
    }
    
    public function postSettings(Request $request)
    {
	    // Only allow the user to update themselves.
	    $auth_user = Auth::user();
	    
	    $user = User::find($auth_user->id);
	    
	    // Grab all the input
		$input = $request->all();
		if (!strlen($input['password'])) {
			// If they left the password blank, don't update it.
			$input['password'] = $user->password;
		}
		else {
			$input['password'] = Hash::make($input['password']);
		}
		
	    $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ]);
        
	    if ($request->hasFile('profile_photo')) {
		    $imageName = $user->id . '.' . $request->file('profile_photo')->guessExtension();
	
		    $request->file('profile_photo')->move(
		        base_path() . '/public/images/accounts/', $imageName
		    );
		    
		    $user->image_url = '/images/accounts/'.$imageName;
		    $user->save();
		}

	    $user->fill($input)->save();
	    
	    return redirect()->back();
    }
    
}
