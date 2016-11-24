<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSection extends Model
{
    protected $guarded = array();

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    
    public function section_template()
    {
	    return $this->belongsTo('App\SectionTemplate');
    }
	
	public function locked_by_user()
	{
		if ($this->locked_by_user_id > 0) {
			return User::find($this->locked_by_user_id); 
		}
		return false;
	}
	
    public function project_section_versions()
    {
        return $this->hasMany('App\ProjectSectionVersion');
    }

    public function todos()
    {
        return $this->hasMany('App\ProjectTodo');    
    }
}
