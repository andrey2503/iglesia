<?php

namespace App\Http\Controllers;

use App\CuentaCobrar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Session;
use App\User;
use App\Rubro;
use App\Logs;
class CuentaCobrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cuentasCobrar= CuentaCobrar::all();
        return view('administrador.listaCuentaPC')->with(['cuentasCobrar'=>$cuentasCobrar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rubros= Rubro::all();
        return view('administrador.nuevaCuentaPC')->with(['rubros'=>$rubros]);
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
                    'rubro'=>'required',
                    'moneda'=>'required',
                    'monto'=>"required"
                    ]);
                $cuentasCobrar = new CuentaCobrar();
                $cuentasCobrar->nombre = $request->nombre;
                $cuentasCobrar->fk_rubro= $request->rubro;
                $cuentasCobrar->moneda= $request->moneda;
                $cuentasCobrar->monto=$request->monto;

                if($cuentasCobrar->save()){
                    $log= new Logs();
                    $log->fk_usuario= \Auth::user()->id;
                    $log->nombre_tabla="cuenta_cobrars";
                    $log->nombre_elemento= $cuentasCobrar->id;
                    $log->accion="Agregar Cuenta por Cobrar";
                    $log->fecha=date ('y-m-d H:i:s');
                    $log->save();
                    return redirect()->back()->with('message','Cuenta por Cobrar '.$cuentasCobrar->nombre.' creado correctamente');
                }else{
                    return redirect('administrador.nuevaCuentaPC');
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function show(CuentaCobrar $cuentaCobrar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaCobrar $cuentaCobrar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuentaCobrar $cuentaCobrar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaCobrar  $cuentaCobrar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // dd($request);
        $cuentasCobrar=CuentaCobrar::find($request->id);
        $cuentasCobrar->delete();
        if ($cuentasCobrar->delete()) {
          $log= new Logs();
          $log->fk_usuario= \Auth::user()->id;
          $log->nombre_tabla="cuenta_cobrars";
          $log->nombre_elemento= $request->id;
          $log->accion="Eliminar Cuenta por Cobrar";
          $log->fecha=date ('y-m-d H:i:s');
          $log->save();
            return redirect('listaCuentaPC');
        }
      }
    public function verCP($id){
        $cuentasCobrar= CuentaCobrar::find($id);
        return view('administrador.verPC')->with(['cuentasCobrar'=>$cuentasCobrar]);
    }
}
