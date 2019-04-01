<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class LoginApp extends Controller
{
    //
    public function login(Request $request){
        // $user= User::where('email', '=', $request->email,'password','=',$request->password)->first();
        //return 1;
        return response()->json([
            'acceso'=>true,
            'name'=>'none',
            'email'=>$request->email,
            ]);
    }// fin de login 
}
