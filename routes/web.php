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
Auth::login(\App\User::first());
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'public'], function () {
    Route::get('barcode', 'PublicController@barcode');
    Route::post('barcode', 'PublicController@barcodeize');

    Route::get('quoridor', 'PublicController@quoridor');

    Route::get('tiny-tables', 'PublicController@tinyTables');

    Route::get('pathfinder', 'PublicController@pathfinder');

    Route::get('genetic-pathfinder', 'PublicController@geneticPathfinder');

    Route::get('star-wars', 'PublicController@starWars');
    Route::get('starwars', 'PublicController@starWars');

    Route::get('clock', 'PublicController@clock');

    Route::get('face', 'PublicController@face');

    Route::get('loans', 'PublicController@loans');

    Route::get('jp', 'PublicController@jp');
    Route::post('jp', 'PublicController@jpPost');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'weather-text'], function () {
        Route::get('/', 'WeatherTextController@show');
        Route::post('/phone', 'WeatherTextController@phone');
    });
});