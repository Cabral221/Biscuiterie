<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var \App\Models\Admin $authAdmin */
        $authAdmin = auth()->user();

        if (!$authAdmin->is_admin) {
            return redirect()
                    ->route('welcome')
                    ->with("error", "You don't have super admin access.");
        }
        
        return $next($request);
    }
}
