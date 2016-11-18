<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_cargas_arribo extends Model
{
   protected $primaryKey = 'CARR_ID'; // or nul
   
   //use SoftDeletes;
   
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];
   

	protected $casts = [
        'SARR_PELIGRO' => 'bit',
    ];

}