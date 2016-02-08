<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Project extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'gpo', 'version_number', 'version', 'author', 'publication_date', 'image_url'];

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
}
