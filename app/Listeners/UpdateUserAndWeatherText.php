<?php

namespace App\Listeners;

use App\Events\WeatherTextUpdated;
use App\Models\WeatherText\WeatherText;
use Auth;
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
        $user = Auth::user();

        if ( ! $weatherText = $user->weatherText) {
            $weatherText = new WeatherText();
        }

        $weatherText->fill([
            'time' => $event->data['time'],
            'active' => $event->data['active'],
        ]);

        $user->weatherText()->save($weatherText);

        $user->update([
            'phone' => $event->data['phone'],
            'timezone' => $event->data['timezone'],
        ]);
    }
}
