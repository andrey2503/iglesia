<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware(['auth','administrador'])->except('logout');
    }

    public function index()
    {
        //
        $users= User::all();
        return view('administrador.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'required',
            'email'=>'required|unique:users',
            'idrol'=>'required',
            'contrasena'=>'required',
            'estado'=>'required',
            ]);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=User::find($id);
        return view('administrador.modificarUsuarios')->with(['usuario'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'required',
            'mail'=>'required',
            'idrol'=>'required',
            'contrasena'=>'required',
            'estado'=>'required',
            ]);

        $user = User::find($request->id);
        $user->name=$request->nombre;
        $user->email = $request->mail;
        $user->idrol = $request->idrol;
        if($user->password!=$request->contrasena){
            $contrasena=$request->contrasena;
            $user->password = Hash::make($contrasena);    
        }
        $user->state=$request->estado;

        if($user->save()){
            return redirect()->back()->with('message','Usuario '.$request->usuario.' actualizado correctamente');
        }else{
            return redirect('/');
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    protected function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }

   
}
