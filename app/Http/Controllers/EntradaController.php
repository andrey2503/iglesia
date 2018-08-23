<?php

namespace App\Http\Controllers;

use App\Entrada;
use Illuminate\Http\Request;
use App\Logs;
use App\Rubro;
use App\CuentaBancaria;
use App\CuentaCobrar;
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
        $rubros= Rubro::all();
        $cuentas= CuentaBancaria::all();
          return view ('administrador.nuevaEntrada')->with(['rubros'=>$rubros,'cuentas'=>$cuentas]);
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
          'cuentaCobrar'=>'required',
          'cuentaBancaria'=>'required',
        ]);

        $entradas = new Entrada();
        $entradas->descripcion = $request->descripcion;
        $entradas->fk_rubro= $request->rubro;
        $entradas->moneda= $request->moneda;
        $entradas->monto=$request->monto;

        if($entradas->save()){
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="entradas";
          $log->nombre_elemento= $entradas->id;
          $log->accion="Agregar  Entrada";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
          if ($request->cuentaCobrar !=1 && $request->cuentaBancaria == 0) {
          return redirect()->back()->with('message','Entrada '.$entradas->descripcion.' creada correctamente');
          }
          //return redirect()->back()->with('message','Entrada '.$entradas->descripcion.' creada correctamente');
        }

        if ($request->cuentaCobrar ==1) {
          $cuentasCobrar = new CuentaCobrar();
          $cuentasCobrar->nombre = "Entrada".$entradas->descripcion;
          $cuentasCobrar->fk_rubro= $request->rubro;
          $cuentasCobrar->moneda= $request->moneda;
          $cuentasCobrar->monto=$request->monto;

          if($cuentasCobrar->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="cuenta_cobrars";
            $log->nombre_elemento= $cuentasCobrar->id;
            $log->accion="Agregar Cuenta por Cobrar desde Entrada";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            if ($request->cuentaBancaria == 0) {
            return redirect()->back()->with('message','Entrada '.$entradas->descripcion.' creada correctamente');
            }
            //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
          }
        }

        if ($request->cuentaBancaria != 0) {//verificar si cuenta vancaria es diferente de 0
          $cuenta= CuentaBancaria::find($request->cuentaBancaria);
            $montoAnterior=$cuenta->monto;
          if ($cuenta->moneda == $request->moneda) {
            $cuenta->monto=$request->monto + $montoAnterior;
            if ($cuenta->save()) {
              if ($request->cuentaCobrar !=1 ) {
              return redirect()->back()->with('message','Entrada '.$entradas->descripcion.' creada correctamente');
            }else{
              return redirect()->back()->with('message','Entrada '.$request->descripcion.' creada correctamente');
            }
            }
          }else{
            return redirect()->back()->with('error','La moneda y la cuenta son diferentes');
          }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function show(Entrada $entrada)
    {
        //
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
    public function update(Request $request, Entrada $entrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entrada  $entrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrada $entrada)
    {
        //
    }

    public function verEntradas($id){
// dd($cuentas);
        $entradas= Entrada::find($id);
        return view('administrador.verEntradas')->with(['entradas'=>$entradas]);
    }
}
