<?php

namespace App\Http\Controllers;

use App\Entrada;
use Illuminate\Http\Request;
use App\Logs;
use App\Rubro;
use App\CuentaBancaria;
use App\CuentaCobrar;
use App\CuentaPagar;
use Carbon\Carbon;
use App\MovEntrada;
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
    $entradas= Entrada::all()->where('estado','=',1);
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
      'confMonto'=>'required',
      'cuentaBancaria'=>'required',
      'documento'=>'required|unique:entradas',
      'monto'=>'required|same:confMonto',
      'fechaRegistro'=>'required',
      'nombre'=>'required',
      'validarMoneda'=>'required|same:moneda'
    ]);


    $entradas = new Entrada();
    $entradas->descripcion = $request->descripcion;
    $entradas->nombre = $request->nombre;
    $entradas->fk_rubro= $request->rubro;
    $entradas->moneda= $request->moneda;
    $entradas->monto=$request->monto;
    $entradas->documento=$request->documento;
    $entradas->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');

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
      $this->addcuentaBancaria($request,$entradas->id);
    }
    if ($request->cuentaCobrarD !=0) {

      //  dd($request);
      $this->addCuentaCobrarDis($request);
    }
    if ($request->cuentaPagarD !=0) {

      //  dd($request);
      $this->addCuentaPagarDis($request);
    }
    // cuentaPagarA
    // se elimino campo cuenta pagar del formulario
    // if ($request->cuentaPagarA !=0) {

    // //  dd($request);
    //   $this->addCuentaPagarAu($request);
    // }

    return redirect()->back()->with('message','Entrada '.$request->descripcion.' creada correctamente');
  }//fin metodo store


  function addCuentaPagar($request) {
    //dd($request);
    $cuentasPagar = new CuentaPagar();
    $cuentasPagar->nombre = $request->cuentaPagar;
    $cuentasPagar->fk_rubro= $request->rubro;
    $cuentasPagar->moneda= $request->moneda;
    $cuentasPagar->monto=$request->monto;
    $cuentasPagar->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
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

  function addcuentaBancaria($request,$entradaid){
    $this->addMovimiento($request,$entradaid);
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

  function addMovimiento($request,$entradaid){
    $movEntrada = new MovEntrada();
    $movEntrada->fk_usuario = \Auth::user()->id;
    $movEntrada->fk_rubro= $request->rubro;
    $movEntrada->fk_cuenta= $request->cuentaBancaria;
    $movEntrada->fk_entrada= $entradaid;
    $movEntrada->moneda= $request->moneda;
    $movEntrada->monto=$request->monto;
    $movEntrada->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
    if($movEntrada->save()){
      $log= new Logs();
      $log->fk_usuario= \Auth::user()->id;
      $log->nombre_tabla="mov_entrada";
      $log->nombre_elemento= $movEntrada->id;
      $log->accion="Agregar Movimiento Entrada";
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
    //  dd($request);
    $this->validate($request,[
      'descripcion'=>'required',
      'documento'=>'required',
      'rubro'=>'required',
      'fechaRegistro'=>'required',
      'monto'=>'required|same:confMonto'
    ]);
    if ($request->estado == 0) {
      // dd($request->id);
      $cuentaId = MovEntrada::where('fk_entrada','=',$request->id)->first();
      //update movEntrada
      $movEntrada = MovEntrada::find($cuentaId->id);
      //dd($movEntrada);
      $movEntrada->monto=0;
      $movEntrada->save();
      //  dd($cuentaId->fk_cuenta);
      $cuenta= CuentaBancaria::find($cuentaId->fk_cuenta);
      $montoActual=$cuenta->monto;
      $cuenta->monto=($request->montoRechazado-$montoActual);
      $cuenta->save();
      // dd($request->estado);
      $entrada=Entrada::find($request->id);
      $entrada->nombre = "Rechazado";
      $entrada->estado = $request->estado;
      if($entrada->save()){
        return redirect()->back()->with('message','Entrada actualizada correctamente');
      }else{

      }
    }else {
      $entrada=Entrada::find($request->id);
      $entrada->descripcion=$request->descripcion;
      $entrada->documento=$request->documento;
      $entrada->fk_rubro=$request->rubro;
      $entrada->monto=$request->monto;
      $entrada->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
      //actualizar movimiento
      $cuentaId = MovEntrada::where('fk_entrada','=',$request->id)->first();
      //update movEntrada
    //  dd($cuentaId);
      $movEntrada = MovEntrada::find($cuentaId->id);
      //dd($request->id);
      $cuenta= CuentaBancaria::find($cuentaId->fk_cuenta);
       // dd($cuentaId);
      $montoActual=$cuenta->monto;
      if ($request->montoRechazado > $request->monto) {
        $total=($request->montoRechazado)-($request->monto);
      //  dd("anterior".$request->montoRechazado." actual ".$request->monto." total ".$total);
        $movEntrada->monto=($request->montoRechazado-$total);
        $movEntrada->save();
        $cuenta->monto=($montoActual-$total);
        $cuenta->save();
      }else{
          $total=($request->monto)-($request->montoRechazado);
          //dd("anterior".$request->montoRechazado." actual ".$request->monto." total ".$total);
          $movEntrada->monto=($request->montoRechazado+$total);
          $movEntrada->save();
          $cuenta->monto=($montoActual+$total);
          $cuenta->save();
      }

      if($entrada->save()){
        $log= new Logs();
        $log->fk_usuario= \Auth::user()->id;
        $log->nombre_tabla="entradas";
        $log->nombre_elemento= $request->id;
        $log->accion="Actualizar Entrada";
        $log->fecha=date ('y-m-d H:i:s');
        $log->save();
        return redirect()->back()->with('message','Entrada '.$request->descripcion.' Actualizada correctamente');
      }else{
        return redirect('/modificarEntrada');
      }
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
    $this->reversarCuenta($request);
    $entrada=Entrada::find($request->id);
    //  dd($salida);

    if ($entrada->delete()) {
      return redirect()->back()->with('message','Entrada eliminada correctamente');
    }

  }// fin de destroy
  //reversarCuenta bancaria
  function reversarCuenta($request){
    $movEntrada = MovEntrada::where('fk_entrada','=',$request->id)->get();
    //dd($movSalida);
    $cuenta= CuentaBancaria::find($movEntrada[0]['fk_cuenta']);
    $montoAnterior=$cuenta->monto;
    $cuenta->monto=$montoAnterior-$movEntrada[0]['monto'];
    //  dd($movSalida);
    $movEntrada[0]->delete();
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

  public function verEntradas($id){
    // dd($cuentas);
    $entradas= Entrada::find($id);
    return view('administrador.verEntradas')->with(['entradas'=>$entradas]);
  }

  public function reporteTodasEntradas(){
    $entradas= Entrada::all();
    return view('reportes.pdfReporteEntradas')->with(['entradas'=>$entradas]);
  }// fin de reporteTodoSalidas

  public function reportesEntradas(){

    return view('administrador.reportesEntradas');
  }


  public function reportesConsultar(Request $request){
    //   dd($request);
    if($request->tipoReporte == 2){
      $entradas= Entrada::all();
      //  dd($entradas);
      return view('administrador.reportesEntradas')->with(['entradas'=>$entradas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

    }
    if($request->tipoReporte == 1){
      // dd($request);
      $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
      ]);
      $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
      $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
      $entradas= Entrada::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
      //dd($entradas);
      return view('administrador.reportesEntradas')->with(['entradas'=>$entradas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$request->fechaInicio,'fechaFinal'=>$request->fechaFinal]);
    }

  }// fin de reportes

  public function reportegenerarEntradas(Request $request){

    if($request->tipoReporte == 2){

      $entradas= Entrada::all();
      $view= view('reportes.pdfReporteEntradas')->with(['entradas'=>$entradas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
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
      $entradas= Entrada::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
      $view= view('reportes.pdfReporteEntradas')->with(['entradas'=>$entradas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
      unset($pdf);
      $pdf=\App::make('dompdf.wrapper');
      $pdf->loadhtml($view);
      return $pdf->stream('document.pdf');  }
    }// fin de reporte

  }
