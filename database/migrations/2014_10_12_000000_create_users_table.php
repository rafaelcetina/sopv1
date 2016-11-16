<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_tipo_usuario');
            $table->integer('id_puerto')->nullable();
            $table->string('usuario');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nombre');
            $table->string('nombrecorto');
            $table->string('empresa');
            $table->string('domicilio');
            $table->string('rfc');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_tipo_usuario')
            ->references('id')->on('tipo_usuario')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
