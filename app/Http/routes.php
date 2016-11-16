<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\sop_Muelle;
use Illuminate\Support\Facades\Input;

Route::get('/', 'HomeController@index');

Route::auth();


// ADMINISTRADOR
Route::group(['prefix'=> 'catalogos', 'namespace' => 'Catalogos', 'middleware' => 'App\Http\Middleware\IsAdmin'], function(){
	Route::controller('muelles', 'MuelleController');
	Route::controller('puertos', 'PuertoController');
	Route::controller('buques', 'BuqueController');
});

Route::group(['middleware'=>'App\Http\Middleware\IsAdmin'], function(){
	Route::controller('usuarios', 'UsuarioController');
});

Route::group(['middleware' => 'App\Http\Middleware\IsNaviera'], function(){
    Route::controller('arribos', 'ArriboController');
});

Route::group(['middleware' => 'App\Http\Middleware\IsAgente'], function(){
    Route::controller('control_arribos', 'ControlArriboController');
});