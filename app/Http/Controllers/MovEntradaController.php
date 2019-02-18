<?php

namespace App\Http\Controllers;

use App\MovEntrada;
use App\MovSalida;
use Illuminate\Http\Request;
use App\Logs;
use Carbon\Carbon;
use App\Rubro;
class MovEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      $movEntrada= MovEntrada::all();
      $movSalida= MovSalida::all();
      $rubros= Rubro::all();
    //   dd($movEntrada);
      return view('administrador.reportesMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'rubros'=>$rubros,'tipoReporte'=>0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MovEntrada  $movEntrada
     * @return \Illuminate\Http\Response
     */
    public function show(MovEntrada $movEntrada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MovEntrada  $movEntrada
     * @return \Illuminate\Http\Response
     */
    public function edit(MovEntrada $movEntrada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MovEntrada  $movEntrada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovEntrada $movEntrada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MovEntrada  $movEntrada
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovEntrada $movEntrada)
    {
        //
    }


    public function reporteMovimientos(Request $request){
    // dd($request);

    if($request->tipoReporte == 0){
      return redirect('/reportesMovimientos');
    }//

    if($request->tipoReporte == 1){
    // dd($request);
    $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
        ]);
      $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
      $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
      $movEntrada= MovEntrada::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
      $movSalida= MovSalida::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
      return view('administrador.reportesMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
    }

    if($request->tipoReporte == 2){
      $movEntrada= MovEntrada::all();
      $movSalida= MovSalida::all();
      return view('administrador.reportesMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

    }

    if($request->tipoReporte == 3){
    // dd($request);
    $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
        ]);
      $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
      $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
      $rubros= Rubro::all();
      $SumatoriaEntradas=array();
      $SumatoriaSalidas=array();
      foreach ($rubros as $key => $value) {
      $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
      array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe]);
      $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
      array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros]);
      }
//dd($SumatoriaEntradas);
       return view('administrador.reportesMovimientos')->with(['movRubroEntrada'=>$SumatoriaEntradas,'movRubroSalida'=>$SumatoriaSalidas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>$fechaInicio,'fechaFinal'=>$fechaFinal]);
    }
    if($request->tipoReporte == 4){
      $movEntrada= MovEntrada::all();
      $movSalida= MovSalida::all();
      return view('administrador.reportesMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);

    }

    }// fin de reportes

    public function reportegenerarMovimiento(Request $request){
      if($request->tipoReporte == 1){
        $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
        $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
        $movEntrada= MovEntrada::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
        $movSalida= MovSalida::where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->get();
          $view= view('reportes.pdfReporteMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
          unset($pdf);
          $pdf=\App::make('dompdf.wrapper');
          $pdf->loadhtml($view);
          return $pdf->stream('document.pdf');
      }
      if($request->tipoReporte == 2){
        $movEntrada= MovEntrada::all();
        $movSalida= MovSalida::all();
          $view= view('reportes.pdfReporteMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
          unset($pdf);
          $pdf=\App::make('dompdf.wrapper');
          $pdf->loadhtml($view);
          return $pdf->stream('document.pdf');
      }
      if($request->tipoReporte == 3){
        $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
        $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
        $rubros= Rubro::all();
        $SumatoriaEntradas=array();
        $SumatoriaSalidas=array();
        foreach ($rubros as $key => $value) {
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe]);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros]);
        }
          $view= view('reportes.pdfReporteMovimientos')->with(['movRubroEntrada'=>$SumatoriaEntradas,'movRubroSalida'=>$SumatoriaSalidas,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
          unset($pdf);
          $pdf=\App::make('dompdf.wrapper');
          $pdf->loadhtml($view);
          return $pdf->stream('document.pdf');
      }
      if($request->tipoReporte == 4){
        $movEntrada= MovEntrada::all();
        $movSalida= MovSalida::all();
          $view= view('reportes.pdfReporteMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida,'tipoReporte'=>$request->tipoReporte,'fechaInicio'=>'','fechaFinal'=>'']);
          unset($pdf);
          $pdf=\App::make('dompdf.wrapper');
          $pdf->loadhtml($view);
          return $pdf->stream('document.pdf');
      }
    }

}
