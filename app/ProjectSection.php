<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSection extends Model
{
    protected $fillable = ['project_id', 'project_section_id', 'title', 'description', 'sort_order'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    
    public function section_template()
    {
	    return $this->belongsTo('App\SectionTemplate');
    }
}
