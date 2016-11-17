<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_tcarga extends Model
{
   protected $primaryKey = 'TCAR_ID'; // or nul
   
   use SoftDeletes;
   
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];
   

}