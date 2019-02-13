<?php

namespace App\Http\Controllers;

use App\Puesto;
use App\Empleado;
use App\Salario;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Logs;
class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $puestos= Puesto::all();
        // dd($puestos);
        return view('administrador.listaPuestos')->with(['puestos'=>$puestos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view ('administrador.nuevoPuesto');
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
            'nombre'=>'required|unique:puestos',
            'descripcion'=>'required'
            ]);
        $puesto = new Puesto();
        $puesto->nombre = $request->nombre;
        $puesto->descripcion = $request->descripcion;

        if($puesto->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="puestos";
            $log->nombre_elemento= $puesto->id;
            $log->accion="Agregar Puesto";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Puesto '.$request->nombre.' creado correctamente');
        }else{
            return redirect('/nuevoPuesto');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $puestos= Puesto::find($id);
        return view('administrador.modificarPuesto')->with(['puestos'=>$puestos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Puesto $puesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puesto $puesto)
    {
        //
        // dd($request);
        $this->validate($request,[
            'nombre'=>'required',
            'descripcion'=>'required'
            ]);
        $puesto = Puesto::find($request->id);
        $puesto->nombre = $request->nombre;
        $puesto->descripcion = $request->descripcion;

        if($puesto->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="puestos";
            $log->nombre_elemento= $puesto->id;
            $log->accion="Modificar Puesto";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Puesto '.$request->nombre.' editado correctamente');
        }else{
            return redirect('/modificarPuesto');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //
        $puesto=Puesto::find($request->id);

        if(
            Empleado::where('fk_puesto','=',$request->id)->get()->isNotEmpty() ||
            Salario::where('fk_puesto','=',$request->id)->get()->isNotEmpty()
           ){
                    return redirect()->back()->with('messageError','Rubro "'.$puesto->nombre.' " no se puede eliminar, este rubro esta siendo usado por otros elementos');           
           }
           else{
                    if ($puesto->delete()) {
                    $log= new Logs();
                    $log->fk_usuario= \Auth::user()->id;
                    $log->nombre_tabla="puestos";
                    $log->nombre_elemento= $puesto->id;
                    $log->accion="Eliminar Puesto";
                    $log->fecha=date ('y-m-d H:i:s');
                    $log->save();
                    return redirect()->back()->with('message','Puesto "'.$puesto->nombre.' " Eliminado exitosamente');            
                        // return redirect('/listaPuestos');
                    }
            }
    }// fin del destroy

    public function verPuesto($id){
        $puestos= Puesto::find($id);
        // dd($rubro);
        return view('administrador.verPuestos')->with(['puestos'=>$puestos]);
    }
}
