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
    //dd($request);

    if($request->tipoReporte == 0){
      return redirect('/reportesMovimientos');
    }//

    // dd($condicion);
    if($request->tipoReporte == 1){
        $rubros= Rubro::all();
        $SumatoriaEntradas=array();
        $SumatoriaSalidas=array();
        $sumaColoresS=0;
        $sumaDolaresS=0;
        $sumaEurosS=0;

        $sumaColoresE=0;
        $sumaDolaresE=0;
        $sumaEurosE=0;


        if($request->rubro==0 ){

          foreach ($rubros as $key => $value) {
            $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->sum('monto');
            $sumaColoresE+=$sumRubroe;
            array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>$request->filtroMoneda]);

            $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->sum('monto');
            $sumaColoresS+=$sumRubros;
            array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>$request->filtroMoneda]);
          }// fin del for
          // dd($SumatoriaEntradas);
        }else{

          foreach ($rubros as $key => $value) {
            if($request->rubro==$value->id){
            $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->sum('monto');
            $sumaColoresE+=$sumRubroe;
            array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>$request->filtroMoneda]);

            $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->sum('monto');
            $sumaColoresS+=$sumRubros;
            array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>$request->filtroMoneda]);
            }

          }// fin del for
        }//else



      return view('administrador.reportesMovimientos')->with([
        'movRubroEntrada'=>$SumatoriaEntradas,
        'movRubroSalida'=>$SumatoriaSalidas,
        'tipoReporte'=>$request->tipoReporte,
        'fechaInicio'=>'',
        'fechaFinal'=>'',
        'titulo'=>$request->titulo,
        'sumaColonesE'=>$sumaColoresE,
        'sumaDolaresE'=>$sumaDolaresE,
        'sumaEurosE'=>$sumaEurosE,
        'sumaColonesS'=>$sumaColoresS,
        'sumaDolaresS'=>$sumaDolaresS,
        'sumaEurosS'=>$sumaEurosS,
        'moneda'=> $request->filtroMoneda,
        'rubros'=>$rubros
        ]);

      }//reporte value 1


      if($request->tipoReporte == 2){
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
          $sumaColoresS=0;
          $sumaDolaresS=0;
          $sumaEurosS=0;

          $sumaColoresE=0;
          $sumaDolaresE=0;
          $sumaEurosE=0;

          if($request->rubro==0 ){
          foreach ($rubros as $key => $value) {

          $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
          $sumaColoresE+=$sumRubroe;
          array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>$request->filtroMoneda]);

          $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
          $sumaColoresS+=$sumRubros;
          array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>$request->filtroMoneda]);
          }// fin del for
        }else{
          foreach ($rubros as $key => $value) {
            if($request->rubro==$value->id){
            $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
            $sumaColoresE+=$sumRubroe;
            array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>$request->filtroMoneda]);

            $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=',$request->filtroMoneda)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal)->sum('monto');
            $sumaColoresS+=$sumRubros;
            array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>$request->filtroMoneda]);
            }
          }// fin del for
        }//else
        return view('administrador.reportesMovimientos')->with([
          'movRubroEntrada'=>$SumatoriaEntradas,
          'movRubroSalida'=>$SumatoriaSalidas,
          'tipoReporte'=>$request->tipoReporte,
          'fechaInicio'=>$request->fechaInicio,
          'fechaFinal'=>$request->fechaFinal,
          'titulo'=>$request->titulo,
          'sumaColonesE'=>$sumaColoresE,
          'sumaDolaresE'=>$sumaDolaresE,
          'sumaEurosE'=>$sumaEurosE,
          'sumaColonesS'=>$sumaColoresS,
          'sumaDolaresS'=>$sumaDolaresS,
          'sumaEurosS'=>$sumaEurosS,
          'moneda'=> $request->filtroMoneda,
          'rubros'=>$rubros
          ]);

        }//reporte value 1


    if($request->tipoReporte == 3){
      $movEntrada= MovEntrada::all()->where('moneda','=',$request->filtroMoneda);
      $movSalida= MovSalida::all()->where('moneda','=',$request->filtroMoneda);
      return view('administrador.reportesMovimientos')->with([
        'movEntrada'=>$movEntrada,
        'movSalida'=>$movSalida,
        'tipoReporte'=>$request->tipoReporte,
        'fechaInicio'=>'',
        'fechaFinal'=>'',
        'titulo'=>$request->titulo,
        'moneda'=> $request->filtroMoneda]);

    }// reporte value 3

    if($request->tipoReporte == 4){
      $this->validate($request,[
        'fechaInicio'=>'required|date',
        'fechaFinal'=>'required|date',
        ]);
      $fechaInicio=Carbon::parse($request->fechaInicio)->format('Y-m-d');
      $fechaFinal=Carbon::parse($request->fechaFinal)->format('Y-m-d');
      $movEntrada= MovEntrada::all()->where('moneda','=',$request->filtroMoneda)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal);
      $movSalida= MovSalida::all()->where('moneda','=',$request->filtroMoneda)->where('fechaRegistro','>=',$fechaInicio)->where('fechaRegistro','<=',$fechaFinal);
      return view('administrador.reportesMovimientos')->with([
        'movEntrada'=>$movEntrada,
        'movSalida'=>$movSalida,
        'tipoReporte'=>$request->tipoReporte,
        'fechaInicio'=>'',
        'fechaFinal'=>'',
        'titulo'=>$request->titulo,
        'moneda'=> $request->filtroMoneda]);

    }// reporte value 4

    if($request->tipoReporte == 1){
      // dd($request);
        $rubros= Rubro::all();
        $SumatoriaEntradas=array();
        $SumatoriaSalidas=array();
        $sumaColoresS=0;
        $sumaDolaresS=0;
        $sumaEurosS=0;

        $sumaColoresE=0;
        $sumaDolaresE=0;
        $sumaEurosE=0;

        foreach ($rubros as $key => $value) {

        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Colones')->sum('monto');
        $sumaColoresE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Colones']);
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Euros')->sum('monto');
        $sumaEurosE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Euros']);
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Dolares')->sum('monto');
        $sumaDolaresE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Dolares']);

        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Colones')->sum('monto');
        $sumaColoresS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Colones']);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Euros')->sum('monto');
        $sumaEurosS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Euros']);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Dolares')->sum('monto');
        $sumaDolaresS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Dolares']);

      }// fin del for
      return view('administrador.reportesMovimientos')->with([
        'movRubroEntrada'=>$SumatoriaEntradas,
        'movRubroSalida'=>$SumatoriaSalidas,
        'tipoReporte'=>$request->tipoReporte,
        'fechaInicio'=>'',
        'fechaFinal'=>'',
        'titulo'=>$request->titulo,
        'sumaColonesE'=>$sumaColoresE,
        'sumaDolaresE'=>$sumaDolaresE,
        'sumaEurosE'=>$sumaEurosE,
        'sumaColonesS'=>$sumaColoresS,
        'sumaDolaresS'=>$sumaDolaresS,
        'sumaEurosS'=>$sumaEurosS
        ]);

      }//reporte value 1

