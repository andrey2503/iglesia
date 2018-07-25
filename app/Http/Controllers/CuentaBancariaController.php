<?php

namespace App\Http\Controllers;

use App\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Logs;
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
        // dd($request);
      $this->validate($request,[
          'nombre'=>'required',
          'banco'=>'required',
          'monto'=>'required',
          'cuenta'=>"required|unique:cuenta_bancarias"
          ]);

      $cuenta = new CuentaBancaria();
      $cuenta->nombre = $request->nombre;
      $cuenta->tipo = $request->tipo;
      $cuenta->moneda= $request->moneda;
      $cuenta->banco= $request->banco;
      $cuenta->monto=$request->monto;
      $cuenta->cuenta=$request->cuenta;

      if($cuenta->save()){
        $log= new Logs();
        $log->fk_usuario= \Auth::user()->id;
        $log->nombre_tabla="cuenta_bancarias";
        $log->nombre_elemento= $cuenta->id;
        $log->accion="Agregar Cuenta Bancaria";
        $log->fecha=date ('y-m-d H:i:s');
        $log->save();
          return redirect()->back()->with('message','Cuenta '.$request->cuenta.' creada correctamente');
      }else{
          return redirect('/nuevaCuentaBancaria');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cuentas= CuentaBancaria::find($id);
        return view('administrador.modificarCuentas')->with(['cuentas'=>$cuentas]);
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
    public function update(Request $request)
    {
 // dd($request);
      $this->validate($request,[
          'nombre'=>'required',
          'banco'=>'required',
          'monto'=>'required'
          ]);

      $cuenta = CuentaBancaria::find($request->id);
      $cuenta->nombre = $request->nombre;
      $cuenta->tipo = $request->tipo;
      $cuenta->moneda= $request->moneda;
      $cuenta->banco= $request->banco;
      $cuenta->monto=$request->monto;
              // $user->state=$request->estado;

              if($cuenta->save()){
                $log= new Logs();
                $log->fk_usuario= \Auth::user()->id;
                $log->nombre_tabla="cuenta_bancarias";
                $log->nombre_elemento= $request->id;
                $log->accion="Actualizar Cuenta Bancaria";
                $log->fecha=date ('y-m-d H:i:s');
                $log->save();
                  return redirect()->back()->with('message','Cuenta '.$request->cuenta.' Actualizada correctamente');
              }else{
                  return redirect('/modificarCuentas');
              }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      // dd($request);
      $cuenta = CuentaBancaria::find($request->id);
      $cuenta->delete();
      if ($cuenta->delete()) {
        $log= new Logs();
        $log->fk_usuario= \Auth::user()->id;
        $log->nombre_tabla="cuenta_bancarias";
        $log->nombre_elemento= $request->id;
        $log->accion="Eliminar Cuenta Bancaria";
        $log->fecha=date ('y-m-d H:i:s');
        $log->save();
          return redirect('/listaCuentaBancaria');
      }
    }


    public function vercuenta($id){
        $cuentas= CuentaBancaria::find($id);
        return view('administrador.verCuentas')->with(['cuentas'=>$cuentas]);
    }
}
