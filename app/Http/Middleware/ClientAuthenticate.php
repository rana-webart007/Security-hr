<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ClientAuthenticate extends Middleware
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
            return route('client.login');
        }
    }

    protected function authenticate($request, array $guards)
    {   
        if ($this->auth->guard('client')->check()) {
            return $this->auth->shouldUse('client');
        }     
        $this->unauthenticated($request, ['client']);
    }
}
