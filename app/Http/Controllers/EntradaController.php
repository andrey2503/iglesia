<?php

namespace App\Http\Controllers;

use App\Entrada;
use Illuminate\Http\Request;
use App\Logs;
use App\Rubro;
use App\CuentaBancaria;
use App\CuentaCobrar;
use App\CuentaPagar;
class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entradas= Entrada::all();
// dd($cuentas);
        return view('administrador.listaEntradas')->with(['entradas'=>$entradas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cuentasPagar= CuentaPagar::all();
        $cuentasCobrar= CuentaCobrar::all();
        $rubros= Rubro::all();
        $cuentas= CuentaBancaria::all();
          return view ('administrador.nuevaEntrada')->with(['rubros'=>$rubros,'cuentas'=>$cuentas,'cuentasPagar'=>$cuentasPagar,'cuentasCobrar'=>$cuentasCobrar]);
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

        // dd($request);
        $this->validate($request,[
          'rubro'=>'required',
          'descripcion'=>'required',
          'moneda'=>'required',
          'monto'=>'required',
          'confMonto'=>'required',
          'cuentaBancaria'=>'required',
          'documento'=>'required',
          'monto'=>'required|same:confMonto'
        ]);

        $entradas = new Entrada();
        $entradas->descripcion = $request->descripcion;
        $entradas->fk_rubro= $request->rubro;
        $entradas->moneda= $request->moneda;
        $entradas->monto=$request->monto;
        $entradas->documento=$request->documento;

        if($entradas->save()){
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="entradas";
          $log->nombre_elemento= $entradas->id;
          $log->accion="Agregar  Entrada";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
          //return redirect()->back()->with('message','Entrada '.$entradas->descripcion.' creada correctamente');
        }

        if ($request->cuentaPagar1 !=0) {

        //  dd($request);
          $this->addCuentaPagar($request);
        }
        if ($request->cuentaBancaria != 0) {
            $this->addcuentaBancaria($request);
        }
        if ($request->cuentaCobrarD !=0) {

        //  dd($request);
          $this->addCuentaCobrarDis($request);
        }
        if ($request->cuentaPagarD !=0) {

        //  dd($request);
          $this->addCuentaPagarDis($request);
        }
        if ($request->cuentaPagarA !=0) {

        //  dd($request);
          $this->addCuentaPagarAu($request);
        }

        return redirect()->back()->with('message','Entrada '.$request->descripcion.' creada correctamente');
      }//fin metodo store


function addCuentaPagar($request) {
//dd($request);
    $cuentasPagar = new CuentaPagar();
    $cuentasPagar->nombre = $request->cuentaPagar;
    $cuentasPagar->fk_rubro= $request->rubro;
    $cuentasPagar->moneda= $request->moneda;
    $cuentasPagar->monto=$request->monto;

    if($cuentasPagar->save()){
      $log= new Logs();
      $log->fk_usuario= \Auth::user()->id;
      $log->nombre_tabla="cuenta_pagars";
      $log->nombre_elemento= $cuentasPagar->id;
      $log->accion="Agregar Cuenta por Pagar desde Entrada";
      $log->fecha=date ('y-m-d H:i:s');
      $log->save();

      //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
  }
}//fin metodo addCuentaPagar

function addcuentaBancaria($request){
  //verificar si cuenta vancaria es diferente de 0
    $cuenta= CuentaBancaria::find($request->cuentaBancaria);
      $montoAnterior=$cuenta->monto;
    if ($cuenta->moneda == $request->moneda) {
      $cuenta->monto=$request->monto + $montoAnterior;
      if($cuenta->save()){
        $log= new Logs();
        $log->fk_usuario= \Auth::user()->id;
        $log->nombre_tabla="cuenta_bancarias";
        $log->nombre_elemento= $cuenta->id;
        $log->accion="Sumar ".$request->monto." al monto anterior: ".$montoAnterior;
        $log->fecha=date ('y-m-d H:i:s');
        $log->save();
        //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
    }

      }
}//fin metodo addcuentaBancaria

//funcion para disminuir cuenta por cobrar
function addCuentaCobrarDis($request){
  $cuentasCobrar=CuentaCobrar::find($request->cuentaCobrarD);
  $montoAnterior=$cuentasCobrar->monto;
  if ($cuentasCobrar->moneda == $request->moneda ) {
    $cuentasCobrar->monto=$montoAnterior - $request->monto;
    if($cuentasCobrar->save()){
      $log= new Logs();
      $log->fk_usuario= \Auth::user()->id;
      $log->nombre_tabla="cuenta_cobrars";
      $log->nombre_elemento= $cuentasCobrar->id;
      $log->accion="Disminuir: ".$request->monto." al monto anterior: ".$montoAnterior;
      $log->fecha=date ('y-m-d H:i:s');
      $log->save();
      //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
  }

    }

}//fin funcion disminuir cuenta por Cobrar

//funcion para disminuir cuenta por pagar
function addCuentaPagarDis($request){
  $cuentasPagar=CuentaPagar::find($request->cuentaPagarD);
  $montoAnterior=$cuentasPagar->monto;
  if ($cuentasPagar->moneda == $request->moneda ) {
    $cuentasPagar->monto=$montoAnterior - $request->monto;
    if($cuentasPagar->save()){
      $log= new Logs();
      $log->fk_usuario= \Auth::user()->id;
      $log->nombre_tabla="cuenta_pagars";
      $log->nombre_elemento= $cuentasPagar->id;
      $log->accion="Disminuir: ".$request->monto." al monto anterior: ".$montoAnterior;
      $log->fecha=date ('y-m-d H:i:s');
      $log->save();
      //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
  }

    }

}//fin funcion disminuir cuenta por pagar


//funcion para aumentar cuenta por pagar
function addCuentaPagarAu($request){
  $cuentasPagar=CuentaPagar::find($request->cuentaPagarA);
  $montoAnterior=$cuentasPagar->monto;
  if ($cuentasPagar->moneda == $request->moneda ) {
    $cuentasPagar->monto=$montoAnterior + $request->monto;
    if($cuentasPagar->save()){
      $log= new Logs();
      $log->fk_usuario= \Auth::user()->id;
      $log->nombre_tabla="cuenta_pagars";
      $log->nombre_elemento= $cuentasPagar->id;
      $log->accion="Aumentar: ".$request->monto." al monto anterior: ".$montoAnterior;
      $log->fecha=date ('y-m-d H:i:s');
      $log->save();
      //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
  }

    }

}//fin funcion aumentar cuenta por pagar

    /**
     * Display the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $entradas= Entrada::find($id);
        $rubros= Rubro::all();
        return view('administrador.modificarEntradas')->with(['entradas'=>$entradas,'rubros'=>$rubros]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function edit(Entrada $entrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $entrada=Entrada::find($request->id);
      $entrada->descripcion=$request->descripcion;
      $entrada->documento=$request->documento;
      $entrada->fk_rubro=$request->rubro;
      if($entrada->save()){
       return redirect()->back()->with('message','Entradaa actualizada correctamente');
      }else{

      }
      //   //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $entrada=Entrada::find($request->id);
      if ($entrada->delete()) {
        return redirect()->back()->with('message','Entradaa eliminada correctamente');
      }else{

      }
        //
    }

    public function verEntradas($id){
// dd($cuentas);
        $entradas= Entrada::find($id);
        return view('administrador.verEntradas')->with(['entradas'=>$entradas]);
    }
}
