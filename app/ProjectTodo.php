<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTodo extends Model
{
    protected $guarded = array();

    public function project_section()
    {
        return $this->belongsTo('App\ProjectSection');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
