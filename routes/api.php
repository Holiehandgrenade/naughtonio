<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/phone-inbound', function (Request $request) {
    \Log::info('GET');
    \Log::info($request->all());
    return Response::json([], 200);
});

Route::post('/phone-inbound', function (Request $request) {
    \Log::info('POST');
    \Log::info($request->all());
    return Response::json([], 200);
});