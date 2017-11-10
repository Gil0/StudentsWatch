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
}
