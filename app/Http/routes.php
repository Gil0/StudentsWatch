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
Route::post('configuracion/{id}/updatepassword', 'UserController@updatePassword');
/*
|--------------------------------------------------------------------------
| Rutas de Profesores*/

Route::get('/Usuario/Profesores',  ['middleware' => 'auth', 'uses' => 'UserController@profesores']);
Route::post('/user/comentario/crear/{id}',  ['middleware' => 'auth', 'uses' => 'UserController@crearComentario']);
Route::get('/Usuario/Comentarios/{id}/ver',['middleware' => 'auth', 'uses' => 'comentarioController@verProfesor']);
//| Aqui se encuentran las rutas a las funcionalidades de profesores.


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
Route::get('/Admin/Comentarios', 'AdministradorController@comentarios');
Route::post('/Admin/Comentarios/{idComentario}/cambiarStatus', 'AdministradorController@cambiarStatus');
Route::post('/Admin/Comentarios/{id}/eliminar', 'comentarioController@eliminarComentario');