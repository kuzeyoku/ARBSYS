<?php

namespace App\Http\Middleware;

use Closure;
use RoleOptions;

class Admin
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
        if (auth()->user()->role_id == RoleOptions::ADMIN)
            return $next($request);
        else
            return redirect()->back()->withError("Bu sayfaya erişim yetkiniz bulunmamaktadır.");
    }
}
