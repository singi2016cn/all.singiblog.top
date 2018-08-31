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
    return redirect()->route('market.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/crosswords', 'HomeController@crosswords')->name('home.crosswords');

Route::Resource('market','Frontend\MarketController');

Route::Resource('crosswords','Frontend\CrosswordsController');
Route::post('crosswords/check','Frontend\CrosswordsController@check')->name('crosswords.check');

Route::Resource('tagclouds','Frontend\TagCloudsController');

Route::Resource('adventures','Frontend\AdventuresController');

Route::Resource('sentences','Frontend\SentencesController');

Route::Resource('resources','Frontend\ResourcesController');

Route::Resource('feedbacks','Frontend\FeedbacksController');

Route::Resource('demands','Frontend\DemandsController');

Route::get('/backend','BackendController@index')->name('backend');
Route::prefix('backend')->name('backend.')->group(function () {
    Route::get('login','Backend\LoginController@showLoginForm')->name('showLoginForm');
    Route::post('login','Backend\LoginController@login')->name('login');
    Route::post('logout', 'Backend\LoginController@logout')->name('logout');

    Route::Resource('crosswords','Backend\CrosswordsController');
    Route::get('crosswords_counts/crosswords_create/{id}','Backend\CrosswordsCountsController@crosswords_create')->name('crosswords_counts.crosswords_create');
    Route::Resource('crosswords_counts','Backend\CrosswordsCountsController');

    Route::Resource('sentences','Backend\SentencesController');

    Route::Resource('resources','Backend\ResourcesController');
});

Route::prefix('/api')->name('api.')->group(function () {
    Route::post('crosswords/get_crosswords','Api\CrosswordsController@get_crosswords')->name('crosswords.get_crosswords');
    Route::post('crosswords/del_crosswords','Api\CrosswordsController@del_crosswords')->name('crosswords.del_crosswords');

    Route::post('resources/update_resources','Api\ResourcesController@update_resources')->name('resources.update_resources');
    Route::post('demands/find','Api\DemandsController@find')->name('demands.find');
});

