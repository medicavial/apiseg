<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Perfil', function (Blueprint $table) {
            $table->increments('PER_id');
            $table->string('PER_nombre');
            $table->string('PER_descripcion');
            $table->boolean('PER_activo');
            $table->integer('USR_id')->unsigned();
            $table->foreign('USR_id')
                  ->references('USR_id')
                  ->on('Usuario');
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
        Schema::drop('Perfil');
    }
}
