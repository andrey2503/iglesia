<?php

namespace App\Http\Controllers;

use App\Salida;
use Illuminate\Http\Request;
use App\Logs;
use App\Rubro;
use App\CuentaBancaria;
use App\CuentaPagar;
use Carbon\Carbon;
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
        $this->validate($request,[
            'rubro'=>'required',
            'descripcion'=>'required',
            'moneda'=>'required',
            'monto'=>'required',
            'confMonto'=>'required',
            'cuentaBancaria'=>'required',
            'documento'=>'required',
            'monto'=>'required|same:confMonto',
              'fechaRegistro'=>'required'
          ]);

          $salidas = new Salida();
          $salidas->descripcion = $request->descripcion;
          $salidas->fk_rubro= $request->rubro;
          $salidas->moneda= $request->moneda;
          $salidas->monto=$request->monto;
          $salidas->documento=$request->documento;
          $salidas->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');

          if($salidas->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="salidas";
            $log->nombre_elemento= $salidas->id;
            $log->accion="Agregar  Salida";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            // return redirect()->back()->with('message','Salida '.$salidas->descripcion.' creada correctamente');
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

          return redirect()->back()->with('message','Salida '.$request->descripcion.' creada correctamente');
        }//fin metodo store


    function addCuentaPagar($request) {
        //dd($request);
            $cuentasPagar = new CuentaPagar();
            $cuentasPagar->nombre = $request->cuentaPagar;
            $cuentasPagar->fk_rubro= $request->rubro;
            $cuentasPagar->moneda= $request->moneda;
            $cuentasPagar->monto=$request->monto;
            $salidas->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');

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
              //  dd($request->monto.$montoAnterior);
                $cuenta->monto=$montoAnterior - $request->monto;
                if($cuenta->save()){
                  $log= new Logs();
                  $log->fk_usuario= \Auth::user()->id;
                  $log->nombre_tabla="cuenta_bancarias";
                  $log->nombre_elemento= $cuenta->id;
                  $log->accion="Restar ".$request->monto." al monto anterior: ".$montoAnterior;
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

        //fin del update
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
        //  dd($request);
          $this->validate($request,[
            'descripcion'=>'required',
            'documento'=>'required',
            'rubro'=>'required',
            'monto'=>'required',
            'fechaRegistro'=>'required'
          ]);
        $salida=Salida::find($request->id);
        $salida->descripcion=$request->descripcion;
        $salida->documento=$request->documento;
        $salida->fk_rubro=$request->rubro;
        $salida->monto=$request->monto;

        $salida->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
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
    }// fin de destroy
      //



    public function reportesSalidas(){

    return view('administrador.reportesSalidas');
    }


    public function reportesconsultaSalidas(Request $request){
    // dd($request);
    if($request->tipoReporte == 2){
    $salida=Salida::all();
    //  dd($salida);
      return view('administrador.reportesSalidas')->with(['salidas'=>$salida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

    }
    if($request->tipoReporte == 1){
    // dd($request);
    $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
        ]);
        $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
        $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
    $salida=Salida::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
       //dd($salida);
      return view('administrador.reportesSalidas')->with(['salidas'=>$salida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$request->fechaInicio,'fechaFinal'=>$request->fechaFinal]);
    }

    }// fin de reportes

    public function reportegenerarSalidas(Request $request){

      if($request->tipoReporte == 2){

          $salida=Salida::all();
          $view= view('reportes.pdfReporteSalidas')->with(['salidas'=>$salida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
          unset($pdf);
          $pdf=\App::make('dompdf.wrapper');
          $pdf->loadhtml($view);
          return $pdf->stream('document.pdf');
      //  dd($cuentas);

        // return view('reportes.pdfReporteCuentaBancaria')->with(['cuentas'=>$cuentas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
      }
      if($request->tipoReporte == 1){
        $this->validate($request,[
            'fechaInicio'=>'required',
            'fechaFinal'=>'required',
            ]);
            $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
            $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
        $salida=Salida::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
        $view= view('reportes.pdfReporteSalidas')->with(['salidas'=>$salida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
        unset($pdf);
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadhtml($view);
        return $pdf->stream('document.pdf');  }
    }// fin de reporte
}
