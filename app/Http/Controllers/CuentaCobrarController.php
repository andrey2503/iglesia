<?php

namespace App\Http\Controllers;

use App\CuentaCobrar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
use App\Rubro;
use App\Logs;
use Carbon\Carbon;
class CuentaCobrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cuentasCobrar= CuentaCobrar::all();
        return view('administrador.listaCuentaPC')->with(['cuentasCobrar'=>$cuentasCobrar]);
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
        return view('administrador.nuevaCuentaPC')->with(['rubros'=>$rubros]);
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

                $this->validate($request,[
                    'nombre'=>'required',
                    'rubro'=>'required',
                    'moneda'=>'required',
                    'monto'=>"required",
                      'fechaRegistro'=>'required'
                    ]);
                $cuentasCobrar = new CuentaCobrar();
                $cuentasCobrar->nombre = $request->nombre;
                $cuentasCobrar->fk_rubro= $request->rubro;
                $cuentasCobrar->moneda= $request->moneda;
                $cuentasCobrar->monto=$request->monto;
                $cuentasCobrar->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
                if($cuentasCobrar->save()){
                    $log= new Logs();
                    $log->fk_usuario= \Auth::user()->id;
                    $log->nombre_tabla="cuenta_cobrars";
                    $log->nombre_elemento= $cuentasCobrar->id;
                    $log->accion="Agregar Cuenta por Cobrar";
                    $log->fecha=date ('y-m-d H:i:s');
                    $log->save();
                    return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creado correctamente');
                }else{
                    return redirect('administrador.nuevaCuentaPC');
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $rubros= Rubro::all();
        $cuentasCobrar=CuentaCobrar::find($id);
        return view('administrador.modificarPC')->with(['cuentasCobrar'=>$cuentasCobrar,'rubros'=>$rubros]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaCobrar $cuentaCobrar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
                        $this->validate($request,[
                            'nombre'=>'required',
                            'rubro'=>'required',
                            'moneda'=>'required',
                            'monto'=>"required",
                              'fechaRegistro'=>'required'
                            ]);

                        $cuentasCobrar = CuentaCobrar::find($request->id);
                        $cuentasCobrar->nombre = $request->nombre;
                        $cuentasCobrar->fk_rubro= $request->rubro;
                        $cuentasCobrar->moneda= $request->moneda;
                        $cuentasCobrar->monto=$request->monto;
                        $cuentasCobrar->fechaRegistro=Carbon::parse($request->fechaRegistro)->format('Y-m-d');
                        if($cuentasCobrar->save()){
                            $log= new Logs();
                            $log->fk_usuario= \Auth::user()->id;
                            $log->nombre_tabla="cuenta_cobrars";
                            $log->nombre_elemento= $request->id;
                            $log->accion="Modificar Cuenta por Cobrar";
                            $log->fecha=date ('y-m-d H:i:s');
                            $log->save();
                            return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' Modificado correctamente');
                        }else{
                            return redirect('administrador.modificarPC');
                        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // dd($request);
        $cuentasCobrar=CuentaCobrar::find($request->id);
        $cuentasCobrar->delete();
        if ($cuentasCobrar->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="cuenta_cobrars";
          $log->nombre_elemento= $request->id;
          $log->accion="Eliminar Cuenta por Cobrar";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('listaCuentaPC');
        }
      }
    public function verCP($id){
        $cuentasCobrar= CuentaCobrar::find($id);
        return view('administrador.verPC')->with(['cuentasCobrar'=>$cuentasCobrar]);
    }

    public function reportesPC(){

    return view('administrador.reportesCP');
    }


    public function reportesConsultarCobrar(Request $request){
        if($request->tipoReporte==0){
            return redirect('/reportesPC');
        }
    // dd($request);
    if($request->tipoReporte == 2){
      $cuentasCobrar= CuentaCobrar::all();
    //  dd($cuentasCobrar);
      return view('administrador.reportesCP')->with(['cuentasCobrar'=>$cuentasCobrar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

    }
    if($request->tipoReporte == 1){
    // dd($request);
    $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
        ]);
        $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
        $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
      $cuentasCobrar= CuentaCobrar::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
       //dd($cuentasCobrar);
      return view('administrador.reportesCP')->with(['cuentasCobrar'=>$cuentasCobrar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
    }

    }// fin de reportes

    public function reporteCP(Request $request){

      if($request->tipoReporte == 2){

          $cuentasCobrar= CuentaCobrar::all();
          $view= view('reportes.pdfReportePC')->with(['cuentasCobrar'=>$cuentasCobrar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
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
        $cuentasCobrar= CuentaCobrar::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
        $view= view('reportes.pdfReportePC')->with(['cuentasCobrar'=>$cuentasCobrar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
        unset($pdf);
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadhtml($view);
        return $pdf->stream('document.pdf');  }
    }// fin de reporte
}
