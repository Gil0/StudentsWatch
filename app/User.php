<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','matricula','email','password','is_profesor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public function comentario(){
        return $this->hasMany('App\comentario','idUsuario', 'id');
    }
    
    public function alumnoCurso(){
        return $this->hasMany('App\alumnoCurso','user_id', 'id');
    }
    protected $hidden = [
        'password', 'remember_token',
    ];
}
