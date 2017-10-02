<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/configuracion/{id}','HomeController@informacionCuenta');
Route::post('/configuracion/{id}/guardarCambios','HomeController@guardarCambios');
Route::post('/configuracion/{id}/guardarImagen','HomeController@guardarImagen');

//Administrador
Route::get('Admin/Home', function(){
	return view('/Admin/AdminHome');
});

Route::get('/Admin/Profesores',  ['middleware' => 'administrador', 'uses' => 'AdministradorController@profesores']);