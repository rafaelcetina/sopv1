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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index_ajax');

Route::auth();

Route::controller('home', 'HomeController');

Route::controller('pdf', 'PdfController');



// ADMINISTRADOR
Route::group(['prefix'=> 'catalogos', 'namespace' => 'Catalogos', 'middleware' => 'App\Http\Middleware\IsAdmin'], function(){
	Route::controller('muelles', 'MuelleController');
	Route::controller('puertos', 'PuertoController');
	Route::controller('buques', 'BuqueController');
	Route::controller('tcargas', 'TcargaController');
	Route::controller('tproductos', 'TproductoController');
});

Route::group(['middleware'=>'App\Http\Middleware\IsAdmin'], function(){
	Route::controller('usuarios', 'UsuarioController');
});

Route::group(['middleware' => 'App\Http\Middleware\IsNaviera'], function(){
    Route::controller('arribos', 'ArriboController');
});

Route::group(['middleware' => 'App\Http\Middleware\IsAgente'], function(){
    Route::controller('cargas', 'CargaController');
    Route::controller('control_arribos', 'ControlArriboController');
});