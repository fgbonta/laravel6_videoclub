<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API publicas
//Rutas con el prefijo v1
Route::group(['prefix'=>'v1'],function(){
	
	Route::get('/catalog','APICatalogController@index');
	Route::get('/catalog/show/{id}','APICatalogController@show');
	Route::PUT('/catalog/rent','APICatalogController@alquilar');		
	Route::put('/catalog/return','APICatalogController@devolver');

});

//API con autenticacion
////Rutas con el prefijo v1
Route::group(['middleware'=>'auth'],function(){	
		
	Route::group(['prefix'=>'v1'],function(){
		
			
	});	
});
