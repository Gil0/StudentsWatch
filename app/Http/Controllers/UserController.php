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
            ->paginate(4);
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
        ->select( 'profesores.idProfesor','profesores.descripcion','profesores.cubiculo', 'profesores.hobbies', 'users.name', 'users.matricula',  'users.email','profesores.calificacion')
        ->where('idProfesor',$id)->first();
        $formacion_academica = DB::table('formacionAcademica')->select('*')->where('idProfesor',$id)->get();
        $informacion_laboral = DB::table('informacionLaboral')->select('*')->where('idProfesor',$id)->get();
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

public function agregarMateriaCursada(Request $request, $id, $nombre){
    DB::table('alumno_cursos')->insert([

       'idMateria' => $id,
       'User_id' => $request->user,
       'nombre' => $nombre,
       
      
   ]);

  return redirect()->action('UserController@materias');
}

public function graficaAvance(Request $request, $id)
{
    $ID=Crypt::decrypt($id);  
    $materias = DB::table('alumno_cursos')->select('user_id', 'idMateria')->distinct()->where('user_id', '=', $ID)->get();
    $num = count($materias);   
    //dd($materias);
    //dd($num);
    $cursando =  DB::table('materia_cursandos')->select('id_user', 'idMateria')->distinct()->where('id_user', '=', $ID)->get();
    $num2 = count($cursando);   
    return view('Usuario/avanceGrafica')
    ->with('materias',$materias)
    ->with('num',$num)
    ->with('cursando',$cursando)
    ->with('num2',$num2);  
}

public function mapaAlumno(Request $request, $id)
{
    $ID=Crypt::decrypt($id);  
    $materias = DB::table('alumno_cursos')->select('user_id', 'idMateria', 'nombre' )->distinct()->where('user_id', '=', $ID)->get();
    //$num = count($materias);   
    //dd($materias);
    //dd($num);
    return view('Usuario/mapaAlumno')
    ->with('materias',$materias);
   // ->with('num',$num); 
}

public function agregarMateriaEncurso(Request $request, $id, $nombre){
    DB::table('materia_cursandos')->insert([
        'id_user' => $request->user,
       'idMateria' => $id,
       'nombre' => $nombre,
       
      
   ]);
  return redirect()->action('UserController@materias');
}

 public function verTutores(Request $request, $id){
        $tutores=DB::table('users')
            ->join('profesores', 'profesores.user_id' , '=' ,'users.id')
            ->select( 'profesores.idProfesor','users.name','users.email','profesores.user_id')
            ->where('is_tutor',1)->get();
        $ID=Crypt::decrypt($id);
        $mitutor=DB::table('alumnos')->where('user_id',$ID)->first();        
        return view('/Usuario/MiTutor')
                ->with('tutores',$tutores)    
                ->with('mitutor',$mitutor);               
    }

    public function hacermitutor(Request $request, $id){       
        $tutor = DB::table('users')->where('id',$request->idTutor)->first();
        $evento = DB::table('alumnos')->where('idAlumno',$id)->update([
            'statusMiTutor' => $request->statusMiTutor,
            'nombreTutor' => $tutor->name,
            'idTutor' => $request->idTutor
            ]);
        return json_encode('La solicitud ha sido enviada al Tutor');
    }

    public function cancelarTutor(Request $request, $id){ 
        $ID=Crypt::decrypt($id);              
        $evento = DB::table('alumnos')->where('user_id',$ID)->update([
            'statusMiTutor' => "Solicitud",
            'nombreTutor' => null,
            'idTutor' => 0
            ]);                      
        return redirect()->action('UserController@verTutores',['id'=>$id]);
    }

}
