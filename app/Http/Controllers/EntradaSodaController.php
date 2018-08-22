<?php

namespace App\Http\Controllers;

use App\EntradaSoda;
use Illuminate\Http\Request;
use App\Logs;
use App\AdministradorSoda;
class EntradaSodaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entradasSoda= EntradaSoda::all();
// dd($cuentas);
        return view('administrador.listaEntradasSoda')->with(['entradasSoda'=>$entradasSoda]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$gruposSoda
        $gruposSoda= AdministradorSoda::all();
          return view ('administrador.nuevaEntradasSoda')->with(['gruposSoda'=>$gruposSoda]);
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
        $entradasSoda = new EntradaSoda();
        $entradasSoda->fk_grupo = $request->grupo;
        $entradasSoda->descripcion = $request->descripcion;
        $entradasSoda->monto= $request->monto;


        if($entradasSoda->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="entrada_sodas";
            $log->nombre_elemento= $entradasSoda->id;
            $log->accion="Agregar Entrada Soda";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Entrada para '.$request->descripcion.' creada correctamente');
        }else{
            return redirect('/administrador.nuevaEntradasSoda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function show(EntradaSoda $entradaSoda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function edit(EntradaSoda $entradaSoda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntradaSoda $entradaSoda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EntradaSoda  $entradaSoda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $entradasSoda=EntradaSoda::find($request->id);
        $entradasSoda->delete();
        if ($entradasSoda->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="entrada_sodas";
          $log->nombre_elemento= $entradasSoda->id;
          $log->accion="Eliminar Entrada Soda";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('/listaEntradasSoda');
        }
    }

    public function verEntradasSoda($id){
        $entradasSoda= EntradaSoda::find($id);
        return view('administrador.verEntradasSoda')->with(['entradasSoda'=>$entradasSoda]);
    }
}
