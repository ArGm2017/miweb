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

Route::get('/', 'HomeController@getHome');

/*Route::get('/login', function () {
return view('auth.login');
});

Route::get('logout', function () {
return 'Logout Usuario';
}); */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/catalog', 'CatalogController@getIndex')->name('catalog');
    Route::get('/catalog/show/{pelicula}', 'CatalogController@getShow');
    Route::get('/catalog/create', 'CatalogController@getCreate');
    Route::get('/catalog/edit/{pelicula}', 'CatalogController@getEdit');
    Route::post('catalog/create', 'CatalogController@postCreate');
    Route::put('catalog/edit/{pelicula}', 'CatalogController@putEdit');
    Route::put('catalog/rent/{pelicula}', 'CatalogController@putRent');
    Route::put('catalog/return/{pelicula}', 'CatalogController@putReturn');
    Route::delete('/catalog/delete/{pelicula}', 'CatalogController@deleteMovie');

});
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@getHome')->name('home');
