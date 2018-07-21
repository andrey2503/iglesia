<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
class Administrador
{
    protected $auth;
    public function __contructor(Guard $auth){
       $this->auth = $auth;
    }// constructor
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard($this->auth)->check()) {
            switch (Auth::guard($this->auth)->user()->idrol) {
            case '1':
            break;
            case '2':
             return redirect('digitador');//cru
            break;
            default:
             return redirect('loginadministrador');
            break;
            }// fin del switch
          }// fin del switch
        return $next($request);
    }
}
