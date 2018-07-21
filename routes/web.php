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
    Route::get('/administrador','AdminController@index');
    Route::get('/modificarUsuario/{id}','AdminController@show');
    Route::post('/modificarUsuario','AdminController@update');
    
    // digitador

    Route::get('/digitador','Digitador@index');
    Route::get('/modificarUsuario/{id}','AdminController@show');
    Route::post('/modificarUsuario','AdminController@update');
    
    
    
});





// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
