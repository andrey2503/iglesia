<?php

namespace App\Http\Controllers;

use App\Rubro;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Logs;
class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rubros= Rubro::all();
        return view('administrador.rubros')->with(['rubros'=>$rubros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
            return view ('administrador.nuevoRubro');
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
                    'nombre'=>'required|unique:usuarios',
                    'descripcion'=>'required'
                    ]);
                $rubro = new Rubro();
                $rubro->nombre = $request->nombre;
                $rubro->descripcion = $request->descripcion;

                if($rubro->save()){
                    $log= new Logs();
                    $log->fk_usuario= \Auth::user()->id;
                    $log->nombre_tabla="rubros";
                    $log->nombre_elemento= $rubro->id;
                    $log->accion="Agregar RUbro";
                    $log->fecha=date ('y-m-d H:i:s');
                    $log->save();
                    return redirect()->back()->with('message','Rubro '.$request->nombre.' creado correctamente');
                }else{
                    return redirect('/nuevoRubro');
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function show(Rubro $rubro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function edit(Rubro $rubro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rubro $rubro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubro $rubro)
    {
        //
    }
}
