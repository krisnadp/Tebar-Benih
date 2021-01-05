<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('layouts.home');
// });

Route::get('/', 'HomeController@homepage')->name('home');
// Route::get('/home', 'HomeController@index')->name('homepage');
Route::get('/projects', 'HomeController@project')->name('project.all');
Route::get('/project/{project}', 'HomeController@project_detail')->name('project.detail');
Route::post('/project/{project}', 'HomeController@project_beli')->name('project.beli')->middleware('auth');

Route::get('/home', 'ProfileController@index')->name('homepage');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');


Route::get('/testing', function () {
    $ezpay = config('app.ezpay') . "<br>";
    $cilik = config('app.cilik') . "<br>";
    $smart = config('app.smart') . "<br>";
    $jogja = config('app.jogja') . "<br>";
    $tebar = config('app.tebar') . "<br>";
    $sinao = config('app.sinao') . "<br>";

    $teks = $ezpay . $cilik . $smart . $jogja . $tebar . $sinao;
    return $teks;
});
