<?php

namespace App\Http\Controllers;

use App\SalidaSoda;
use Illuminate\Http\Request;

class SalidaSodaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salidasSoda= SalidaSoda::all();
        return view('administrador.listaSalidasSoda')->with(['salidasSoda'=>$salidasSoda]);
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
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function show(SalidaSoda $salidaSoda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function edit(SalidaSoda $salidaSoda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalidaSoda $salidaSoda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalidaSoda $salidaSoda)
    {
        //
    }
}
