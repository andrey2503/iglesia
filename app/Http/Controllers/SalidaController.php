<?php

namespace App\Http\Controllers;

use App\Salida;
use Illuminate\Http\Request;
use App\Logs;
use App\Rubro;
use App\CuentaBancaria;
use App\CuentaPagar;
use App\CuentaCobrar;
use Carbon\Carbon;
use App\MovSalida;
class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salidas= Salida::all()->where('estado','=',1);
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
            'documento'=>'required|unique:salidas',
            'monto'=>'required|same:confMonto',
            'fechaRegistro'=>'required',
            'nombre'=>'required',
            'validarMoneda'=>'required|same:moneda'
          ]);

          $salidas = new Salida();
          $salidas->nombre = $request->nombre;
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

          if ($request->cuentaCobrar !=0) {
            //dd($request);
            $this->addCuentaCobrar($request);
          }
          if ($request->cuentaBancaria != 0) {
              $this->addcuentaBancaria($request,$salidas->id);
          }
          if ($request->cuentaPagarDis !=0) {

           //dd($request);
            $this->addCuentaPagarDis($request);
          }
          if ($request->cuentaPagarA !=0) {

          //  dd($request);
            $this->addCuentaPagarAu($request);
          }

          return redirect()->back()->with('message','Salida '.$request->descripcion.' creada correctamente');
        }//fin metodo store


    function addCuentaCobrar($request) {
        //dd($request);
            $cuentasCobrar = new CuentaCobrar();
            $cuentasCobrar->nombre = $request->cuentaCobrarName;
            $cuentasCobrar->fk_rubro= $request->rubro;
            $cuentasCobrar->moneda= $request->moneda;
            $cuentasCobrar->monto=$request->monto;
            $cuentasCobrar->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');

            if($cuentasCobrar->save()){
              $log= new Logs();
              $log->fk_usuario= \Auth::user()->id;
              $log->nombre_tabla="cuenta_pagars";
              $log->nombre_elemento= $cuentasCobrar->id;
              $log->accion="Agregar Cuenta por Cobrar desde Salida";
              $log->fecha=date ('y-m-d H:i:s');
              $log->save();

              //  return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creada correctamente');
          }
        }//fin metodo addCuentaPagar


        function addcuentaBancaria($request,$salidasid){
              $this->addMovimiento($request,$salidasid);
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

          function addMovimiento($request,$salidasid){
            $movSalida = new MovSalida();
            $movSalida->fk_usuario = \Auth::user()->id;
            $movSalida->fk_rubro= $request->rubro;
            $movSalida->fk_cuenta= $request->cuentaBancaria;
            $movSalida->fk_salida= $salidasid;
            $movSalida->moneda= $request->moneda;
            $movSalida->monto=$request->monto;
            $movSalida->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
            if($movSalida->save()){
              $log= new Logs();
              $log->fk_usuario= \Auth::user()->id;
              $log->nombre_tabla="mov_salida";
              $log->nombre_elemento= $movSalida->id;
              $log->accion="Agregar Movimiento Salida";
              $log->fecha=date ('y-m-d H:i:s');
              $log->save();

              }
          }

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
            $cuentasPagar=CuentaPagar::find($request->cuentaPagarDis);
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

          $this->validate($request,[
            'descripcion'=>'required',
            'documento'=>'required',
            'rubro'=>'required',
            'monto'=>'required',
            'fechaRegistro'=>'required',
            'monto'=>'required|same:confMonto'
          ]);
          if ($request->estado == 0) {
            // dd($request->id);
            $cuentaId = MovSalida::where('fk_salida','=',$request->id)->first();
            //update movEntrada
            $movSalida = MovSalida::find($cuentaId->id);
            //dd($movEntrada);
            $movSalida->monto=0;
            $movSalida->save();
            //  dd($cuentaId->fk_cuenta);
            $cuenta= CuentaBancaria::find($cuentaId->fk_cuenta);
            $montoActual=$cuenta->monto;
            $cuenta->monto=($montoActual+$request->montoRechazado);
            $cuenta->save();
            // dd($request->estado);
            $salida=Salida::find($request->id);
            $salida->estado = $request->estado;
            $salida->nombre = "Rechazado";
            if($salida->save()){
             return redirect()->back()->with('message','Salida actualizada correctamente');
            }else{

            }
          }else {
            // code...
            $salida=Salida::find($request->id);
            $salida->descripcion=$request->descripcion;
            $salida->documento=$request->documento;
            $salida->fk_rubro=$request->rubro;
            $salida->monto=$request->monto;
            $salida->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
            //actualizar movimiento
            $cuentaId = MovSalida::where('fk_salida','=',$request->id)->first();
            //update movEntrada
          //  dd($cuentaId);
            $movSalida = MovSalida::find($cuentaId->id);
            //dd($request->id);
            $cuenta= CuentaBancaria::find($cuentaId->fk_cuenta);
             // dd($cuentaId);
            $montoActual=$cuenta->monto;
            if ($request->montoRechazado > $request->monto) {
              $total=($request->montoRechazado)-($request->monto);
              //dd("anterior".$request->montoRechazado." actual ".$request->monto." total ".$total);
              $movSalida->monto=($request->montoRechazado-$total);
              $movSalida->save();
              $cuenta->monto=($montoActual-$total);
              $cuenta->save();
            }else{
                $total=($request->monto)-($request->montoRechazado);
              //  dd("anterior2 ".$request->montoRechazado." actual ".$request->monto." total ".$total);
                $movSalida->monto=($request->montoRechazado+$total);
                $movSalida->save();
                $cuenta->monto=($montoActual-$total);
                $cuenta->save();
            }

        if($salida->save()){
         return redirect()->back()->with('message','Salida actualizada correctamente');
        }else{

        }
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
      $this->reversarCuenta($request);
      $salida=Salida::find($request->id);
    //  dd($salida);

    if ($salida->delete()) {
      return redirect()->back()->with('message','Salida eliminada correctamente');
    }

    }// fin de destroy
      //reversarCuenta bancaria
      function reversarCuenta($request){
        $movSalida = MovSalida::where('fk_salida','=',$request->id)->get();
        //dd($movSalida);
        $cuenta= CuentaBancaria::find($movSalida[0]['fk_cuenta']);
        $montoAnterior=$cuenta->monto;
        $cuenta->monto=$montoAnterior+$movSalida[0]['monto'];
      //  dd($movSalida);
       $movSalida[0]->delete();
      if($cuenta->save()){
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="cuentaBancaria";
          $log->nombre_elemento= $cuenta->id;
          $log->accion="Reversar Cuenta Bancaria";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();

      }
    }//fin reversar cuenta bancaria salida



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
          $pdf->setPaper('L', 'landscape');
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
        $pdf->setPaper('L', 'landscape');
        return $pdf->stream('document.pdf');  }
    }// fin de reporte
}
