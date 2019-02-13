<?php

namespace App\Http\Controllers;

use App\CuentaBancaria;
use App\MovimientoEntrada;
use App\MovimientoSalida;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Logs;
use Carbon\Carbon;
class CuentaBancariaController extends Controller
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
          'cuenta'=>"required|unique:cuenta_bancarias",
          'fechaRegistro'=>'required'
          ]);

      $cuenta = new CuentaBancaria();
      $cuenta->nombre = $request->nombre;
      $cuenta->tipo = $request->tipo;
      $cuenta->moneda= $request->moneda;
      $cuenta->banco= $request->banco;
      $cuenta->monto=0;
      $cuenta->cuenta=$request->cuenta;
      $cuenta->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');

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
          'fechaRegistro'=>'required',
          'cuenta'=>'required'
          ]);

      $cuenta = CuentaBancaria::find($request->id);
      $cuenta->nombre = $request->nombre;
      $cuenta->tipo = $request->tipo;
      $cuenta->moneda= $request->moneda;
      $cuenta->banco= $request->banco;
      $cuenta->cuenta= $request->cuenta;
      $cuenta->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
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
      
      if(
        MovimientoEntrada::where('fk_cuenta','=',$request->id)->get()->isNotEmpty() ||
        MovimientoSalida::where('fk_cuenta','=',$request->id)->get()->isNotEmpty()
       ){
                return redirect()->back()->with('messageError','Cuenta bancaria "'.$cuenta->nombre.' " no se puede eliminar, este cuenta bancaria esta siendo usado por otros elementos');
            }else{
            if ($cuenta->delete()) {
                $log= new Logs();
                $log->fk_usuario= \Auth::user()->id;
                $log->nombre_tabla="cuenta_bancarias";
                $log->nombre_elemento= $request->id;
                $log->accion="Eliminar Cuenta Bancaria";
                $log->fecha=date ('y-m-d H:i:s');
                $log->save();
                return redirect()->back()->with('message','Cuenta bancaria "'.$cuenta->nombre.' " eliminado exitosamente');
            }
    }
    }// fin de destroy


public function reportesCuentasBancarias(){
//  $cuentas= CuentaBancaria::all();

return view('administrador.reportesCuentasBancarias');
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
