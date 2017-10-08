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
        $academica = DB::table('formacionAcademica')->select('*')->where('idProfesor',$ID)->get();
        $laboral = DB::table('informacionLaboral')->select('*')->where('idProfesor',$ID)->get();

        return view('/Profesor/Informacion')->with('informacionProfesor',$informacionProfesor)->with( 'academica',$academica)->with('laboral',$laboral);                  
    }
    public function guardarInformacionPersonal(Request $request, $id)
    {                
        $ID=Crypt::decrypt($id);         
        DB::table('profesores')->where('user_id',$ID)->update([
            'descripcion' => $request->descripcion,            
            'hobbies' => $request->hobbies,            
        ]);
        $informacionProfesor = DB::table('profesores')->where('user_id',$ID)->first();                  
        return redirect()->action('ProfesorController@miInformacion',['id'=>$id]);
    }  
    
}
