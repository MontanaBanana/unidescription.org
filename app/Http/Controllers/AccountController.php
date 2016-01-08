<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers;
use App\User;
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
        return view('account.index');
    }
    
    public function getSettings()
    {
	    //return view('project.edit', ['section_templates' => $st, 'project' => new Project]);
	    return view('account.settings');
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