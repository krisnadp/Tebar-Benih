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

Route::name('kantong.')->middleware('can:member')->prefix('kantong')->group(function() {
    Route::get('/', 'KantongController@index')->name('index');
    Route::delete('/{projectuser}/destroy', 'KantongController@destroy')->name('destroy');
});
