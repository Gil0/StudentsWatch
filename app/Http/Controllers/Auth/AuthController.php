<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $CrearUsuario = User::create([
            'name' => $data['name'],
            'matricula' => $data['matricula'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_profesor' => $data['is_profesor'],
        ]);
        /**
        * Modificacion de Registro de usuario.
        *
        * Cuando un Profesor se registra, se liga de manera automatica a la tabla
        * Profesores
        */
        if($data['is_profesor']==1){
            $ID = $CrearUsuario->id;
            DB::table('profesores')->insert([          
                'user_id' => $ID,
            ]);
        }else{
            $ID = $CrearUsuario->id;
            DB::table('alumnos')->insert([          
                'user_id' => $ID,
            ]);
        }
        return $CrearUsuario;
    }
}
