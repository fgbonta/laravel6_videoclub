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

Route::post('users','UsuarioController@store');
Route::post('login','UsuarioController@login');

//API token
Route::group(['middleware'=>'auth:api'],function(){

	Route::post('logout','UsuarioController@logout');

	//Rutas con el prefijo v1
	Route::group(['prefix'=>'v1'],function(){
		
		Route::get('/catalog','APICatalogController@index');
		Route::get('/catalog/show/{id}','APICatalogController@show');
		//Route::post('/catalog','APICatalogController@store');
		//Route::PUT('/catalog/{id}','APICatalogController@update');
		Route::PUT('/catalog/rent','APICatalogController@alquilar');		
		Route::put('/catalog/return','APICatalogController@devolver');
		Route::delete('/catalog/remove','APICatalogController@destroy');

	});

});
