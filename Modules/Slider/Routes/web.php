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

Route::name('slider.')->middleware('can:admin')->prefix('slider')->group(function() {
    Route::get('/', 'SliderController@index')->name('index');
    Route::post('/', 'SliderController@index');
});
