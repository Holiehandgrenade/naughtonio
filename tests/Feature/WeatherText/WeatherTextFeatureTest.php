<?php

namespace Tests\Feature\WeatherText;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherTextFeatureTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /** @test */
    public function user_can_visit_weather_text_url()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->get('/weather-text')
            ->assertSuccessful();
    }
}
