<?php

namespace App\Http\Controllers;

use App\CuentaBancaria;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Logs;
use App\MovimeintoSalida;
use App\MovimeintoEntrada;
use App\User;
use Carbon\Carbon;
class MovimientoController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }


// public function reportesMovimientos(){
// //  $cuentas= CuentaBancaria::all();
//
// return view('administrador.reportesMovimientos');
// }

public function reportesEntradasSalidas(){
//  $cuentas= CuentaBancaria::all();

return view('administrador.reportesRubross');
}


    public function vercuenta($id){
        $cuentas= CuentaBancaria::find($id);
        return view('administrador.verCuentas')->with(['cuentas'=>$cuentas]);
    }

public function reportesConsultar(Request $request){
// dd($request);
if($request->tipoReporte == 2){
  $cuentas= CuentaBancaria::all();
  return view('administrador.reportesCuentasBancarias')->with(['cuentas'=>$cuentas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

}
if($request->tipoReporte == 1){
// dd($request);
$this->validate($request,[
    'fechaInicio'=>'required|date',
    'fechaFinal'=>'required|date',
    ]);
  $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
  $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
  $cuentas= CuentaBancaria::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
  // dd($cuentas);
  return view('administrador.reportesCuentasBancarias')->with(['cuentas'=>$cuentas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
}

}// fin de reportes

public function reporte(Request $request){

  if($request->tipoReporte == 2){

      $cuentas= CuentaBancaria::all();
      $view= view('reportes.pdfReporteCuentaBancaria')->with(['cuentas'=>$cuentas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
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
    $cuentas= CuentaBancaria::where('fechaRegistro','>',$fechaInicio)->where('fechaRegistro','<',$fechaFinal)->get();
    $view= view('reportes.pdfReporteCuentaBancaria')->with(['cuentas'=>$cuentas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
    unset($pdf);
    $pdf=\App::make('dompdf.wrapper');
    $pdf->loadhtml($view);
    return $pdf->stream('document.pdf');  }
}// fin de reporte

}// fin de la clase
