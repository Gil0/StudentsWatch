<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [            
            'name' => 'required|max:255',
            'matricula' => 'required|numeric|digits:9|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',            
            'is_profesor' => 'boolean',
        ]);
    }
    public function informacionCuenta(Request $request, $id){        
        $ID=Crypt::decrypt($id);
        $info = DB::table('users')->where('id',$ID)->first();     
        return view('/configuracion',['info'=>$info]);       
    }
    public function guardarCambios(Request $request, $id)
    {                
        $ID=Crypt::decrypt($id);         
        DB::table('users')->where('id',$ID)->update([
            'name' => $request->name,            
        ]);
        $info = DB::table('users')->select('*')->where('id',$ID)->first();         
        return redirect()->action('HomeController@informacionCuenta',['id'=>$id]);
    }
    public function guardarImagen(Request $request, $id)
    {   
        /**
        * Aqui se hace la validacion de imagen
        *
        * Solo permite jpeg,png,jpg,bmp,tiff y gif
        *
        **/
        $this->validate($request, [
        'imagen' => 'mimes:jpeg,png,bmp,tiff |max:4096',
        ],
        $messages = [
            'required' => 'The :attribute field is required.',
            'mimes' => 'Solo se permiten imagenes en este campo. jpeg, png, bmp,tiff son formatos validos.'
        ]
        );
        $ID=Crypt::decrypt($id); 
        /**
        * Aqui se hace la insercion a la BD y a la carpeta public/uploads
        *
        * En el .gitignore omitimos los cambios a esta carpeta
        *
        **/     
        $direccionImagen=base_path().'/public/uploads/';        
        $IMAGEN = "";
        if($request->hasFile('imagen'))
        {
            $IMAGEN = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move($direccionImagen, $IMAGEN);
        }else{
            $nombreImagen = NULL;
        }
        DB::table('users')->where('id',$ID)->update([
            'imagen' => $IMAGEN,            
        ]);           
        $info = DB::table('users')->select('*')->where('id',$ID)->first();         
        return redirect()->action('HomeController@informacionCuenta',['id'=>$id]);
    }
}