// fin-------------->
    }// fin de reportes

    public function reportegenerarMovimiento(Request $request){

      if($request->tipoReporte == 1){
          // dd($request->tipoReporte);
        $rubros= Rubro::all();
        $SumatoriaEntradas=array();
        $SumatoriaSalidas=array();
        $sumaColoresS=0;
        $sumaDolaresS=0;
        $sumaEurosS=0;

        $sumaColoresE=0;
        $sumaDolaresE=0;
        $sumaEurosE=0;

        foreach ($rubros as $key => $value) {

        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Colones')->sum('monto');
        $sumaColoresE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Colones']);
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Euros')->sum('monto');
        $sumaEurosE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Euros']);
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Dolares')->sum('monto');
        $sumaDolaresE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Dolares']);

        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Colones')->sum('monto');
        $sumaColoresS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Colones']);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Euros')->sum('monto');
        $sumaEurosS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Euros']);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Dolares')->sum('monto');
        $sumaDolaresS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Dolares']);

      }// fin del for

          $view= view('reportes.pdfReporteConsolidado')->with([
            'movRubroEntrada'=>$SumatoriaEntradas,
            'movRubroSalida'=>$SumatoriaSalidas,
            'tipoReporte'=>$request->tipoReporte,
            'fechaInicio'=>'',
            'fechaFinal'=>'',
            'titulo'=>$request->titulo,
            'sumaColonesE'=>$sumaColoresE,
            'sumaDolaresE'=>$sumaDolaresE,
            'sumaEurosE'=>$sumaEurosE,
            'sumaColonesS'=>$sumaColoresS,
            'sumaDolaresS'=>$sumaDolaresS,
            'sumaEurosS'=>$sumaEurosS
            ]);
          unset($pdf);
          $pdf=\App::make('dompdf.wrapper');
          $pdf->loadhtml($view);
          return $pdf->stream('document.pdf');
      }
      if($request->tipoReporte == 2){
        $rubros= Rubro::all();
        $SumatoriaEntradas=array();
        $SumatoriaSalidas=array();
        $sumaColoresS=0;
        $sumaDolaresS=0;
        $sumaEurosS=0;

        $sumaColoresE=0;
        $sumaDolaresE=0;
        $sumaEurosE=0;

        foreach ($rubros as $key => $value) {

        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Colones')->sum('monto');
        $sumaColoresE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Colones']);
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Euros')->sum('monto');
        $sumaEurosE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Euros']);
        $sumRubroe=MovEntrada::where('fk_rubro','=',$value->id)->where('moneda','=','Dolares')->sum('monto');
        $sumaDolaresE+=$sumRubroe;
        array_push($SumatoriaEntradas,['rubro'=>$value->nombre,'monto'=>$sumRubroe,'moneda'=>'Dolares']);

        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Colones')->sum('monto');
        $sumaColoresS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Colones']);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Euros')->sum('monto');
        $sumaEurosS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Euros']);
        $sumRubros=MovSalida::where('fk_rubro','=',$value->id)->where('moneda','=','Dolares')->sum('monto');
        $sumaDolaresS+=$sumRubros;
        array_push($SumatoriaSalidas,['rubro'=>$value->nombre,'monto'=>$sumRubros,'moneda'=>'Dolares']);

      }// fin del for

          $view= view('reportes.pdfReporteConsolidado')->with([
            'movRubroEntrada'=>$SumatoriaEntradas,
            'movRubroSalida'=>$SumatoriaSalidas,
            'tipoReporte'=>$request->tipoReporte,
            'fechaInicio'=>'',
            'fechaFinal'=>'',
            'titulo'=>$request->titulo,
            'sumaColonesE'=>$sumaColoresE,
            'sumaDolaresE'=>$sumaDolaresE,
            'sumaEurosE'=>$sumaEurosE,
            'sumaColonesS'=>$sumaColoresS,
            'sumaDolaresS'=>$sumaDolaresS,
            'sumaEurosS'=>$sumaEurosS
            ]);
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
