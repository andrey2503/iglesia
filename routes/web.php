<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//rutas accessibles slo si el usuario no se ha logueado

  Route::post('login', ['as' =>'login', 'uses' => 'Auth\LoginController@postLogin']);
      Route::get('/', function () {
        return view('auth.login');
      });
    Route::get('/login', function () {
      return view('auth.login');
      });
  Route::get('/user', 'Auth\LoginController@iniciarUsuarioAdmin');
  Route::get('/salir', 'Auth\LoginController@getLogout');


Route::group(['middleware' => ['auth']], function () {
    // admin
    Route::get('/aout', 'AdminController@Logout');
    Route::get('/cuentas','CuentaBancariaController@index');
    Route::get('/modificarUsuario/{id}','AdminController@show');
    Route::post('/modificarUsuario','AdminController@update');
    Route::get('/nuevoUsuario','AdminController@create');
    Route::get('/usuarios','AdminController@index');
    Route::post('/nuevoUsuario','AdminController@store');
    Route::get('/verUsuario/{id}','AdminController@verusuario');
    Route::post('/eliminarUsuario','AdminController@destroy');
    Route::get('/logs','AdminController@logs');
    Route::get('/reporteUsuarios','AdminController@generarReporteUsuarios');
    // cuenta bancaria
    Route::get('/listaCuentaBancaria','CuentaBancariaController@index');
    Route::get('/nuevaCuentaBancaria','CuentaBancariaController@create');
    Route::post('/nuevaCuentaBancaria','CuentaBancariaController@store');
    Route::get('/verCuenta/{id}','CuentaBancariaController@vercuenta');
    Route::get('/modificarCuenta/{id}','CuentaBancariaController@show');
    Route::post('/modificarCuenta','CuentaBancariaController@update');
    Route::post('/eliminarCuenta','CuentaBancariaController@destroy');
    Route::get('/reportesCuentasBancarias','CuentaBancariaController@reportesCuentasBancarias');
    Route::post('/reportesCuentasBancarias','CuentaBancariaController@reportesConsultar');
    // Route::post('/reportesconsulta','CuentaBancariaController@reportesConsultar');
    Route::post('/reportegenerar','CuentaBancariaController@reporte');

    // fin cuenta bancaria
    //rubros
    Route::get('/listaRubros','RubroController@index');
    Route::get('/nuevoRubro','RubroController@create');
    Route::post('/nuevoRubro','RubroController@store');
    Route::get('/verRubro/{id}','RubroController@verrubro');
    Route::get('/modificarRubro/{id}','RubroController@show');
    Route::post('/modificarRubro','RubroController@update');
    Route::post('/eliminarRubro','RubroController@destroy');
    //fin rubros
    //puestos
    Route::get('/listaPuestos','PuestoController@index');
    Route::get('/nuevoPuesto','PuestoController@create');
    Route::post('/nuevoPuesto','PuestoController@store');
    Route::get('/verPuesto/{id}','PuestoController@verPuesto');
    Route::get('/modificarPuesto/{id}','PuestoController@show');
    Route::post('/modificarPuesto','PuestoController@update');
    Route::post('/eliminarPuesto','PuestoController@destroy');
    //fin puestos
    //cuenta por cobrar
    Route::get('/listaCuentaPC','CuentaCobrarController@index');
    Route::get('/nuevaCuentaPC','CuentaCobrarController@create');
    Route::post('/nuevaCuentaPC','CuentaCobrarController@store');
    Route::get('/verPC/{id}','CuentaCobrarController@verCP');
    Route::get('/modificarPC/{id}','CuentaCobrarController@show');
    Route::post('/modificarPC','CuentaCobrarController@update');
    Route::post('/eliminarCP','CuentaCobrarController@destroy');
    //reporetes
    Route::get('/reportesPC','CuentaCobrarController@reportesPC');
    Route::post('/reportesconsultaCobrar','CuentaCobrarController@reportesConsultarCobrar');
    Route::post('/reportegenerarCP','CuentaCobrarController@reporteCP');
    //fin cuenta por cobrar
    //cuenta por pagar
    Route::get('/listaCuentaPP','CuentaPagarController@index');
    Route::get('/nuevaCuentaPP','CuentaPagarController@create');
    Route::post('/nuevaCuentaPP','CuentaPagarController@store');
    Route::get('/verPP/{id}','CuentaPagarController@verPP');
    Route::get('/modificarPP/{id}','CuentaPagarController@show');
    Route::post('/modificarPP','CuentaPagarController@update');
    Route::post('/eliminarPP','CuentaPagarController@destroy');
    //reporetes
    Route::get('/reportesPP','CuentaPagarController@reportesPP');
    Route::post('/reportesconsulta','CuentaPagarController@reportesConsultar');
    Route::post('/reportegenerarPP','CuentaPagarController@reporteCP');
    //fin cuenta por pagar
    //salarios
    Route::get('/listaSalarios','SalarioController@index');
    Route::get('/nuevoSalario','SalarioController@create');
    Route::post('/nuevoSalario','SalarioController@store');
    Route::get('/verSalario/{id}','SalarioController@verSalario');
    Route::get('/modificarSalario/{id}','SalarioController@show');
    Route::post('/modificarSalario','SalarioController@update');
    Route::post('/eliminarSalario','SalarioController@destroy');
    //fin salarios
    //grupos Soda
    Route::get('/listaGruposSoda','AdministradorSodaController@index');
    Route::get('/nuevoGrupoSoda','AdministradorSodaController@create');
    Route::post('/nuevoGruposSoda','AdministradorSodaController@store');
    Route::get('/verGrupoSoda/{id}','AdministradorSodaController@verGrupoSoda');
    Route::get('/modificarGrupoSoda/{id}','AdministradorSodaController@show');
    Route::post('/modificarGruposSoda','AdministradorSodaController@update');
    Route::post('/eliminarGrupoSoda','AdministradorSodaController@destroy');
    //fin grupos Soda
    //entradas Soda
    Route::get('/listaEntradasSoda','EntradaSodaController@index');
    Route::get('/nuevaEntradasSoda','EntradaSodaController@create');
    Route::post('/nuevaEntradasSoda','EntradaSodaController@store');
     Route::get('/verEntradasSoda/{id}','EntradaSodaController@verEntradasSoda');
    Route::get('/modificarEntradaSoda/{id}','EntradaSodaController@show');
    Route::post('/modificarEntradaSoda','EntradaSodaController@update');
     Route::post('/eliminarEntradasSoda','EntradaSodaController@destroy');

     // Reportes entradas sodas ingresos
     Route::get('/reportesEntradas','EntradaSodaController@reportesSodaEntradas');
    Route::post('/reportesconsultaEntrada','EntradaSodaController@reportesConsultar');
    Route::post('/reportegenerarEntradas','EntradaSodaController@reportegenerarEntradas');

    //copiar
    //  Route::get('/reportesEntradas','EntradaController@reportesEntradas');
    // Route::post('/reportesconsultaEntrada','EntradaController@reportesConsultar');
    // Route::post('/reportegenerarEntradas','EntradaController@reportegenerarEntradas');
    //fin entradas Soda

    //salidas Soda
    Route::get('/listaSalidasSoda','SalidaSodaController@index');
    Route::get('/nuevaSalidaSoda','SalidaSodaController@create');
    Route::post('/nuevaSalidaSoda','SalidaSodaController@store');
    Route::get('/verSalidaSoda/{id}','SalidaSodaController@verSalidasSoda');
    Route::get('/modificarSalidaSoda/{id}','SalidaSodaController@show');
    Route::post('/modificarSalidaSoda','SalidaSodaController@update');
    Route::post('/eliminarSalidaSoda','SalidaSodaController@destroy');
    //fin salidas Soda

    //Entradas
    Route::get('/listaEntradas','EntradaController@index');
    Route::get('/nuevaEntrada','EntradaController@create');
    Route::post('/nuevaEntrada','EntradaController@store');
     Route::get('/verEntradas/{id}','EntradaController@verEntradas');
    Route::get('/modificarEntrada/{id}','EntradaController@show');
    Route::post('/modificarEntrada','EntradaController@update');
    Route::post('/eliminarEntrada','EntradaController@destroy');
    //reporetes
    Route::get('/reportesEntradas','EntradaController@reportesEntradas');
    Route::post('/reportesconsultaEntrada','EntradaController@reportesConsultar');
    Route::post('/reportegenerarEntradas','EntradaController@reportegenerarEntradas');
    //fin Entradas
    //salidas
    Route::get('/listaSalidas','SalidaController@index');
    Route::get('/nuevaSalida','SalidaController@create');
    Route::post('/nuevaSalida','SalidaController@store');
    Route::get('/verSalidas/{id}','SalidaController@verSalidas');
    Route::get('/modificarSalida/{id}','SalidaController@show');
    Route::post('/modificarSalida','SalidaController@update');
    Route::post('/eliminarSalida','SalidaController@destroy');
    //reporetes
    Route::get('/reportesSalidas','SalidaController@reportesSalidas');
    Route::post('/reportesconsultaSalidas','SalidaController@reportesconsultaSalidas');
    Route::post('/reportegenerarSalidas','SalidaController@reportegenerarSalidas');
    //fin salidas

    Route::get('/reportesMovimientos','MovEntradaController@index');
    Route::post('/reporteMovimientos','MovEntradaController@reporteMovimientos');
    Route::post('/reportegenerarMovimiento','MovEntradaController@reportegenerarMovimiento');

    // digitador
    Route::get('/digitador','Digitador@index');
    // Route::get('/modificarUsuario/{id}','AdminController@show');
    // Route::post('/modificarUsuario','AdminController@update');

    // lector
    Route::get('/lector','LectorController@index');
    // Route::get('/modificarUsuario/{id}','AdminController@show');
    // Route::post('/modificarUsuario','AdminController@update');
    Route::get('/lout', 'LectorController@Logout');

    //empleados
    Route::get('/empleados','EmpleadoController@index');
    Route::get('/nuevoEmpleado','EmpleadoController@create');
    Route::get('/verEmpleado/{id}','EmpleadoController@show');
    Route::get('/modificarEmpleado/{id}','EmpleadoController@edit');
    Route::post('/nuevoEmpleado','EmpleadoController@store');
    Route::post('/actualizarEmpleado/{id}','EmpleadoController@update');
    Route::post('/eliminarEmpleado','EmpleadoController@destroy');

    //reportes
    Route::get('/reportesalidas','SalidaController@reporteTodasSalidas');
    Route::get('/reporteentradas','EntradaController@reporteTodasEntradas');
    Route::post('/reportesalidasfecha','SalidaController@reporteFecha');




});





// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
