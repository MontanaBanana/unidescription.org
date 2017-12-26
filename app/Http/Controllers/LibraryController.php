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

    public function getUpdateWord(Request $request, $id)
    {
        return view('library.update', ['library_id' => $id]);

    }

    public function getNew()
    {
        return view('library.new');

    }
	
	public function getIndex(Request $request, $sortBy = null, $direction = null)
	{
		return view('library.index');
	}

    public function postReplaceText(Request $request)
    {
        $words = array();
        $all = Library::all();
        foreach ($all as $a) {
            $words[$a['word']] = $a['phonetic_word'];
        }
        $text = $request->text;
        foreach ($words as $word => $p_word) {
            //$text = str_ireplace(" $word ", " $p_word ", $text);
            //"/([^a-zA-Z])(row)([^a-zA-Z]?)/", '\1ro\3'
            if (strlen(trim($word)) && strpos($text, $word) !== false) {
                $word = str_replace("/", "\/", $word);
                $text = preg_replace("/\b$word\b/", $p_word, $text);
            }
        }
        echo json_encode( array('status' => 'success', 'text' => $text) );
        exit;

    }
    
	public function postDelete(Request $request)
    {
		$l = Library::find($request->id);
        $l->delete();
        return json_encode( array('status' => 'success') );
    }
    
	public function postUpdate(Request $request)
    {
		$l = Library::find($request->id);
        $l->word = $request->word;
        $l->phonetic_word = $request->p_word;
        $l->save();
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
