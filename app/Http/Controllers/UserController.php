<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\User;
use Auth;

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

}