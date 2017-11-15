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
        $this->middleware('auth');
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
        ->paginate(8);
       // dd($profesores);
        return view('/Admin/AdminProfesores',['profesores'=>$profesores]);       
    }
    
    public function cambiarStatus(Request $request, $id)
    {
        $evento = DB::table('comentarios')->where('idComentario',$id)->update(['status' => $request->status]);

        /**
         * Asignar calificacion
         */
        $comentarios= DB::table('comentarios')
            ->where('idProfesor',$request->idProfesor)
            ->where('status',1)
            ->get();
        if($comentarios){
            $Ncomentarios = count($comentarios);
            $suma=0;
            foreach ($comentarios as $comentarios) {
                $suma+=$comentarios->calificacion;
            }
            $calificacion=$suma/$Ncomentarios;
        }else{
            $calificacion=0;
        }
        $AsignarCalificacion = DB::table('profesores')->where('idProfesor',$request->idProfesor)->update(['calificacion' => $calificacion]);
        return json_encode('Se actualizó el status correctamente');
    }

    public function comentarios(){
         $comentarios = DB::table('comentarios')->select('*')->paginate(8);
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
        $formacion_academica = DB::table('formacionAcademica')->select('*')->where('idProfesor',$id)->get();
        $informacion_laboral = DB::table('informacionLaboral')->select('*')->where('idProfesor',$id)->get();
        $comentarios = DB::table('comentarios')->select('*')->where('idProfesor',$id)->paginate(3);        
         return view('/Usuario/VerProfesores')
                ->with('profesores',$profesores)
                ->with('formacion_academica',$formacion_academica)
                ->with('informacion_laboral',$informacion_laboral)
                ->with('comentarios',$comentarios);
    }

    public function Materias(){
        $materias = DB::table('materias')->select('*')->get();
    // dd($materias);
       return view('/Admin/materias',['materias'=>$materias]);
    }

    public function crearMateria(Request $request){
        DB::table('materias')->insert([
           'nombre' => $request->materia
       ]);
      return redirect()->action('AdministradorController@Materias');
    }

    public function eliminarMateria(Request $request, $id)
    {
        DB::table('materias')->where('idMateria',$id)->delete();

         return redirect()->action('AdministradorController@Materias');
    }

    public function Alumnos(){
        $users=DB::table('users')->where('is_profesor',0)->where('is_admin',0)->get();
        return view('/Admin/AdminUsuarios',['users'=>$users]);       
    }

    public function eliminarAlumno(Request $request, $id)
    {
        DB::table('users')->where('id',$id)->delete();

         return redirect()->action('AdministradorController@Alumnos');
    }

    public function editarMateria(Request $request, $id)
    {                        
        DB::table('materias')->where('idMateria',$id)->update([
            'nombre' => $request->nombre,            
        ]);
        $info = DB::table('materias')->select('*')->where('idMateria',$id)->first();         
        return redirect()->action('AdministradorController@Materias');
    }
}