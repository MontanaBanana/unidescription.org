<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    /* Socialite OAuth providers */
    'facebook' => [

    ],

	'twitter' => [
		'client_id' => env('TWITTER_CLIENT_ID'),
		'client_secret' => env('TWITTER_CLIENT_SECRET'),
		'redirect' => 'http://127.0.0.1:8888/login/twitter',
	],

    'linkedin' => [

    ],

    'google' => [
	    'clientId' => env('GOOGLE_CLIENT_ID'),
	    'apiKey' => env('GOOGLE_API_KEY'),
    ],

    'github' => [

    ],

    'bitbucket' => [

    ],

    'phonegap_build' => [
        'client_id' => env('PHONEGAP_BUILD_CLIENT_ID'),
        'client_secret' => env('PHONEGAP_BUILD_CLIENT_SECRET')
    ],

];
