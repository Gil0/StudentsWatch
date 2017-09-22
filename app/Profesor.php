<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{   
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cubiculo','calificacion'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'remember_token'
    ];
    /**
    *		Relations
    **/
    public function User()
    {
    	return $this->belongsTo('App\User');
    }
    public function formacionAcademica()
    {
        return $this->hasMany('App\academica', 'idProfesor', 'idProfesor');
    }
    public function informacionLaboral()
    {
        return $this->hasMany('App\InformacionLaboralModel', 'idProfesor', 'idProfesor');
    }
    public function comentario()
    {
        return $this->hasMany('App\comentario', 'idProfesor', 'idProfesor');
    }
}
