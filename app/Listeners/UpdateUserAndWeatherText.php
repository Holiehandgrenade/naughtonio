<?php

namespace App\Listeners;

use App\Events\WeatherTextUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUserAndWeatherText
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  WeatherTextUpdated  $event
     * @return void
     */
    public function handle(WeatherTextUpdated $event)
    {
        //
    }
}
