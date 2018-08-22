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
    Route::get('/administrador','AdminController@index');
    Route::get('/modificarUsuario/{id}','AdminController@show');
    Route::post('/modificarUsuario','AdminController@update');
    Route::get('/nuevoUsuario','AdminController@create');
    Route::post('/nuevoUsuario','AdminController@store');
    Route::get('/verUsuario/{id}','AdminController@verusuario');
    Route::post('/eliminarUsuario','AdminController@destroy');
    Route::get('/logs','AdminController@logs');
    // cuenta bancaria
    Route::get('/listaCuentaBancaria','CuentaBancariaController@index');
    Route::get('/nuevaCuentaBancaria','CuentaBancariaController@create');
    Route::post('/nuevaCuentaBancaria','CuentaBancariaController@store');
    Route::get('/verCuenta/{id}','CuentaBancariaController@vercuenta');
    Route::get('/modificarCuenta/{id}','CuentaBancariaController@show');
    Route::post('/modificarCuenta','CuentaBancariaController@update');
    Route::post('/eliminarCuenta','CuentaBancariaController@destroy');
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
    //fin cuenta por cobrar
    //cuenta por pagar
    Route::get('/listaCuentaPP','CuentaPagarController@index');
    Route::get('/nuevaCuentaPP','CuentaPagarController@create');
    Route::post('/nuevaCuentaPP','CuentaPagarController@store');
    Route::get('/verPP/{id}','CuentaPagarController@verPP');
    Route::get('/modificarPP/{id}','CuentaPagarController@show');
    Route::post('/modificarPP','CuentaPagarController@update');
    Route::post('/eliminarPP','CuentaPagarController@destroy');
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
    // Route::get('/modificarEntradasSoda/{id}','EntradaSodaController@show');
    // Route::post('/modificarEntradasSoda','EntradaSodaController@update');
     Route::post('/eliminarEntradasSoda','EntradaSodaController@destroy');
    //fin entradas Soda

    //salidas Soda
    Route::get('/listaSalidasSoda','SalidaSodaController@index');
    // Route::get('/nuevoGrupoSoda','SalidaSodaController@create');
    // Route::post('/nuevoGruposSoda','SalidaSodaController@store');
    // Route::get('/verGrupoSoda/{id}','SalidaSodaController@verGrupoSoda');
    // Route::get('/modificarGrupoSoda/{id}','SalidaSodaController@show');
    // Route::post('/modificarGruposSoda','SalidaSodaController@update');
    // Route::post('/eliminarGrupoSoda','SalidaSodaController@destroy');
    //fin salidas Soda

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


});





// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
