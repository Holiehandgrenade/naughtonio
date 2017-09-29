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

    Route::get('song-of-ice-and-fire-connector', 'ThronesSearcherController@show');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', 'UserController@show');
    Route::patch('/account', 'UserController@update');

    Route::get('/phone', 'PhoneController@show');
    Route::post('/phone', 'PhoneController@post')->middleware('strips-phone');
    Route::get('/phone-verify', 'PhoneController@showVerify');
    Route::post('/phone-verify', 'PhoneController@postVerify')->middleware('throttle:30,1');

    Route::get('/zip', 'ZipController@show');
    Route::post('/zip', 'ZipController@post');

    Route::group(['prefix' => 'weather-text'], function () {
        Route::get('/', 'WeatherTextController@show')
                ->middleware('requires-phone', 'requires-zip');
        Route::patch('/', 'WeatherTextController@update');
    });
});