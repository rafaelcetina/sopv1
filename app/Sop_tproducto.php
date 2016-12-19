<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_tproducto extends Model
{
   protected $primaryKey = 'TPRO_ID'; // or nul
   
   use SoftDeletes;
   
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];

   public static function tproductos($id){
		return Sop_tproducto::where('TPRO_TCAR_ID','=',$id)
		->get();
	}

	public static function tproducto_uni($id){
		return Sop_tproducto::where('TPRO_ID','=',$id)
		->get();
	}
   

}