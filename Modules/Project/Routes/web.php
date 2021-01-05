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

Route::name('project.')->middleware('can:admin')->prefix('admin/project')->group(function() {
    Route::get('/', 'ProjectController@index')->name('index');
    Route::post('/', 'ProjectController@index');
    Route::get('/status', 'ProjectController@status')->name('status');
    Route::post('/status', 'ProjectController@status');
    Route::get('/category', 'ProjectController@category')->name('category');
    Route::post('/category', 'ProjectController@category');
});
