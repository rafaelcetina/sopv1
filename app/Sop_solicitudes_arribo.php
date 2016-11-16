<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_solicitudes_arribo extends Model
{
   protected $primaryKey = 'SARR_ID'; // or nul
   
   use SoftDeletes;

   //protected $dateFormat = 'Y-d-m H:i:s';

   
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];
   /*
   Schema::table('SOP_MUELES', function ($table) {
    $table->softDeletes();
	});
	*/

	protected $casts = [
        'SARR_ACTIVIDADES' => 'array',
        'SARR_ETA' => 'array',
        'SARR_ETB' => 'array',
        'SARR_ETD' => 'array',
        'SARR_HISTORIAL_PUERTOS' => 'array',
    ];

}