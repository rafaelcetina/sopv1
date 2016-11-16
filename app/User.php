<?php

namespace App;

use Eloquent;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

//class User extends Model {
class User extends Eloquent implements Authenticatable{
//implements Authenticatable
     use AuthenticableTrait;
    //use Illuminate\Foundation\Auth\Authenticatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'usuario', 'email', 'password', 'nombre', 'id_tipo_usuario', 'rfc', 'id_puerto', 'nombrecorto', 'empresa', 'domicilio',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    

}