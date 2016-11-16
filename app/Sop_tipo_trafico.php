<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_tipo_trafico extends Model
{
   protected $primaryKey = 'TTRA_ID';

   use SoftDeletes;

   protected $dates = ['created_at', 'updated_at', 'deleted_at'];
  
   /*
   Schema::table('SOP_BUQUES', function ($table) {
    $table->softDeletes();
	});
    */
}