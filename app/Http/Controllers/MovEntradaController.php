<?php

namespace App\Http\Controllers;

use App\MovEntrada;
use App\MovSalida;
use Illuminate\Http\Request;
use App\Logs;
use Carbon\Carbon;
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
    //   dd($movEntrada);
      return view('administrador.reportesMovimientos')->with(['movEntrada'=>$movEntrada,'movSalida'=>$movSalida]);
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
}
