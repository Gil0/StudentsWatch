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


/*
|--------------------------------------------------------------------------
| Rutas de Configuración
|--------------------------------------------------------------------------
|
| Aqui se encuentran las rutas que redireccionan a la configuracion de cuenta
| de todos los niveles de usuario.
|
*/
Route::get('/home', 'HomeController@index');
Route::get('/configuracion/{id}','HomeController@informacionCuenta');
Route::post('/configuracion/{id}/guardarCambios','HomeController@guardarCambios');
Route::post('/configuracion/{id}/guardarImagen','HomeController@guardarImagen');
Route::post('/configuracion/{id}/actualizarContraseña','HomeController@actualizaContraseña');
Route::post('configuracion/{id}/updatepassword', 'userController@updatePassword');
/*
|--------------------------------------------------------------------------
| Rutas de Profesores
|--------------------------------------------------------------------------
|
| Aqui se encuentran las rutas a las funcionalidades de profesores.
|
*/
Route::get('/Profesor/Informacion/{id}',  ['middleware' => 'profesor', 'uses' => 'ProfesorController@miInformacion']);
Route::post('/Profesor/Informacion/{id}/guardarInformacionPersonal', ['middleware' => 'profesor', 'uses' => 'ProfesorController@guardarInformacionPersonal']);
Route::post('/Profesor/Informacion/academica/crear',['middleware' => 'profesor', 'uses' => 'ProfesorController@informacionAcademica']);
Route::post('/Profesor/Informacion/laboral/crear',['middleware' => 'profesor', 'uses' => 'ProfesorController@informacionLaboral']);
Route::post('/Profesor/Informacion/academica/{id}/eliminar',['middleware' => 'profesor', 'uses' => 'ProfesorController@eliminarInformacionAcademica']);
Route::post('/Profesor/Informacion/laboral/{id}/eliminar', ['middleware' => 'profesor', 'uses' => 'ProfesorController@eliminarInformacionLaboral']);
/*
|--------------------------------------------------------------------------
| Rutas de Administradores
|--------------------------------------------------------------------------
|
| Aqui se encuentran las rutas a las funcionalidades de administrador.
|
*/
Route::get('Admin/Home', function(){
	return view('/Admin/AdminHome');
});

Route::get('/Admin/Profesores',  ['middleware' => 'administrador', 'uses' => 'AdministradorController@profesores']);