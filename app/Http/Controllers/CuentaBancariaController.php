<?php

namespace App\Http\Controllers;

use App\CuentaBancaria;
use Illuminate\Http\Request;

class CuentaBancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cuentas= CuentaBancaria::all();
// dd($cuentas);
        return view('administrador.listaCuentaBancaria')->with(['cuentas'=>$cuentas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('administrador.nuevaCuentaBancaria');
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
          return redirect('/listaCuentaBancaria');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaBancaria $cuentaBancaria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaBancaria $cuentaBancaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaBancaria $cuentaBancaria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaBancaria $cuentaBancaria)
    {
        //
    }
}
