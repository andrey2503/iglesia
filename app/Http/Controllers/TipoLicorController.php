<?php

namespace App\Http\Controllers;

use App\TipoLicor;
use Illuminate\Http\Request;

class TipoLicorController extends Controller
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
     * @param  \App\TipoLicor  $tipoLicor
     * @return \Illuminate\Http\Response
     */
    public function show(TipoLicor $tipoLicor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoLicor  $tipoLicor
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoLicor $tipoLicor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoLicor  $tipoLicor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoLicor $tipoLicor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoLicor  $tipoLicor
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoLicor $tipoLicor)
    {
        //
    }

    //metodos api

    public function tipos_licor(){
        return TipoLicor::all();
    }// fin de tipos_licor

   


}
