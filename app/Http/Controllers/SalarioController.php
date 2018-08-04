<?php

namespace App\Http\Controllers;

use App\Salario;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
use App\Puesto;
use App\Logs;
class SalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $salarios= Salario::all();
        return view('administrador.listaSalario')->with(['salarios'=>$salarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $puestos= Puesto::all();
        return view('administrador.nuevoSalario')->with(['puestos'=>$puestos]);
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
            'nombre'=>'puesto',
            'salarioNominal'=>'required',
            'moneda'=>'required',
            'obligaciones'=>"required"
            ]);
        $salarios = new Salario();
        $salarios->fk_puesto = $request->puesto;
        $salarios->moneda= $request->moneda;
        $salarios->salarioNominal= $request->salarioNominal;
        $salarios->obligaciones=$request->obligaciones;
        $salarios->salarioNeto=($request->salarioNominal-$request->obligaciones);

        if($salarios->save()){
            $log= new Logs();
            $log->fk_usuario= \Auth::user()->id;
            $log->nombre_tabla="salarios";
            $log->nombre_elemento= $salarios->id;
            $log->accion="Agregar Salario";
            $log->fecha=date ('y-m-d H:i:s');
            $log->save();
            return redirect()->back()->with('message','Salario creado correctamente');
        }else{
            return redirect('administrador.nuevoSalario');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salario  $salario
     * @return \Illuminate\Http\Response
     */
    public function show(Salario $salario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salario  $salario
     * @return \Illuminate\Http\Response
     */
    public function edit(Salario $salario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salario  $salario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salario $salario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salario  $salario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salario $salario)
    {
        //
    }

    public function verSalario($id){
        $salario= Salario::find($id);
        return view('administrador.verSalario')->with(['salario'=>$salario]);
    }
}
