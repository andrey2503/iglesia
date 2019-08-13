<?php

namespace App\Http\Controllers;

use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\Logs;
use App\Puesto;
use App\Salario;
class EmpleadoController extends Controller
{

    public function __construct(Guard $auth)
    {

        $this->auth = $auth;
        $this->middleware(['auth'])->except('logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salarios= Salario::all();
        $empleados= Empleado::all();
        return view('administrador.listaEmpleado')->with(['empleados'=>$empleados,'salarios'=>$salarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $puestos=Puesto::all();
        return view('administrador.nuevoEmpleado')->with(['puestos'=>$puestos]);

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
            'nombre'=>'required',
            'cedula'=>'required',
            'telefono'=>'required',
            'fecha'=>"required",
            'puesto'=>"required",
            'estado'=>"required"
            ]);

        $empleado= new Empleado();
        $empleado->nombre=$request->nombre;
        $empleado->cedula=$request->cedula;
        $empleado->telefono=$request->telefono;
        $empleado->monto=0;
        $empleado->fecha=$request->fecha;
        $empleado->fk_puesto=$request->puesto;
        $empleado->estado=$request->estado;
        if($empleado->save())
        {
            return redirect()->back()->with('message','Empleado '.$request->nombre.' creado correctamente');
        }else{
            return redirect('/nuevoRubro');
        }

    }// fin de stoer

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $empleado= Empleado::find($id);
        $puestos=Puesto::all();
        return view('administrador.verEmpleado')->with(['empleado'=>$empleado,'puestos'=>$puestos]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado= Empleado::find($id);
        $puestos=Puesto::all();
        return view('administrador.modificarEmpleado')->with(['empleado'=>$empleado,'puestos'=>$puestos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nombre'=>'required',
            'cedula'=>'required',
            'telefono'=>'required',
            'puesto'=>"required",
            'estado'=>"required"
            ]);
        $empleado= Empleado::find($id);
        $empleado->nombre=$request->nombre;
        $empleado->cedula=$request->cedula;
        $empleado->telefono=$request->telefono;
        $empleado->fk_puesto=$request->puesto;
        $empleado->estado=$request->estado;
        if($empleado->save())
        {
            return redirect()->back()->with('message','Empleado '.$request->nombre.' actualizado correctamente');
        }else{
            return redirect('/nuevoEmpleado');
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $empleado=Empleado::find($request->id);
        // $empleado->delete();
        if ($empleado->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="empleados";
          $log->nombre_elemento= $request->id;
          $log->accion="Eliminar empleado";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('/empleados');
        }
    }
}
