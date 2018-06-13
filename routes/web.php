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

Route::get('/home', 'HomeController@index')->name('home');

Route::Resource('crosswords','Frontend\CrosswordsController');
Route::post('crosswords/check','Frontend\CrosswordsController@check')->name('crosswords.check');
Route::prefix('backend')->name('backend.')->group(function () {
    Route::Resource('crosswords','Backend\CrosswordsController');
});
