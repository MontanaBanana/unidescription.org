<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Project extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'gpo', 'version_number', 'version', 
        'author', 'publication_date', 'image_url', 
    ];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
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
    
    public function section_tree()
    {
	    return buildTree($this->project_sections, 'project_section_id');
    }
    
    public function create_build_assets()
    {
		// Create all files necessary for creating a PG Build zip
		$pg_build_template = $_SERVER['DOCUMENT_ROOT'].'/projects/template';
		$pg_build_dir = $_SERVER['DOCUMENT_ROOT'].'/projects/'.$this->id;

		// Overwrite whatever he had each time, replacing it with the current most data
		recurse_copy($pg_build_template, $pg_build_dir);
		
	    $owner = User::find($this->user_id);

		replace_string_in_file($pg_build_dir."/config.xml", "{project.title}", $this->title);
		replace_string_in_file($pg_build_dir."/config.xml", "{project.title_code}", preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($this->title)));
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
