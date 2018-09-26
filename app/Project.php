<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
use GrahamCampbell\GitHub\Facades\GitHub;

class Project extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'gpo', 'version_number', 'version', 
        'author', 'metatags', 'publication_date', 'image_url', 
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function project_todos()
    {
        return $this->hasMany('App\ProjectTodo')->orderBy('sort_order');
    }
    
    public function project_sections()
    {
        return $this->hasMany('App\ProjectSection')->orderBy('sort_order');
    }
    
    public function is_owner()
    {
	    if (Auth::user()->id == $this->user_id) {
		    return true;
	    }
	    return false;
    }

    public function active_components()
    {
        $count = 0;
        foreach ($this->section_tree() as $section) {
            if ($section['completed'] && !$section['deleted']) {
                $count++;
                if (count($section->children)) {
                    foreach ($section->children as $s) {
                        if ($s['completed'] && !$s['deleted']) {
                            $count++;
                            if (count($s->children)) {
                                foreach ($s->children as $chch) {
                                    if ($chch['completed'] && !$chch['deleted']) {
                                        $count++;
                                    }
                                }
                            } 
                        }
                    }
                }
            }

        }
        return $count;

    }

    public function inactive_components()
    {
        $count = 0;
        foreach ($this->section_tree() as $section) {
            if (!$section['completed'] && !$section['deleted']) {
                $count++;
            }

            if (count($section->children)) {
                foreach ($section->children as $s) {
                    if (!$s['deleted'] && ((!$s['completed'] && !$s['deleted']) || (!$section['completed'] && !$section['deleted']))) {
                        $count++;
                    }
                    if (count($s->children)) {
                        foreach ($s->children as $chch) {
                            if (!$chch['deleted'] && ((!$chch['completed'] && !$chch['deleted']) || (!$s['completed'] && !$s['deleted']) || (!$section['completed'] && !$section['deleted']))) {
                                $count++;
                            }
                        }
                    } 
                }
            }
        }
        return $count;
    }
    
    public function section_tree()
    {
	    return buildTree($this->project_sections, 'project_section_id');
    }

    public function create_github_branch()
    {
        // First, what would we call the branch? Let's see if one exists in
        // the db...
        if (!strlen($this->github_branch)) {
            // Nope, so create the github branch name based on the title and id
            $branch = preg_replace("/[^A-Za-z0-9]/", '-', str_replace(' ', '-', $this->title)) . "-".$this->id;
        }
        else {
            $branch = $this->github_branch;
        }

        // Now, loop through all branches and make sure this one doesn't exist yet.
        $all_branches = GitHub::repo()->branches('MontanaBanana', 'unidescription-projects');
        $found = false;
        $master_sha = '';
        //echo "<PRE>".print_r($all_branches,true)."</pre>";exit;
        foreach ($all_branches as $b) {
            if ($b['name'] == $branch) {
                // Already exists
                $found = true;
            }

            if ($b['name'] == 'master') {
                $master_sha = $b['commit']['sha'];
            }
        }

        $master_sha = '8abc7058ed2db3e77e1eaaa761aa7960a2bfe46a';

        if ($found) {
            // Found it, but delete it and create a new branch based
            // on the latest master
            GitHub::gitData()->References()->remove('MontanaBanana', 'unidescription-projects', 'heads/'.$branch);
            GitHub::gitData()->References()->create('MontanaBanana', 'unidescription-projects', array('ref' => 'refs/heads/'.$branch, 'sha' => $master_sha));

        }
        else {
            // Didn't find it, so create one based on the latest sha
            GitHub::gitData()->References()->create('MontanaBanana', 'unidescription-projects', array('ref' => 'refs/heads/'.$branch, 'sha' => $master_sha));
        }

        $this->github_branch = $branch;
        $this->save();

        return $this->github_branch;
    }

    public function create_build_assets()
    {
        $pg_build_dir = $_SERVER['DOCUMENT_ROOT'].'/projects/'.$this->id;
	if (!is_dir($pg_build_dir)) {
		@mkdir($pg_build_dir);
	}
        $pg_build_dir .= '/unidescription-projects/';
	if (!is_dir($pg_build_dir)) {
		@mkdir($pg_build_dir);
	}

        // Clone the repo
        exec(
            "cd ".$_SERVER['DOCUMENT_ROOT'].'/projects/'.$this->id.'/;'.
            'rm -rf unidescription-projects;'.
            'git clone ssh://git@github.com/MontanaBanana/unidescription-projects.git;'. 
            'cd unidescription-projects;'.
            'git checkout -t origin/'.$this->github_branch
        );

        // Then, replace_string_in_file.
        // Then, commit back to github.

		// Create all files necessary for creating a PG Build zip

	    $owner = User::find($this->user_id);

		replace_string_in_file($pg_build_dir."/config.xml", "{project.title}", $this->title);
		replace_string_in_file($pg_build_dir."/config.xml", "{project.title_code}", preg_replace("/[^A-Za-z]/", '', strtolower($this->title)));
		replace_string_in_file($pg_build_dir."/config.xml", "{project.description}", $this->description);
		replace_string_in_file($pg_build_dir."/config.xml", "{owner.name}", $owner->name);
		replace_string_in_file($pg_build_dir."/config.xml", "{owner.email}", $owner->email);
		
		$view = \View::make('project.export', ['project' => $this]);
		$contents = $view->render();
		
		file_put_contents($pg_build_dir."/index.html", 	$contents);

        exec(
            "cd ".$_SERVER['DOCUMENT_ROOT'].'/projects/'.$this->id.'/unidescription-projects/;'.
            'git commit -a -m"Template updated";'.
            'git push'
        );
		//replace_string_in_file($pg_build_dir."/index.html", "{project.title}", $this->title);
		//replace_string_in_file($pg_build_dir."/index.html", "{project.description}", $this->description);

		return true;
    }
    
    public function zip_create_build_assets()
    {
        // This is the OLD way, where we were creating the build assets with
        // and uploading them via a zip file, instead of via GitHub.
        
		// Create all files necessary for creating a PG Build zip
		$pg_build_template = $_SERVER['DOCUMENT_ROOT'].'/projects/template';
		$pg_build_dir = $_SERVER['DOCUMENT_ROOT'].'/projects/'.$this->id;

		// Overwrite whatever he had each time, replacing it with the current most data
		recurse_copy($pg_build_template, $pg_build_dir);
		
	    $owner = User::find($this->user_id);

		replace_string_in_file($pg_build_dir."/config.xml", "{project.title}", $this->title);
		replace_string_in_file($pg_build_dir."/config.xml", "{project.title_code}", preg_replace("/[^A-Za-z0-9]/", '', strtolower($this->title)));
		replace_string_in_file($pg_build_dir."/config.xml", "{project.description}", $this->description);
		replace_string_in_file($pg_build_dir."/config.xml", "{owner.name}", $owner->name);
		replace_string_in_file($pg_build_dir."/config.xml", "{owner.email}", $owner->email);
		
		$view = \View::make('project.export', ['project' => $this]);
		$contents = $view->render();
		
		file_put_contents($pg_build_dir."/index.html", 	$contents);
		//replace_string_in_file($pg_build_dir."/index.html", "{project.title}", $this->title);
		//replace_string_in_file($pg_build_dir."/index.html", "{project.description}", $this->description);

		// Initialize archive object
		$zip = new \ZipArchive();
		$zip->open($pg_build_dir.".zip", \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
		
		// Initialize empty "delete list"
		$filesToDelete = array();
		
		// Create recursive directory iterator
		$files = new \RecursiveIteratorIterator(
		    new \RecursiveDirectoryIterator($pg_build_dir),
		    \RecursiveIteratorIterator::LEAVES_ONLY
		);
		
		foreach ($files as $name => $file)
		{
		    // Skip directories (they would be added automatically)
		    if (!$file->isDir())
		    {
		        // Get real and relative path for current file
		        $filePath = $file->getRealPath();
		        $relativePath = substr($filePath, strlen($pg_build_dir) + 1);
		
		        // Add current file to archive
		        $zip->addFile($filePath, $relativePath);
		    }
		}
		
		// Zip archive will be created only after closing object
		$zip->close();
		
		return true;
    }
    
    public function get_build_zip()
    {
	    // Create a new PG Build zip file based on the assets for this project
	    
    }
}
