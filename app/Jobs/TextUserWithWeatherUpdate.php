<?php

namespace App\Jobs;

use App\Models\WeatherText\WeatherText;
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

        $weather = DarkSky::location($user->latitude, $user->longitude)
            ->daily()[0];

        $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
                [
                    'api_key' =>  getenv('NEXMO_KEY'),
                    'api_secret' => getenv('NEXMO_SECRET'),
                    'to' => $user->calling_code . $user->phone,
                    'from' => getenv('NEXMO_PHONE_NUMBER'),
                    'text' =>   'High: ' . $weather->temperatureMax . "\n" .
                        'Low: ' . $weather->temperatureMin . "\n" .
                        'Rain: ' . $weather->precipProbability * 100 . "%\n" .
                        'Humidity: ' . $weather->humidity * 100 . "%\n" .
                        'Summary: ' . $weather->summary,
                ]
            );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
    }
}


