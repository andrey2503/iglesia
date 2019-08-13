<?php

namespace App\Http\Controllers;

use App\EntradaSoda;
use Illuminate\Http\Request;
use App\Logs;
use App\AdministradorSoda;
class EntradaSodaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entradasSoda= EntradaSoda::all();
// dd($cuentas);
        return view('administrador.listaEntradasSoda')->with(['entradasSoda'=>$entradasSoda]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$gruposSoda
        $gruposSoda= AdministradorSoda::all();
          return view ('administrador.nuevaEntradasSoda')->with(['gruposSoda'=>$gruposSoda]);
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
            'grupo'=>'required',
            'descripcion'=>'required',
            'monto'=>'required',
            ]);
        $entradasSoda = new EntradaSoda();
        $entradasSoda->fk_grupo = $request->grupo;
        $entradasSoda->descripcion = $request->descripcion;
        $entradasSoda->monto= $request->monto;


        if($entradasSoda->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="entrada_sodas";
            $log->nombre_elemento= $entradasSoda->id;
            $log->accion="Agregar Entrada Soda";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Entrada para '.$request->descripcion.' creada correctamente');
        }else{
            return redirect('/administrador.nuevaEntradasSoda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $gruposSoda= AdministradorSoda::all();
        $entradasSoda= EntradaSoda::find($id);
        return view('administrador.modificarEntradasSoda')->with(['entradasSoda'=>$entradasSoda,'gruposSoda'=>$gruposSoda]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradaSoda $entradaSoda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'grupo'=>'required',
            'descripcion'=>'required',
            'monto'=>'required',
            ]);
        $entradasSoda = EntradaSoda::find($request->id);
        $entradasSoda->fk_grupo = $request->grupo;
        $entradasSoda->descripcion = $request->descripcion;
        $entradasSoda->monto= $request->monto;

        if($entradasSoda->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="entrada_sodas";
            $log->nombre_elemento= $entradasSoda->id;
            $log->accion="actualizar entrada Soda";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Entrada para '.$request->descripcion.' actualizada correctamente');
        }else{
            return redirect('/administrador.listaEntradasSoda');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $entradasSoda=EntradaSoda::find($request->id);
        $entradasSoda->delete();
        if ($entradasSoda->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="entrada_sodas";
          $log->nombre_elemento= $entradasSoda->id;
          $log->accion="Eliminar Entrada Soda";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('/listaEntradasSoda');
        }
    }

    public function verEntradasSoda($id){
        $entradasSoda= EntradaSoda::find($id);
        return view('administrador.verEntradasSoda')->with(['entradasSoda'=>$entradasSoda]);
    }

    //reportes


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
