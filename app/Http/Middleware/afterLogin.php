<?php

namespace App\Http\Middleware;

use Closure;

class afterLogin
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
        if (session()->has('admin_session')) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
