<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SopBuque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SOP_BUQUES', function (Blueprint $table) {
            $table->increments('BUQU_ID');
            $table->string('BUQU_NOMBRE');
            $table->string('BUQU_BANDERA');
            $table->integer('BUQU_TIPO_BUQUE');
            $table->string('BUQU_MATRICULA')->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('BUQU_TIPO_BUQUE')
            ->references('TIBU_ID')->on('SOP_TIPO_BUQUES')
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
        Schema::drop('SOP_BUQUES');
    }
}
