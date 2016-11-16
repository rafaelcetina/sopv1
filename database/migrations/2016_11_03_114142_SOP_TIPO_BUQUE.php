<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SOPTIPOBUQUE extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SOP_TIPO_BUQUES', function (Blueprint $table) {
            $table->increments('TIBU_ID');
            $table->string('TIBU_TIPO');
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
        Schema::drop('SOP_TIPO_BUQUES');
    }
}
