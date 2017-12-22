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

Route::group(['prefix' => 'v1'], function () {
	Route::get('/catalog', 'APICatalogController@index');
	Route::get('/catalog/{id}', 'APICatalogController@show');
	Route::group(['middleware' => 'auth.basic.once'], function () {
		Route::resource('catalog', 'APICatalogController', ['except' => ['index', 'show', 'edit', 'create']]);
		Route::put('/catalog/{id}/rent', 'APICatalogController@putRent');
		Route::put('/catalog/{id}/return', 'APICatalogController@putReturn');
		Route::post('/catalog', 'APICatalogController@store');
	});
});
