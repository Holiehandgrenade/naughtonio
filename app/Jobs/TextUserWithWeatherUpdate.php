<?php

namespace App\Jobs;

use App\Models\WeatherText\WeatherText;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Nexmo\Laravel\Facade\Nexmo;
use DarkSky;

class TextUserWithWeatherUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $weatherText;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(WeatherText $weatherText)
    {
        $this->weatherText = $weatherText;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->weatherText->user;

        // get hourly weather for next 24 hours
        $weather = collect(DarkSky::location($user->latitude, $user->longitude)
            ->hourly())
            ->take(24);

        $maxTemp = $weather->max('temperature');
        $minTemp = $weather->min('temperature');

        $highestRain = $weather->where('precipProbability', $weather->max('precipProbability'))->sortBy('time')->values();
        $midHighestRain = $highestRain[(int)floor($highestRain->count() / 2)];

        $highestTemp = $weather->where('temperature', $maxTemp)->sortBy('time')->values();
        $midHighestTemp = $highestTemp[(int)floor($highestTemp->count() / 2)];

        $lowestTemp = $weather->where('temperature', $minTemp)->sortBy('time')->values();
        $midLowestTemp = $lowestTemp[(int)floor($lowestTemp->count() / 2)];

        $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
                [
                    'api_key' =>  getenv('NEXMO_KEY'),
                    'api_secret' => getenv('NEXMO_SECRET'),
                    'to' => $user->calling_code . $user->phone,
                    'from' => getenv('NEXMO_PHONE_NUMBER'),
                    'text' =>   'High: ' . ceil($maxTemp) .
                        " at " . Carbon::createFromTimestamp($midHighestTemp->time)->timezone($user->timezone)->format('h:i a') . "\n" .

                        'Low: ' . floor($minTemp) .
                        " at " . Carbon::createFromTimestamp($midLowestTemp->time)->timezone($user->timezone)->format('h:i a') . "\n" .

                        'Highest Rain Chance: ' . ceil($midHighestRain->precipProbability * 100) . "%" .
                        " at " . Carbon::createFromTimestamp($midHighestRain->time)->timezone($user->timezone)->format('h:i a') . "\n" .

                        'Humidity: ' . ceil($weather->avg('humidity') * 100) . "%",
                ]
            );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
    }
}


