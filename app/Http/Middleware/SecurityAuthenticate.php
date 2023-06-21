<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SecurityAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('security.login');
        }
    }

    protected function authenticate($request, array $guards)
    {   
        if ($this->auth->guard('security')->check()) {
            return $this->auth->shouldUse('security');
        }     
        $this->unauthenticated($request, ['security']);
    }
}
