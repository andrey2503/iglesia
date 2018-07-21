<?php

namespace App\Http\Controllers;

use App\Licor;
use App\DetalleLicor;
use Illuminate\Http\Request;

class LicorController extends Controller
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
     * @param  \App\Licor  $licor
     * @return \Illuminate\Http\Response
     */
    public function show(Licor $licor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Licor  $licor
     * @return \Illuminate\Http\Response
     */
    public function edit(Licor $licor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licor  $licor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licor $licor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licor  $licor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licor $licor)
    {
        //
    }

    //metodos del api

    public function licores(){
        return Licor::all();
    }

    public function licor($id){
        return Licor::find($id);
    }

    public function agregarLicor(Request $request)
    {
        //
        // $table->unsignedInteger('fk_licor');
        //     $table->integer('abierta');
        //     $table->float('peso_total', 8, 2);
        //     $table->float('peso_util', 8, 2);
        //     $table->float('peso_actual', 8, 2);
        //     $table->integer('cantidad_tragos');
        $tipo_licor=$request->tipo_licor;
        $estado_licor=$request->estado_licor;
        $tipo__envace_licor=$request->tipo__envace_licor;
        $nombre=$request->nombre;
        $peso_total=$request->peso_total;
        $pero_util=$request->pero_util;

        $licor=new Licor();
        $licor->nombre= $request->nombre;
        $licor->fk_tipolicor=$request->tipo_licor;

        if($licor->save()){
            $detalleLicor=new DetalleLicor();
            $detalleLicor->fk_licor=$licor->id;            
            $detalleLicor->abierta=$request->estado_licor;
            $detalleLicor->tipo_envase=$request->tipo__envace_licor;
            $detalleLicor->peso_total=$request->peso_total;
            $detalleLicor->peso_util=$request->pero_util;
            $detalleLicor->peso_actual=$request->peso_total-$request->pero_util;
            if($request->tipo__envace_licor=='1'){
                $detalleLicor->cantidad_tragos=$request->pero_util/40;     
            }else{
                $detalleLicor->cantidad_tragos=$request->pero_util/18;     
            }
            if($detalleLicor->save()){
                return 1;
            }else{
                return 0;
            }

        }else{
        return 2;
        }
        
        
    }


}
