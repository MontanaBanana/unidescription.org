<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSectionVersion extends Model
{
    protected $guarded = array();

    public function project_section()
    {
        return $this->belongsTo('App\ProjectSection');
    }
    
}
