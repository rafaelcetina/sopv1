<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_buque extends Model
{
   protected $primaryKey = 'BUQU_ID';

   use SoftDeletes;

   //protected $dateFormat = 'Y-d-m H:i:s';

   protected $dates = ['created_at', 'updated_at', 'deleted_at'];

   public static function buques($id){
		return sop_Buque::where('BUQU_TIPO_BUQUE','=',$id)
		->get();
	}
   /*
   Schema::table('SOP_BUQUES', function ($table) {
    $table->softDeletes();
	});
    */
}