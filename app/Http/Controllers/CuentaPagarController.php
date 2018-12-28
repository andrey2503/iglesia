<?php

namespace App\Http\Controllers;

use App\CuentaPagar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
use App\Rubro;
use App\Logs;
class CuentaPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cuentasPagar= CuentaPagar::all();
        return view('administrador.listaCuentaPP')->with(['cuentasPagar'=>$cuentasPagar]);
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
        return view('administrador.nuevaCuentaPP')->with(['rubros'=>$rubros]);
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
            'monto'=>"required"
            ]);
        $cuentasPagar= new CuentaPagar();
        $cuentasPagar->nombre = $request->nombre;
        $cuentasPagar->fk_rubro= $request->rubro;
        $cuentasPagar->moneda= $request->moneda;
        $cuentasPagar->monto=$request->monto;

        if($cuentasPagar->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="cuenta_pagars";
            $log->nombre_elemento= $cuentasPagar->id;
            $log->accion="Agregar Cuenta por Pagar";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Cuenta por Pagar '.$cuentasPagar->nombre.' creado correctamente');
        }else{
            return redirect('administrador.nuevaCuentaPP');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaPagar  $cuentaPagar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $rubros= Rubro::all();
        $cuentasPagar=CuentaPagar::find($id);
        return view('administrador.modificarPP')->with(['cuentasPagar'=>$cuentasPagar,'rubros'=>$rubros]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaPagar  $cuentaPagar
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaPagar $cuentaPagar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaPagar  $cuentaPagar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
                        $this->validate($request,[
                            'nombre'=>'required',
                            'rubro'=>'required',
                            'moneda'=>'required',
                            'monto'=>"required"
                            ]);

                        $cuentasPagar = CuentaPagar::find($request->id);
                        $cuentasPagar->nombre = $request->nombre;
                        $cuentasPagar->fk_rubro= $request->rubro;
                        $cuentasPagar->moneda= $request->moneda;
                        $cuentasPagar->monto=$request->monto;

                        if($cuentasPagar->save()){
                            $log= new Logs();
                            $log->fk_usuario= \Auth::user()->id;
                            $log->nombre_tabla="cuenta_pagars";
                            $log->nombre_elemento= $request->id;
                            $log->accion="Modificar Cuenta por Cobrar";
                            $log->fecha=date ('y-m-d H:i:s');
                            $log->save();
                            return redirect()->back()->with('message','Cuenta por Pagar '.$cuentasPagar->nombre.' Modificado correctamente');
                        }else{
                            return redirect('administrador.modificarPC');
                        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaPagar  $cuentaPagar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $cuentasPagar=CuentaPagar::find($request->id);
        $cuentasPagar->delete();
        if ($cuentasPagar->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="cuenta_pagars";
          $log->nombre_elemento= $request->id;
          $log->accion="Eliminar Cuenta por Pagar";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('listaCuentaPP');
        }
    }
    public function verPP($id){
      //  $cuentasPagar= CuentaPagar::find($id);
        return view('administrador.verPP')->with(['cuentasPagar'=>$cuentasPagar]);
    }

    public function reportesPP(){

    return view('administrador.reportesPP');
    }


    public function reportesConsultar(Request $request){
    // dd($request);
    if($request->tipoReporte == 2){
      $cuentasPagar=CuentaPagar::all();
    //  dd($cuentasCobrar);
      return view('administrador.reportesPP')->with(['cuentasPagar'=>$cuentasPagar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

    }
    if($request->tipoReporte == 1){
    // dd($request);
    $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
        ]);
      $cuentasPagar=CuentaPagar::where('created_at','>',$request->fechaInicio)->where('created_at','<',$request->fechaFinal)->get();
       //dd($cuentasCobrar);
      return view('administrador.reportesPP')->with(['cuentasPagar'=>$cuentasPagar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$request->fechaInicio,'fechaFinal'=>$request->fechaFinal]);
    }

    }// fin de reportes

    public function reporteCP(Request $request){

      if($request->tipoReporte == 2){

          $cuentasPagar=CuentaPagar::all();
          $view= view('reportes.pdfReportePP')->with(['cuentasPagar'=>$cuentasPagar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
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
        $cuentasPagar=CuentaPagar::where('created_at','>',$request->fechaInicio)->where('created_at','<',$request->fechaFinal)->get();
        $view= view('reportes.pdfReportePP')->with(['cuentasPagar'=>$cuentasPagar,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
        unset($pdf);
        $pdf=\App::make('dompdf.wrapper');
        $pdf->loadhtml($view);
        return $pdf->stream('document.pdf');  }
    }// fin de reporte
}
