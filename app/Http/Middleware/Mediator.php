<?php

namespace App\Http\Middleware;

use Closure;
use RoleOptions;

class Mediator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role_id === RoleOptions::MEDIATOR)
            return $next($request);
    }
}
