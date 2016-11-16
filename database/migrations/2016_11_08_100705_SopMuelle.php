<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SopMuelle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SOP_MUELLES', function (Blueprint $table) {
            $table->increments('MUEL_ID');
            $table->tinyInteger('MUEL_PUERTO');
            $table->string('MUEL_NOMBRE',12);
            $table->string('MUEL_NOMBRELARGO');
            $table->tinyInteger('MUEL_CALADO');
            $table->float('MUEL_LONGITUD');
            $table->string('MUEL_DESCRIP');
            $table->integer('MUEL_TERMINAL');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('SOP_MUELLES');
    }
}
