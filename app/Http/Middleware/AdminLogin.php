<?php

namespace App\Http\Middleware;

use Closure;


class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       //檢測session['user']是否存在
       if(!session('user')){
        return redirect('admin/login');
       } 
        return $next($request);
    }
}
