<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Select environtment, based on APP_ENV in .env file
 * site base bath (webroot) can exist in any folder path defined here
 */
if (App::environment('jason-local')) {
	// at ~/Sites/MontanaBanana/unidescription.com
	define('WEBROOT', 'MontanaBanana/unidescription.com');
} else if (App::environment('joe-local')) {
	// at ~/Sites/unidescription.com
	define('WEBROOT', '');
} else if (App::environment('dev')) {
	// remote site at /dev
	define('WEBROOT', 'dev');
} else {
	// live site in the web root
	define('WEBROOT', '');
}

/**
 * within the code, absolute path to all js/css and other assets include / + WEBROOT if not null
 * use {{ SITEROOT }} before any images, links, css, js, etc in the views, ex: {{ SITEROOT }}/images/myimage.png
 * use {{ WEBROOT }} for anything you wish to define your own /'s or in PHP code 
 */
//define('SITEROOT', (WEBROOT == '' ? '/':'/'.WEBROOT));
define('SITEROOT', '');

$basic_pages = array(
	'index', 
	'404', 
	'about', 
	'contact', 
	'guide', 
	'faq', 
	'creator', 
	'site-map', 
	'contact', 
	'privacy-policy', 
	'tutorials', 
	'best-practices', 
	'license', 
	'auth/password',
	'comp' // jason's new project comps, standalone
	);

Route::get(WEBROOT.'/', function () {
    return view('index');
});

Route::get(WEBROOT.'/home', function () {
    return view('index');
});

foreach ($basic_pages as $p) {
	Route::get(WEBROOT."/$p", function () use ($p) {
	    return view($p);
	});
}

// Account routes
Route::get(WEBROOT.'account', 'AccountController@index');
Route::get(WEBROOT.'account/settings', 'AccountController@getSettings');
Route::post(WEBROOT.'account/settings', 'AccountController@postSettings');


// Project routes
Route::get(WEBROOT.'account/project', 'ProjectController@index');
Route::get(WEBROOT.'account/project/edit/{id}/{title}', 'ProjectController@getEdit');
Route::post(WEBROOT.'account/project/edit', 'ProjectController@postEdit');

Route::get(WEBROOT.'account/project/details/{id}/{title}', 'ProjectController@getDetails');
Route::post(WEBROOT.'account/project/details', 'ProjectController@postDetails');

Route::get(WEBROOT.'account/project/deleteconfirm/{id}', 'ProjectController@getDeleteconfirm');
Route::get(WEBROOT.'account/project/delete/{id}', 'ProjectController@getDelete');


Route::get(WEBROOT.'account/project/assets/{id}/{title}', 'ProjectController@getAssets');

Route::get(WEBROOT.'account/project/toc/{id}/{title}', 'ProjectController@getToc');
Route::post(WEBROOT.'account/project/toc', 'ProjectController@postToc');

Route::post(WEBROOT.'account/project/completed', 'ProjectController@postCompleted');
Route::post(WEBROOT.'account/project/deleted', 'ProjectController@postDeleted');

Route::get(WEBROOT.'account/project/section/{id}/{section_id}', 'ProjectController@getSection');
Route::post(WEBROOT.'account/project/section', 'ProjectController@postSection');
Route::post(WEBROOT.'account/project/addSection', 'ProjectController@postAddSection');
Route::post(WEBROOT.'account/project/section/crop', 'ProjectController@postSectionCrop');

Route::get(WEBROOT.'/account/project/export/{id}', 'ProjectController@getExport');
Route::get(WEBROOT.'/account/project/build/index/{id}', 'ProjectController@getBuildIndex');

// PhoneGap Build related calls
Route::get(WEBROOT.'/phonegapbuild/authorize', 
	[ 'middleware' => 'auth', 'uses' => 'UserController@getBuildAuthorize']
);
Route::get(WEBROOT.'/phonegapbuild/callback', 'UserController@getBuildCallback');

//Route::get('user/search/{string}', 'UserController@search');
Route::post(WEBROOT.'/account/project/share', 'ProjectController@postShare');

// Authentication routes...
Route::get(WEBROOT.'auth/login', 'Auth\AuthController@getLogin');
Route::post(WEBROOT.'auth/login', 'Auth\AuthController@postLogin');
Route::get(WEBROOT.'auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get(WEBROOT.'auth/register', 'Auth\AuthController@getRegister');
Route::post(WEBROOT.'auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get(WEBROOT.'password/email', 'Auth\PasswordController@getEmail');
Route::post(WEBROOT.'password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get(WEBROOT.'password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post(WEBROOT.'password/reset', 'Auth\PasswordController@postReset');
