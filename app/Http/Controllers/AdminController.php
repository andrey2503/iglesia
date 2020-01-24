<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Contracts\Auth\Guard;

use Session;

use App\User;

use App\Logs;

use App\MovimientoEntrada;

use App\MovimientoSalida;

use Hash;

class AdminController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */



    public function __construct(Guard $auth)

    {

        $this->auth = $auth;

        $this->middleware(['auth'])->except('logout');

    }



    public function Logout(){

        auth()->logout();

        session()->flash('message', 'Some goodbye message');

        return redirect('/login');

      }



    public function index()

    {

        //

        $users= User::all();

        return view('administrador.index')->with(['users'=>$users]);

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

        return view ('administrador.nuevoUsuario');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {



        $this->validate($request,[

            'nombre'=>'required',

            'email'=>'required|unique:usuarios',

            'idrol'=>'required',

            'contrasena'=>'required',

            'usuario'=>"required|unique:usuarios",

            'estado'=>"required"



            ]);

        $usuario = new User();

        $usuario->nombre = $request->nombre;

        $usuario->usuario = $request->usuario;

        $usuario->email= $request->email;

        $usuario->telefono= $request->telefono;

        $usuario->idrol=$request->idrol;

        $usuario->state=$request->estado;

        $usuario->password= Hash::make($request->contrasena);



        if($usuario->save()){

            $log= new Logs();

            $log->fk_usuario= \Auth::user()->id;

            $log->nombre_tabla="usuarios";

            $log->nombre_elemento= $usuario->id;

            $log->accion="Agregar Usuario";

            $log->fecha=date ('y-m-d H:i:s');

            $log->save();
            
            if($request->ajax()){
                return response()->json([
                    "status" => "202",
                    "mensaje" =>"Actualizado correctamente",
                    "error" => false
                ]);
            } else{
                    return response()->json([
                        "status" => "500",
                        "mensaje" =>"Error al actualizar consecutivos",
                        "error" => true
                    ]);
                }//fin de is es ajax

            //return redirect()->back()->with('message','Usuario '.$request->usuario.' creado correctamente');

        }else{
            if($request->ajax()){
                return response()->json([
                    "status" => "400",
                    "mensaje" =>"Error",
                    "error" => true
                ]);
            }
            //return redirect('/administrador');

        }

        //

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

        $user=User::find($id);

        return view('administrador.modificarUsuarios')->with(['usuario'=>$user]);

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

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

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request)

    {



        $this->validate($request,[

            'nombre'=>'required',

            'email'=>'required',

            'idrol'=>'required',

            'contrasena'=>'required',

              'estado'=>"required"

            ]);



        $user = User::find($request->id);

        $user->nombre = $request->nombre;

        $user->email = $request->email;

        $user->idrol = $request->idrol;

        $user->state=$request->estado;

        if($user->password!=$request->contrasena){

            $contrasena=$request->contrasena;

            $user->password = Hash::make($contrasena);

        }

        // $user->state=$request->estado;



        if($user->save()){

          $log= new Logs();

          $log->fk_usuario= \Auth::user()->id;

          $log->nombre_tabla="usuarios";

          $log->nombre_elemento= $request->id;

          $log->accion="Actualizar Usuario";

          $log->fecha=date ('y-m-d H:i:s');

          $log->save();

            return redirect()->back()->with('message','Usuario '.$request->usuario.' actualizado correctamente');

        }else{

            return redirect('/');

        }

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Request $request)

    {

        //

        // dd($request);

        $usuario=User::find($request->id);

        if(

            MovimientoEntrada::where('fk_usuario','=',$request->id)->get()->isNotEmpty() ||

            MovimientoSalida::where('fk_usuario','=',$request->id)->get()->isNotEmpty()

           ){

                    return redirect()->back()->with('messageError','Usuario "'.$usuario->nombre.' " no se puede eliminar, este usuario esta siendo usado por otros elementos');

                }else{

                if ($usuario->delete()) {

                $log= new Logs();

                $log->fk_usuario= \Auth::user()->id;

                $log->nombre_tabla="usuarios";

                $log->nombre_elemento= $request->id;

                $log->accion="Eliminar Usuario";

                $log->fecha=date ('y-m-d H:i:s');

                $log->save();

                return redirect()->back()->with('message','Usuario "'.$usuario->nombre.' " elimidado exitosamente');

                }

        }

    }// fin del destroy



    protected function getLogout()

    {

        $this->auth->logout();

        Session::flush();

        return redirect('/');

    }



    public function verusuario($id){

        $usuario= User::find($id);

        return view('administrador.verUsuarios')->with(['usuario'=>$usuario]);

    }



    public function logs()

    {

        //

        $logs= Logs::all();



        return view('administrador.logs')->with(['logs'=>$logs]);

    }



    public function generarReporteUsuarios(){

        $User=User::all();

        $view= view('reportes.pdfReporte')->with(['user'=>$User]);

        unset($pdf);

        $pdf=\App::make('dompdf.wrapper');

        $pdf->loadhtml($view);

        return $pdf->stream('document.pdf');

    }// fin de generar reporte



}

