<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'pg_build_code', 'pg_build_access_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    public function projects()
    {
        return $this->hasMany('App\Project');
    }
    
    public function shared_projects()
    {
        return $this->belongsToMany('App\Project')->withTimestamps();
    }
    
    /**
	 * get all projects for user
	 *
	 * sort options include title and created, add more here and project's index.blade.php
	 */
    public function all_projects($sortBy='created', $direction='desc')
    {
	    $items = $this->projects->merge( $this->shared_projects );
	    
	    if($sortBy == 'created')
	    {
		    $items = $items->sortBy('created_at');
		} 
		else if($sortBy == 'title')
		{
		    $items = $items->sortBy('title');
		}
		
		if($direction == 'desc'){
			$items = $items->reverse();
		}
	    
	    return $items;
	    
	    //return $this->projects->merge( $this->shared_projects )->sortBy(function($sort){ $sort->created_at; })->reverse();
    }
}
