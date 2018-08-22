<?php

namespace App\Http\Controllers;

use App\AdministradorSoda;
use Illuminate\Http\Request;
use App\Logs;
class AdministradorSodaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gruposSoda= AdministradorSoda::all();
// dd($cuentas);
        return view('administrador.listaGruposSoda')->with(['gruposSoda'=>$gruposSoda]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view ('administrador.nuevoGruposSoda');
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
            'nombreGrupo'=>'required',
            'fechaInicio'=>'required',
            'fechaFin'=>'required',
            ]);
        $gruposSoda = new AdministradorSoda();
        $gruposSoda->nombreGrupo = $request->nombreGrupo;
        $gruposSoda->fechaInicio = $request->fechaInicio;
        $gruposSoda->fechaFin= $request->fechaFin;


        if($gruposSoda->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="administrador_sodas";
            $log->nombre_elemento= $gruposSoda->id;
            $log->accion="Agregar Grupo Soda";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Usuario '.$request->nombreGrupo.' creado correctamente');
        }else{
            return redirect('/administrador.nuevoGruposSoda');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdministradorSoda  $administradorSoda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $grupo= AdministradorSoda::find($id);
        return view('administrador.modificarGrupoSodas')->with(['grupo'=>$grupo]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdministradorSoda  $administradorSoda
     * @return \Illuminate\Http\Response
     */
    public function edit(AdministradorSoda $administradorSoda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdministradorSoda  $administradorSoda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdministradorSoda $administradorSoda)
    {
        //
        $this->validate($request,[
            'nombreGrupo'=>'required',
            'fechaInicio'=>'required',
            'fechaFin'=>'required',
            ]);
        $gruposSoda = AdministradorSoda::find($request->id);
        $gruposSoda->nombreGrupo = $request->nombreGrupo;
        $gruposSoda->fechaInicio = $request->fechaInicio;
        $gruposSoda->fechaFin= $request->fechaFin;

        if($gruposSoda->save()){
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="administrador_sodas";
          $log->nombre_elemento= $request->id;
          $log->accion="Actualizar grupo";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect()->back()->with('message','Grupo '.$request->nombreGrupo.' actualizado correctamente');
        }else{
            return redirect('/');
        }
    }// fin de update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdministradorSoda  $administradorSoda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $gruposSoda=AdministradorSoda::find($request->id);
        $gruposSoda->delete();
        if ($gruposSoda->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="administrador_sodas";
          $log->nombre_elemento= $gruposSoda->id;
          $log->accion="Eliminar Grupo Soda";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('/listaGruposSoda');
        }
    }

    public function verGrupoSoda($id){
        $gruposSoda= AdministradorSoda::find($id);
        return view('administrador.verGrupoSoda')->with(['gruposSoda'=>$gruposSoda]);
    }
}
