<?php

namespace App\Http\Controllers;

use App\SalidaSoda;
use Illuminate\Http\Request;
use App\AdministradorSoda;
use App\Logs;

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
        $gruposSoda= AdministradorSoda::all();
        return view ('administrador.nuevaSalidasSoda')->with(['gruposSoda'=>$gruposSoda]);
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
        $salidasSoda = new SalidaSoda();
        $salidasSoda->fk_grupo = $request->grupo;
        $salidasSoda->descripcion = $request->descripcion;
        $salidasSoda->monto= $request->monto;


        if($salidasSoda->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="entrada_sodas";
            $log->nombre_elemento= $salidasSoda->id;
            $log->accion="Agregar Salida Soda";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Salida para '.$request->descripcion.' creada correctamente');
        }else{
            return redirect('/administrador.nuevaSalidasSoda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $gruposSoda= AdministradorSoda::all();
        $salidasSoda= SalidaSoda::find($id);
        return view('administrador.modificarSalidasSoda')->with(['salidasSoda'=>$salidasSoda,'gruposSoda'=>$gruposSoda]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {
        $this->validate($request,[
            'grupo'=>'required',
            'descripcion'=>'required',
            'monto'=>'required',
            ]);
        $salidasSoda = SalidaSoda::find($request->id);
        $salidasSoda->fk_grupo = $request->grupo;
        $salidasSoda->descripcion = $request->descripcion;
        $salidasSoda->monto= $request->monto;

        if($salidasSoda->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="salida_sodas";
            $log->nombre_elemento= $salidasSoda->id;
            $log->accion="actualizar Salida Soda";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Salida para '.$request->descripcion.' actualizada correctamente');
        }else{
            return redirect('/administrador.listaSalidasSoda');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SalidaSoda  $salidaSoda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $salidasSoda=SalidaSoda::find($request->id);
        $salidasSoda->delete();
        if ($salidasSoda->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="salida_sodas";
          $log->nombre_elemento= $salidasSoda->id;
          $log->accion="Eliminar salida Soda";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('/listaSalidasSoda');
        }
    }// fin de destroy

    public function verSalidasSoda($id){
        $salidasSoda= SalidaSoda::find($id);
        return view('administrador.verSalidasSoda')->with(['salidasSoda'=>$salidasSoda]);
    }
}
