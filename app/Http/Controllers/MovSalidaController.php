<?php

namespace App\Http\Controllers;

use App\MovSalida;
use Illuminate\Http\Request;
use App\Logs;
use Carbon\Carbon;
class MovSalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
      $movSalida= MovSalida::all();
// dd($cuentas);
      return view('administrador.reportesRubros')->with(['movSalida'=>$movSalida]);
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
     * @param  \App\MovSalida  $movSalida
     * @return \Illuminate\Http\Response
     */
    public function show(MovSalida $movSalida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MovSalida  $movSalida
     * @return \Illuminate\Http\Response
     */
    public function edit(MovSalida $movSalida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MovSalida  $movSalida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovSalida $movSalida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MovSalida  $movSalida
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovSalida $movSalida)
    {
        //
    }
}
