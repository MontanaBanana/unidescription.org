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
use App\ProjectTracking;
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

class ApiController extends Controller
{
	public function __construct()
	{
	    //$this->middleware('auth');
	}

    public function getStatus()
    {
        $user = Auth::user();
        $return = [];
        if ($user) {
           $return['email'] = $user->email;
           $return['status'] = true; 
        }
        else {
           $return['status'] = false; 
        }

        header('Content-Type: application/json');
        echo json_encode($return);
        exit;
    }

    public function postDescribe(Request $request)
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        $status = true;
        $ps = ProjectSection::create([
            'project_id' => $request->project_id, 
            'title' => $request->title, 
            'src_url' => $request->page_url,
            'sort_order' => 99999
        ]);

        
        $ps->save();

        $image = '';
        if ($request->image_url) {
            $ch = curl_init($request->image_url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
            $image = curl_exec($ch);
            curl_close($ch);
            $ps->remote_image_url = $request->image_url;
        }
        else {
            $image = $request->image;  // your base64 encoded
            $image = base64_decode(str_replace('data:image/jpeg;base64,', '', $image));
            //$image = str_replace(' ', '+', $image);
        }

        $imageName = str_random(10).'.'.'jpg';
        $ps->image_url = '/assets/projects/' . $request->project_id . '/sections/' . $imageName;
        $ps->original_image = '/assets/projects/' . $request->project_id . '/sections/' . $imageName;
        $ps->has_image_rights = 0;
        \File::put(base_path() . '/public/assets/projects/' . $request->project_id . '/sections/' . $imageName, $image);
        $ps->save();

        $p = Project::find($request->project_id);
        // NOW UPDATE THE PROJECT updated_at
        $p->updated_at = date("Y-m-d H:i:s", time());
        $p->save();

        return response()->json([ 'success' => 'true', 'url' => 'https://www.unidescription.org/account/project/section/'.$request->project_id.'/'.$ps->id]);
    }

}
