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

Route::get('/login', 'UserController@create')->name('login');
Route::post('/login', 'UserController@login');

Route::get('/logout', 'UserController@logout')->name('logout');

Route::get('/', 'ProductController@show');

Route::group(['prefix' => 'product'], function () {

    Route::get('/create', 'ProductController@create')->name('add');
    Route::post('/create', 'ProductController@store');

    Route::get('/{id}', 'ProductController@index')->name('review');

    Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
    Route::put('/{id}/update', 'ProductController@update')->name('update');

    Route::delete('/{id}', 'ProductController@destroy')->name('destroy');
});
