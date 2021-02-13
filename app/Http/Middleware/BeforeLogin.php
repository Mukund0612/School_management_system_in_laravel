<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Session;

use Closure;

class BeforeLogin
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
        if (!session()->has('admin_session')) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
