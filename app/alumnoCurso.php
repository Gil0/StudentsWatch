<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alumnoCurso extends Model
{
    protected $filleable=[
        'cursando'
    ];

    public function materia(){
        return $this-> belongsTo('App\profesor', 'idMateria', 'idMateria');
    }
   
}
