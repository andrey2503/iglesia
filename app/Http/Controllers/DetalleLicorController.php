<?php

namespace App\Http\Controllers;

use App\DetalleLicor;
use Illuminate\Http\Request;

class DetalleLicorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\DetalleLicor  $detalleLicor
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleLicor $detalleLicor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleLicor  $detalleLicor
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleLicor $detalleLicor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleLicor  $detalleLicor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleLicor $detalleLicor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleLicor  $detalleLicor
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleLicor $detalleLicor)
    {
        //
    }

    public function licor_detalle($id){
        return DetalleLicor::where('fk_licor','=',$id)->get();
    }// fin de la funcion licor_detalle

}
