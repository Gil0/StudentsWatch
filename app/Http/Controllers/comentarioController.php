<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\comentario;
use App\profesor;
use App\User;

class comentarioController extends Controller
{
	 public function comentarios()
    {
 
        $comentarios=DB::table('comentarios')
            ->join('profesores', 'profesores.idProfesor' , '=' ,'comentarios.idProfesor')
            ->select('profesores.calificacion',  'comentarios.comentario', 'comentarios.calificacion')
            ->where('status',1);
            return view('/Usuario/comentarios')->with('comentarios',$comentarios);
            
	}

	public function eliminarComentario(Request $request, $id)
    {
        DB::table('comentarios')->where('idComentario',$id)->delete();

         return redirect()->action('AdministradorController@comentarios');
    }


    public function profesores(){
         $profesores = DB::table('profesores')->select('*')->get();
        return view('/Usuario/Comentarios',['profesores'=>$profesores]);
     }

       public function verProfesor(Request $request, $id){
        $profesor= DB::table('profesores')->select('*')->where('idProfesor', $id)->first();
       $comentarios=DB::table('comentarios')->select('*')->where('idProfesor',$id)->where('status',1)->get();
        
        return view('/Usuario/verProfesor')->with('profesores',$profesor)->with('comentarios',$comentarios);      

    }


}
