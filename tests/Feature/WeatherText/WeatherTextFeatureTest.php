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
        $this->be($user);

        $this->get('/weather-text')
            ->assertSuccessful();
    }

    /** @test */
    public function user_can_post_phone_data()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->be($user);

        $this->post('weather-text/phone', ['phone' => '5555555555'])
            ->assertSuccessful();
        $this->assertDatabaseHas('users', ['phone' => '5555555555']);
    }

    /** @test */
    public function phone_is_required()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->be($user);

        $this->post('weather-text/phone', [])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['phone' => '5555555555']);

    }

    /** @test */
    public function timezone_is_required()
    {
        $user = factory(User::class)->create(['phone' => '9999999999']);
        $this->be($user);

        $this->patch('weather-text', [
            'phone' => '5555555555',
            'time' => '7:00',
            'active' => true
        ])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['phone' => '5555555555']);
    }
}
