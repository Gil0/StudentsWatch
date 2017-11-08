<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Crypt;

class userController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function password(){
        return View('welcome');
    }

    public function updatePassword(Request $request, $id){
        $ID=Crypt::decrypt($id);
        $rules = [
            'mypassword' => 'required',
            'password' => 'required|confirmed|min:6|max:18',
        ];
        
        $messages = [
            'mypassword.required' => 'El campo es requerido',
            'password.required' => 'El campo es requerido',
            'password.confirmed' => 'Los passwords no coinciden',
            'password.min' => 'El mínimo permitido son 6 caracteres',
            'password.max' => 'El máximo permitido son 18 caracteres',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->action('HomeController@informacionCuenta',['id'=>$id])->withErrors($validator);
        }
        else{
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User;
                $user->where('email', '=', Auth::user()->email)
                     ->update(['password' => bcrypt($request->password)]);
                     return redirect()->action('HomeController@informacionCuenta',['id'=>$id])->with('status', 'Contraseña cambiada con éxito');
            }
            else
            {
                return redirect()->action('HomeController@informacionCuenta',['id'=>$id])->with('message', 'Contraseña incorrecta');
            }
        }

    }
    public function profesores(){
  $profesores=DB::table('users')
            ->join('profesores', 'profesores.user_id' , '=' ,'users.id')
            ->select( 'profesores.idProfesor', 'users.name', 'users.email')
            ->get();
            //dd($profesores);
            return view('/Usuario/Profesores')->with('profesores',$profesores);
    }

    public function crearComentario(Request $request, $id){
        DB::table('comentarios')->insert([
           'comentario' => $request->comentario,
           'calificacion' => $request->calificacion,
           'fecha'=> date('Y-m-d H:i:s'),
           'idProfesor' => $id,
           'idUsuario' => $request->user,
           'status' => false,
          
       ]);
    
      return redirect()->action('UserController@profesores');
    }
    
    public function verProfesor(Request $request, $id){
        $profesores=DB::table('users')
        ->join('profesores', 'profesores.user_id' , '=' ,'users.id')
        ->select( 'profesores.idProfesor','profesores.descripcion','profesores.cubiculo', 'profesores.hobbies', 'users.name', 'users.matricula',  'users.email')
        ->where('idProfesor',$id)->first();
        $formacion_academica = DB::table('formacionacademica')->select('*')->where('idProfesor',$id)->get();
        $informacion_laboral = DB::table('informacionlaboral')->select('*')->where('idProfesor',$id)->get();
        $comentarios = DB::table('comentarios')->select('*')->where('idProfesor',$id)->paginate(3);        
         return view('/Usuario/VerProfesores')
                ->with('profesores',$profesores)
    
                ->with('formacion_academica',$formacion_academica)
                ->with('informacion_laboral',$informacion_laboral)
                ->with('comentarios',$comentarios);
    }
// materias usuario
public function materias(){
    $materias=DB::table('materias')->get();
              //dd($profesores);
              return view('Usuario.materias', ['materias' => $materias]);
      }

public function agregarMateriaCursada(Request $request, $id){
    DB::table('alumno_cursos')->insert([

       'idMateria' => $id,
       'User_id' => $request->user,
       'cursando' => false,
      
   ]);

  return redirect()->action('UserController@materias');
}

}
