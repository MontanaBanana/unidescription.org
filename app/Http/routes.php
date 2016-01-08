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

$basic_pages = array('index', '404', 'about', 'contact', 'guide', 'faq', 'creator', 'site-map', 'contact', 'privacy-policy', 'license', 'auth/password');

Route::get('/', function () {
    return view('index');
});

Route::get('/home', function () {
    return view('index');
});

foreach ($basic_pages as $p) {
	Route::get("/$p", function () use ($p) {
	    return view($p);
	});
}

// Account routes
Route::get('account', 'AccountController@index');
Route::get('account/settings', 'AccountController@getSettings');
Route::post('account/settings', 'AccountController@postSettings');


// Project routes
Route::get('account/project', 'ProjectController@index');
Route::get('account/project/edit/{id}/{title}', 'ProjectController@getEdit');
Route::post('account/project/edit', 'ProjectController@postEdit');

Route::get('/account/project/export/{id}', 'ProjectController@getExport');
//Route::get('user/search/{string}', 'UserController@search');
Route::post('/account/project/share', 'ProjectController@postShare');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
