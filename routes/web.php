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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('checkadmin');
Route::get('/manage', 'HomeController@manage')->name('manage')->middleware('checkmanage');

Route::get('/product', 'ProductController@index')->name('indexHome');

Route::get('/products/add', 'ProductController@create')->name('addProduct');
Route::post('/products/add', 'ProductController@store')->name('storeProduct');

Route::get('/products/edit/{id}', 'ProductController@edit')->name('editProduct');
Route::post('/products/edit/{id}', 'ProductController@update')->name('updateProduct');

Route::post('/products/delete', 'ProductController@delete')->name('deleteProduct');

Route::get('/event', 'EventController@index')->name('indexHome');

Route::get('/events/add', 'EventController@create')->name('addEvent');
Route::post('/events/add', 'EventController@store')->name('storeEvent');

Route::get('/events/edit/{id}', 'EventController@edit')->name('editEvent');
Route::post('/events/edit/{id}', 'EventController@update')->name('updateEvent');

Route::post('/events/delete', 'EventController@delete')->name('deleteEvent');
