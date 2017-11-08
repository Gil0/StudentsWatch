<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_cursos', function (Blueprint $table) {
           // $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('idMateria')->unsigned();
            $table->boolean('cursando',false);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idMateria')->references('idMateria')->on('materias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alumno_cursos');
    }
}
