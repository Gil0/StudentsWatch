<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //El constructor es el encargado de inicializar la instancia del controlador.
        //Se carga el middleware auth en todo controlador que requiera tener una sesion activa 
        //para poder ser utilizado una vez iniciada la sesion con email y password
        $this->middleware('auth');
    }
    public function index(){
        return view('/Profesor/ProfesorHome');
    }
    public function miInformacion(Request $request,$id){   
        $ID=Crypt::decrypt($id);          
        $informacionProfesor = DB::table('profesores')->where('user_id',$ID)->first();              
        $academica = DB::table('formacionAcademica')->select('*')->where('idProfesor',$informacionProfesor->idProfesor)->get();
        $laboral = DB::table('informacionLaboral')->select('*')->where('idProfesor',$informacionProfesor->idProfesor)->get();        
        return view('/Profesor/Informacion')->with('informacionProfesor',$informacionProfesor)->with( 'academica',$academica)->with('laboral',$laboral);                  
    }
    public function guardarInformacionPersonal(Request $request, $id)
    {                
        $ID=Crypt::decrypt($id);         
        DB::table('profesores')->where('user_id',$ID)->update([
            'descripcion' => $request->descripcion,   
            'cubiculo' => $request->cubiculo,   
            'hobbies' => $request->hobbies,            
        ]);
        $informacionProfesor = DB::table('profesores')->where('user_id',$ID)->first();                  
        return redirect()->action('ProfesorController@miInformacion',['id'=>$id]);
    }  
    public function informacionAcademica(Request $request){
        DB::table('formacionAcademica')->insert([
             'escuela' => $request->escuela,
             'estudios' => $request->estudios,
             'periodo' =>$request->periodo,
             'idProfesor' =>$request->idProfesor
         ]);
         $ID=Crypt::encrypt($request->id);
         return redirect()->action('ProfesorController@miInformacion',['id'=>$ID]);
     }     
     public function informacionLaboral(Request $request){
        DB::table('informacionLaboral')->insert([
             'lugar_trabajo' => $request->lugar_trabajo,
             'puesto' => $request->puesto,
             'periodo' =>$request->periodo,
             'idProfesor' =>$request->idProfesor
         ]);
         $ID=Crypt::encrypt($request->id);
         return redirect()->action('ProfesorController@miInformacion',['id'=>$ID]);
     }
    public function eliminarInformacionAcademica(Request $request, $id){      
        DB::table('formacionAcademica')->where('idFormacionAcademica', $id)->delete();
        $usuario = DB::table('profesores')->where('idProfesor',$request->idProfesor)->first();
        $ID=Crypt::encrypt($usuario->user_id);
        return redirect()->action('ProfesorController@miInformacion',['id'=>$ID]);
    }
    public function eliminarInformacionLaboral(Request $request, $id){          
        DB::table('informacionLaboral')->where('idInformacionLaboral', $id)->delete();
        $usuario = DB::table('profesores')->where('idProfesor',$request->idProfesor)->first();
        $ID=Crypt::encrypt($usuario->user_id);
        return redirect()->action('ProfesorController@miInformacion',['id'=>$ID]);
    }

    public function profesores(){
        $profesores=DB::table('users')
            ->join('users', 'users.id' , '=' ,'profesores.user_d')
            ->select('users.name', 'profesores.email', 'profesores.idProfesor', 'profesores.descripcion')
            ->where('is_profesor',1);
        return view('/Usuario/profesores')->with('profesores',$profesores);
    }
    
    public function misComentarios(Request $request,$id){   
        $ID=Crypt::decrypt($id);          
        $informacionProfesor = DB::table('profesores')->where('user_id',$ID)->first();              
        $comentarios = DB::table('comentarios')->select('*')->where('idProfesor',$informacionProfesor->idProfesor)->where('status',true)->get();        
        return view('/Profesor/MisComentarios')->with('comentarios',$comentarios);
    }

    public function misAlumnos(Request $request,$id){
        $ID=Crypt::decrypt($id); 
        $misAlumnos = DB::table('users')
            ->join('alumnos', 'alumnos.user_id' , '=' ,'users.id')
            ->select('users.name', 'users.email', 'users.id', 'alumnos.idAlumno','users.matricula')
            ->where('idTutor',$ID)            
            ->where('statusMiTutor',"Aceptado")->get();       
        $alumnos = DB::table('alumnos')
            ->join('users', 'users.id' , '=' ,'alumnos.user_id')
            ->select('users.name', 'users.email', 'users.matricula', 'alumnos.idAlumno','alumnos.statusMiTutor','alumnos.user_id')
            ->where('statusMiTutor',"Revision")
            ->where('idTutor',$ID)->get();      

        return view('/Profesor/MisAlumnos')
            ->with('misAlumnos',$misAlumnos)
            ->with('alumnos',$alumnos);
    }

    public function eliminarSolicitud(Request $request, $id){                      
        $Usuario = DB::table('alumnos')->where('idAlumno',$id)->first();
        $evento = DB::table('alumnos')->where('idAlumno',$id)->update([
            'statusMiTutor' => "Solicitud",
            'nombreTutor' => null,
            'idTutor' => 0
            ]);        
        $ID=Crypt::encrypt($Usuario->idTutor);          
        return redirect()->action('ProfesorController@misAlumnos',['id'=>$ID]);
    } 

    public function aceptarSolicitud(Request $request, $id){                      
         $evento = DB::table('alumnos')->where('idAlumno',$id)->update([
            'statusMiTutor' => $request->statusMiTutor
            ]);    
        $ID=Crypt::encrypt($request->idUsuario);          
        return json_encode('Solicitud Aceptada');
        //return redirect()->action('ProfesorController@misAlumnos',['id'=>$ID]);
    }

    public function verProgreso(Request $request, $id){
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
}
