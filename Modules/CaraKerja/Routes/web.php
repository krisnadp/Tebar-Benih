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

Route::name('way.')->middleware('can:admin')->prefix('way')->group(function() {
    Route::get('/', 'CaraKerjaController@index')->name('index');
    Route::post('/', 'CaraKerjaController@index');
});
