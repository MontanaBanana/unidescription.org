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

class LibraryController extends Controller
{
	public function __construct()
	{

	}
	
	public function getIndex(Request $request, $sortBy = null, $direction = null)
	{
		return view('library.index');
	}
    
	public function postDelete(Request $request)
    {
		$l = Library::find($request->id);
        $l->delete();
        return json_encode( array('status' => 'success') );
    }
    
	public function postAdd(Request $request)
    {
        $l = Library::create(
            [
                'user_id' => Auth::user()->id, 
                'word' => $request->word,
                'phonetic_word' => $request->phonetic_word
            ]
        );
        $l->save(); 
        return json_encode( array('status' => 'success') );
    }
            
    
}
