<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Library extends Model
{

    protected $fillable = [ 'user_id', 'word', 'phonetic_word' ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
