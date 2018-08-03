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
     * @param  \App\CuentaPagar  $cuentaPagar
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaPagar $cuentaPagar)
    {
        //
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
    public function update(Request $request, CuentaPagar $cuentaPagar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaPagar  $cuentaPagar
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuentaPagar $cuentaPagar)
    {
        //
    }
}
