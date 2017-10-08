<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;

class AdministradorController extends Controller
{
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
}