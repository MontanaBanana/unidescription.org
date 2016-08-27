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

    public function project_section_versions()
    {
        return $this->hasMany('App\ProjectSectionVersion');
    }

}
