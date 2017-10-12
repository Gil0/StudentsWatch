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
        $profesores = DB::table('users')->where('is_Profesor',true)->get();
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
}