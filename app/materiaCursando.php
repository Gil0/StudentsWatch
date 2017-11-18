<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materiaCursando extends Model
{
    
    public function user(){
        return $this->belongsTo('App\User', 'id','id_user');
    }

    public function materia(){
        return $this-> belongsTo('App\materia', 'idMateria', 'idMateria');
    }
}
