<?php

namespace App\Http\Controllers;

use App\Salida;
use Illuminate\Http\Request;
use App\Rubro;
use App\CuentaBancaria;
use App\CuentaPagar;
class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salidas= Salida::all();
        return view('administrador.listaSalidas')->with(['salidas'=>$salidas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rubros= Rubro::all();
        $cuentas= CuentaBancaria::all();
        $cuentasPagar= CuentaPagar::all();
        return view ('administrador.nuevaSalida')->with(['rubros'=>$rubros,'cuentas'=>$cuentas,'cuentasPagar'=>$cuentasPagar]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $salida=Salida::find($id);
        $rubros= Rubro::all();
        return view ('administrador.modificarSalidas')->with(['rubros'=>$rubros,'salida'=>$salida]);
    }

    public function verSalidas($id){
        $salida=Salida::find($id);
        return view ('administrador.verSalidas')->with(['salida'=>$salida]);
        
    }// fin de ver salidas

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function edit(Salida $salida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $salida=Salida::find($request->id);
        $salida->descripcion=$request->descripcion;
        $salida->documento=$request->documento;
        $salida->fk_rubro=$request->rubro;
        if($salida->save()){
         return redirect()->back()->with('message','Salida actualizada correctamente');
        }else{
  
        }
        //   //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salida  $salida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    $salida=Salida::find($request->id);
    if ($salida->delete()) {
      return redirect()->back()->with('message','Entradaa eliminada correctamente');
    }else{
    }
    }
      //
}
