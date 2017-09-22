<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->integer('matricula')->unique();
            $table->binary('imagen')->nullable();
			$table->boolean('is_admin')->default(false);
            $table->boolean('is_profesor');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('matricula');
            $table->dropColumn('is_admin');        
            $table->dropColumn('imagen');        
        });
    }
}
