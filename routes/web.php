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

Route::post('/admin', 'UserController@login');
Route::get('/logout', 'UserController@logout');

Route::get('/admin', function () {
    return view('login');
});

