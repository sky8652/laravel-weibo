<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        //修改redirect方法的调用，并且加上友好提醒
        if (Auth::guard($guard)->check()) {

            //友好提醒
            session()->flash('info', '您已登录，无需再次操作。');

            //重定向地址
            return redirect('/');
        }
        return $next($request);
    }
}
