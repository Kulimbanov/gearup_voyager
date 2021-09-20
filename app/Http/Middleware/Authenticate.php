<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        logger('Authenticate:');
        logger($request->all());
        if (! $request->expectsJson()) {
            logger('NOT JSON OR WTF Authenticate:');
            logger($request->expectsJson());

            return route('home');
        }
    }
}
