<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
use App\Logs;
use Hash;
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

    public function Logout(){
        auth()->logout();
        session()->flash('message', 'Some goodbye message');
        return redirect('/login');
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
        return view ('administrador.nuevoUsuario');
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
            'email'=>'required|unique:usuarios',
            'idrol'=>'required',
            'contrasena'=>'required',
            'usuario'=>"required|unique:usuarios"
            ]);
        $usuario = new User();
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email= $request->email;
        $usuario->telefono= $request->telefono;
        $usuario->idrol=$request->idrol;
        $usuario->password= Hash::make($request->contrasena);

        if($usuario->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="usuarios";
            $log->nombre_elemento= $usuario->id;
            $log->accion="Agregar";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Usuario '.$request->usuario.' creado correctamente');
        }else{
            return redirect('/administrador');
        }
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
            'email'=>'required',
            'idrol'=>'required',
            'contrasena'=>'required',
            ]);

        $user = User::find($request->id);
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->idrol = $request->idrol;
        if($user->password!=$request->contrasena){
            $contrasena=$request->contrasena;
            $user->password = Hash::make($contrasena);    
        }
        // $user->state=$request->estado;

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
