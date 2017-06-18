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
                        ->currently()
                        ->get()['currently'];

        Nexmo::message()->send([
            'to' => $user->phone,
            'from' => getenv('NEXMO_PHONE_NUMBER'),
            'text' => 'What\'s going on? -- ',
        ]);
    }
}
