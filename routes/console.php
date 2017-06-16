<?php

use App\Jobs\TextUserWithWeatherUpdate;
use App\Models\WeatherText\WeatherText;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/


Artisan::command('weatherText', function () {
    WeatherText::withinFifteenMinutes()
        ->get()
        ->each(function ($w) {
            dispatch(new TextUserWithWeatherUpdate($w));
        });
})->describe('Texts users with daily weather update');
