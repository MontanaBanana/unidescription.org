<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/account/project/section',
        '/account/project/unlock/*',
        '/library/replacetext',
        '/account/project/assets',
        '/api/*',
    ];
}
