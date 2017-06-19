<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->increments('USR_id');
            $table->string('USR_login');
            $table->string('USR_nombre');
            $table->string('USR_aPaterno');
            $table->string('USR_aMaterno');
            $table->string('USR_correo')->unique();
            $table->string('USR_password', 60);
            $table->boolean('USR_activo');
            $table->string('USR_pregunta');            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Usuario');
    }
}
