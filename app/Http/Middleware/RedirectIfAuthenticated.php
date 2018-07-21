<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Contracts\Auth\Guard;
use Session;
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
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        if (Auth::guard($guard)->check()) {
            switch (Auth::guard($guard)->user()->idrol) {
            case '1':
            return redirect('administrador');//cru
            break;
            case '2':
             return redirect('digitador');//cru
            break;
            default:
             return redirect('login');
            break;
            }// fin del switch
          }// fin del switch
        return $next($request);
    }
}
