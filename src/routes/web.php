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

Route::get('decks/check', 'DeckController@check')->name('decks.check')->middleware('auth');

//CalcControllerに関するroute
Route::prefix('decks')->group(function () {
    Route::prefix('calc')->group(function () {
        Route::get('index', 'CalcController@index')->name('calc.index');
        Route::get('mulligan,CalcController@mulligan')->name('decks.calcRidirect');
        Route::post('mulligan','CalcController@calc')->name('decks.calc');
    });
});

Route::resource('decks', 'DeckController')->middleware('auth');

//CardSearchControllerに関するroute
Route::prefix('decks')->group(function () {
    Route::prefix('search')->group(function () {
        Route::get('/index', 'CardSearchController@index')->name('search.index');
        //Route::patch('/search', 'CardSearchController@cardGet')->name('search.cardGet');
        Route::get('/search', 'CardSearchController@search');
        Route::patch('/search', 'CardSearchController@search')->name('search.search');
    });
});


