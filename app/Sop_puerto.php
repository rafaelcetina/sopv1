<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_puerto extends Model
{
   protected $primaryKey = 'PUER_ID'; // or nul
   
   use SoftDeletes;

   //protected $dateFormat = 'Y-d-m H:i:s';

   
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];
   /*
   Schema::table('SOP_MUELES', function ($table) {
    $table->softDeletes();
	});
	*/
}