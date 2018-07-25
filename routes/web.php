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
    Route::get('/listaCuentaBancaria','CuentaBancariaController@index');
    Route::post('/listaCuentaBancaria','CuentaBancariaController@store');



    // digitador
    Route::get('/digitador','Digitador@index');
    // Route::get('/modificarUsuario/{id}','AdminController@show');
    // Route::post('/modificarUsuario','AdminController@update');

    // lector
    Route::get('/lector','LectorController@index');
    // Route::get('/modificarUsuario/{id}','AdminController@show');
    // Route::post('/modificarUsuario','AdminController@update');
    Route::get('/lout', 'LectorController@Logout');




});





// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
