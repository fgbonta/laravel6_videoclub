<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/catalog');    
});

Route::get('/login',function(){
	return view('auth.login');
});

Route::get('/salir','LogoutController@salir');


//API publicas
//Rutas con el prefijo api
Route::group(['prefix'=>'api'],function(){
	//Rutas con el prefijo api/v1
	Route::group(['prefix'=>'v1'],function(){
		//Rutas con el prefijo api/v1/Catalog
		Route::get('/catalog','APICatalogController@index');
	});
});

//API con autenticacion
Route::group(['middleware'=>'auth.basic'],function(){
	//Rutas con el prefijo api
	Route::group(['prefix'=>'api'],function(){
		//Rutas con el prefijo api/v1
		Route::group(['prefix'=>'v1'],function(){
			//Rutas con el prefijo api/v1/Catalog
			//Route::get('/catalog','CatalogController@apiV1Catalog');
		});
	});
});

Route::group(['middleware'=>'auth'],function(){

	Route::get('/catalog','CatalogController@getIndex');

	Route::get('/catalog/show/{id}','CatalogController@getShow');

	Route::get('/catalog/create','CatalogController@getCreate');

	Route::post('/catalog/create','CatalogController@postCreate');

	Route::get('/catalog/edit/{id}','CatalogController@getEdit');

	Route::put('/catalog/edit','CatalogController@putEdit');

	Route::get('/catalog/alquilarPelicula/{id}','CatalogController@ConfirmarAlquilarPelicula');

	Route::put('/catalog/alquilarPelicula','CatalogController@alquilarPelicula');

	Route::get('/catalog/devolverPelicula/{id}','CatalogController@ConfirmarDevolverPelicula');

	Route::put('/catalog/devolverPelicula','CatalogController@devolverPelicula');	

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


