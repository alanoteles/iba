<?php

namespace Iba\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class LoginChkMiddleware
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
        //echo (\Session::has('usuario') ? \Session::get('usuario.id') : '0');
        if (!$request->session()->has('usuario') && (\Route::getCurrentRoute()->getPath() != 'pt_br/admin/login'))
        {
            return \Redirect::to(app()->getLocale() . '/admin/login');
        }else{
            return $next($request);
        }

    }
}
