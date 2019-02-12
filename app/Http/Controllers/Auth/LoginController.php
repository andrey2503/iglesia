<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Hash;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {
     $this->validate($request, [
         'usuario' => 'required',
         'password' => 'required',
     ]);
    if (\Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
        $usuarioactual=\Auth::user();
     
        return redirect('/administrador');
     }
     return redirect('/login');
     }

    public function iniciarUsuarioAdmin(){
        $user = new User();
        $user->nombre="Andrey Torres Vega";
        $user->email = "admin@admin.com";
        $user->usuario="admintest";
        $user->telefono="888";
        $user->idrol = 1;
        $user->state = 1;        
        $user->password = Hash::make('admintest');
        $user->save();
        }//fin de iniciarUsuarioAdmin

        protected function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }
  
}
