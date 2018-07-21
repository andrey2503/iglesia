<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
class Digitador extends Controller
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware(['auth','digitador'])->except('logout');
    }
    //
    public function index(){
        return view('digitador.index');
    }//

    protected function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }
}
