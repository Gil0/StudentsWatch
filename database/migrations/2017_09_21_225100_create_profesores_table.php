<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('profesores', function(Blueprint $table){
            $table->increments('idProfesor');               
            $table->string('cubiculo')->nullable();            
            $table->float('calificacion')->default(0);            
            $table->string('descripcion',300);
            $table->string('hobbies',150);
            $table->timestamps();                        
            $table->rememberToken();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profesores');
    }
}
