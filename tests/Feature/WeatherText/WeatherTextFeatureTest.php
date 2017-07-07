<?php

namespace Tests\Feature\WeatherText;

use App\Jobs\AddLatLongFromZipToUser;
use App\Models\WeatherText\WeatherText;
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
        $user = factory(User::class)->create(['phone' => '5555555555']);
        $this->be($user);

        $this->get('/weather-text')
            ->assertSuccessful();
    }

    /** @test */
    public function user_can_patch_time_timezone_data()
    {
        $user = factory(User::class)->create(['phone' => null, 'zip' => null]);
        $this->be($user);

        $this->patch('weather-text', [
            'time' => '13:00',
            'timezone' => 'UTC'
        ])
            ->assertStatus(302);
        $this->assertDatabaseHas('weather_texts', ['time' => '13:00']);
        $this->assertDatabaseHas('users', ['timezone' => 'UTC']);
    }

    /** @test */
    public function phone_is_required()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->be($user);

        $this->patch('weather-text', [])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['phone' => '5555555555']);

    }

    /** @test */
    public function zip_is_required()
    {
        $user = factory(User::class)->create(['zip' => null, 'phone' => '5555555555']);
        $this->be($user);

        $this->patch('weather-text', ['phone' => '6666666666'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['phone' => '6666666666']);

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

    /** @test */
    public function time_is_required()
    {
        $user = factory(User::class)->create(['phone' => '9999999999']);
        $this->be($user);

        $this->patch('weather-text', [
            'phone' => '5555555555',
            'timezone' => 'EST',
            'active' => true
        ])
            ->assertStatus(302);
        $this->assertCount(0, \DB::table('weather_texts')->get());
    }

    /** @test */
    public function if_user_doesnt_have_weather_text_associated_on_patch_then_create()
    {
        $user = factory(User::class)->create(['phone' => '9999999999']);
        $this->be($user);

        $this->assertNull($user->weatherText);

        $this->patch('weather-text', [
            'timezone' => 'EST',
            'active' => true,
            'time' => '07:00',
        ]);

        $this->assertDatabaseHas('users', [
            'timezone' => 'EST',
        ]);

        $this->assertDatabaseHas('weather_texts', [
            'user_id' => $user->id,
            'active' => true,
            'time' => '12:00', // converted in WeatherTextRepository
        ]);
    }

    /** @test */
    public function if_user_has_weather_text_associated_simply_update()
    {
        $user = factory(User::class)->create(['phone' => '9999999999']);
        $weatherText = new WeatherText([
            'time' => '8:00',
            'active' => true,
        ]);
        $user->weatherText()->save($weatherText);
        $this->be($user);

        $this->patch('weather-text', [
            'timezone' => 'EST',
            'active' => true,
            'time' => '7:00',
        ]);

        $this->assertDatabaseHas('users', [
            'timezone' => 'EST',
        ]);
        $this->assertDatabaseHas('weather_texts', [
            'user_id' => $user->id,
            'active' => true,
            'time' => '12:00', // converted in WeatherTextRepository
        ]);
    }
}
