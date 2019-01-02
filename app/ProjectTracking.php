<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTracking extends Model
{
    protected $guarded = array();

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

}
