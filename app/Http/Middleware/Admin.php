<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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

        if ($authAdmin->is_admin) {
            return $next($request);
        }

        return redirect("home")->with("error", "You don't have admin access.");
    }
}
