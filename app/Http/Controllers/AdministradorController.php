<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;

class AdministradorController extends Controller
{
    public function __construct(){
        $this->middleware('administrador');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/Admin/homea');
    }
    public function profesores(){
        $profesores=DB::table('users')
        ->join('profesores', 'profesores.user_id' , '=' ,'users.id')
        ->select( 'profesores.*', 'users.*')
        ->get();
       // dd($profesores);
        return view('/Admin/AdminProfesores',['profesores'=>$profesores]);       
    }
    
    public function cambiarStatus(Request $request, $id)
    {
        $evento = DB::table('comentarios')->where('idComentario',$id)->update(['status' => $request->status]);
        return json_encode('Se actualizó el status correctamente');
    }

    public function comentarios(){
         $comentarios = DB::table('comentarios')->select('*')->get();
        return view('/Admin/AdminComentarios',['comentarios'=>$comentarios]);
     }

     
    public function eliminarProfesor(Request $request, $id)
    {
        DB::table('users')->where('id',$id)->delete();

         return redirect()->action('AdministradorController@profesores');
    }

    public function hacerTutor(Request $request, $id)
    {
        $evento = DB::table('users')->where('id',$id)->update(['is_tutor' => $request->is_tutor,]);
        return json_encode('Se actualizó el status ');
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

}