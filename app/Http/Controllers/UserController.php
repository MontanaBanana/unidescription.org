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
use PhonegapBuildApi;


class UserController extends Controller
{
    /**
     * Search users.
     *
     * @return Response
     */
    public function search($string)
    {
	    $results = array();
	    $users = User::where('email', 'LIKE', "%$string%")->get();
	    foreach ($users as $user) {
		    $u = array(
			  'id' => $user['id'],
			  'name' => $user['name'],
			  'email' => $user['email']  
		    );
		    $results[] = $u;
	    }
	    return response()->json($results);
    }
    
    public function getBuildCallback(Request $request)
    {
	    //echo "<PRE>".print_R($request->get('code'),true)."</pre>";exit;
		$user = User::find(Auth::user()->id);

		$user->pg_build_code = $request->code;
		$user->save();
		
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, 'https://build.phonegap.com/authorize/token?client_id='.env('PHONEGAP_BUILD_CLIENT_ID').'&client_secret='.env('PHONEGAP_BUILD_CLIENT_SECRET').'&code='.$user->pg_build_code);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id='.env('PHONEGAP_BUILD_CLIENT_ID').'&client_secret='.env('PHONEGAP_BUILD_CLIENT_SECRET').'&code='.$user->pg_build_code );

		
		$result = json_decode(curl_exec($ch));
		if (isset($result->error)) {
			// Didn't work for some reason, send them back to the authorize page
			header('Location: ' . SITEROOT . '/phonegapbuild/authorize?reattempt=1');
			exit;
		}
		
		$user->pg_build_access_token = $result->access_token;
		$user->save();
		
        return view('build.callback');
	    
    }

    public function getBuildAuthorize(Request $request)
    {
	    return view('build.authorize');
    }
}