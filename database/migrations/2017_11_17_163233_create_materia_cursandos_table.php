<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriaCursandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_cursandos', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('idMateria')->unsigned();
            $table->string('nombre');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('materia_cursandos');
    }
}
