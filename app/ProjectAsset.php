<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAsset extends Model
{
    protected $guarded = array();

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
