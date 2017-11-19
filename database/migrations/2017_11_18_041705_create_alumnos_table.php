<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function(Blueprint $table){
            $table->increments('idAlumno');
            $table->integer('idTutor');               
            $table->string('nombreTutor')->nullable();                                             
            $table->enum('statusMiTutor',['Solicitud','Revision','Aceptado'])->default('Solicitud');
            $table->timestamps();                        
            $table->rememberToken();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('alumnos');
    }
}
