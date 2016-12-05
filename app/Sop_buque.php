<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Sop_buque extends Model
{
   protected $primaryKey = 'BUQU_ID';

   use SoftDeletes;

   protected $dates = ['created_at', 'updated_at', 'deleted_at'];

   public static function buques($id){
		return sop_Buque::leftJoin('SOP_BUQUES_USUARIOS', 'BUUS_BUQU_ID', '=', 'BUQU_ID')
		->where('BUQU_TIPO_BUQUE','=',$id)
		->where('BUUS_USUA_ID', '=', Auth::user()->id)
		->get();
	}
}