<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo($request, $route)
    {
        if (!$request->expectsJson()) {
            return $route;
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($guards[0] == 'admin') {
            $route = route('admin.login');
        } else {
            $route = route('login');
        }

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request, $route)
        );
    }
}
