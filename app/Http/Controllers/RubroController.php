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
                    $log->accion="Agregar Rubro";
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
    public function show($id)
    {
        //
        $rubro= Rubro::find($id);
        return view('administrador.modificarRubro')->with(['rubro'=>$rubro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
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
        // dd($request);
        $this->validate($request,[
            'nombre'=>'required|unique:usuarios',
            'descripcion'=>'required'
            ]);
        $rubro = Rubro::find($request->id);
        $rubro->nombre = $request->nombre;
        $rubro->descripcion = $request->descripcion;

        if($rubro->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="rubros";
            $log->nombre_elemento= $rubro->id;
            $log->accion="Modificar Rubro";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Rubro '.$request->nombre.' editado correctamente');
        }else{
            return redirect('/modificarRubro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $rubro=Rubro::find($request->id);
        $rubro->delete();
        if ($rubro->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="usuarios";
          $log->nombre_elemento= $request->id;
          $log->accion="Eliminar Rubro";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('/listaRubros');
        }
    }

    public function verrubro($id){
        $rubro= Rubro::find($id);
        // dd($rubro);
        return view('administrador.verRubros')->with(['rubro'=>$rubro]);
    }
}
