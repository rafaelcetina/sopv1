<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tipo_usuario extends Model
{
   protected $primaryKey = 'id'; // or nul
   
   protected $dates = ['created_at', 'updated_at', 'deleted_at'];



}