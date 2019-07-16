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


Route::get('/', 'ProductController@ProductAllWelcome')->name('welcome');


Auth::routes();


Route::middleware('checkmanage')->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/', 'ProductController@index')->name('indexProduct');

        Route::get('/add', 'ProductController@create')->name('addProduct');
        Route::post('/add', 'ProductController@store')->name('storeProduct');

        Route::get('/edit/{id}', 'ProductController@edit')->name('editProduct');
        Route::post('/edit/{id}', 'ProductController@update')->name('updateProduct');

        Route::post('/delete', 'ProductController@delete')->name('deleteProduct');
    });

    Route::prefix('event')->group(function () {
        Route::get('/', 'EventController@index')->name('indexEvent');

        Route::get('/add', 'EventController@create')->name('addEvent');
        Route::post('/add', 'EventController@store')->name('storeEvent');

        Route::get('/edit/{id}', 'EventController@edit')->name('editEvent');
        Route::post('/edit/{id}', 'EventController@update')->name('updateEvent');

        Route::post('/delete', 'EventController@delete')->name('deleteEvent');

    });

    Route::prefix('bill')->group(function () {
        Route::get('/', 'BillController@index')->name('indexBill');

        Route::get('/add', 'BillController@create')->name('addBill');
        Route::post('/add', 'BillController@store')->name('storeBill');

        Route::get('/edit/{id}', 'BillController@edit')->name('editBill');
        Route::post('/edit/{id}', 'BillController@update')->name('updateBill');

        Route::post('/delete', 'BillController@delete')->name('deleteBill');

    });

    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('indexCategory');

        Route::get('/add', 'CategoryController@create')->name('addCategory');
        Route::post('/add', 'CategoryController@store')->name('storeCategory');

        Route::get('/edit/{id}', 'CategoryController@edit')->name('editCategory');
        Route::post('/edit/{id}', 'CategoryController@update')->name('updateCategory');

        Route::post('/delete', 'CategoryController@delete')->name('deleteCategory');

    });

    Route::prefix('comment')->group(function () {
        Route::get('/', 'CommentController@index')->name('indexComment');

        Route::post('/delete', 'CommentController@delete')->name('deleteComment');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('indexCategory');

        Route::get('/add', 'CategoryController@addCategory')->name('addCategory');
        Route::post('/add', 'CategoryController@storeCategory')->name('storeCategory');
    });

    Route::get('/indexManage', 'CreateManageController@index')->name('indexManage');

    Route::get('/createManage', 'CreateManageController@create')->name('createManage');
    Route::post('/storeManage', 'CreateManageController@store')->name('storeManage');

    Route::get('/editManage/{id}', 'CreateManageController@edit')->name('editManage');
    Route::post('/updateManage/{id}', 'CreateManageController@update')->name('updateManage');

    Route::post('/destroyManage', 'CreateManageController@destroy')->name('destroyManage');
});

Route::prefix('ShoppingCart')->group(function () {
    Route::get('/add/{id}', 'ShopingCartController@add')->name('addCart');

    Route::post('/delete', 'ShopingCartController@delete')->name('deleteCart');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('checkadmin');
Route::get('/manage', 'HomeController@manage')->name('manage')->middleware('checkmanage');
Route::get('/','HomeController@welcome')->name('welcome');
