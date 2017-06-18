<?php

namespace Tests\Unit\WeatherText;

use App\Models\WeatherText\WeatherText;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherTextUnitTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /** @test */
    public function a_user_has_nullable_phone()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->assertDatabaseHas('users', $user['attributes']);
    }

    /** @test */
    public function can_get_all_weather_texts_in_a_fifteen_minute_block()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $weatherTextOne = new WeatherText([
            'time' => Carbon::now()->addMinutes(5)->format('H:i'),
            'active' => 1,
        ]);
        $weatherTextTwo = new WeatherText([
            'time' => Carbon::now()->addMinutes(20)->format('H:i'),
            'active' => 1,
        ]);

        $userOne->weatherText()->save($weatherTextOne);
        $userTwo->weatherText()->save($weatherTextTwo);

        $fiftenMinutes = WeatherText::withinFifteenMinutes()->get();

        $this->assertTrue($fiftenMinutes->pluck('time')->contains($weatherTextOne->time));
        $this->assertFalse($fiftenMinutes->pluck('time')->contains($weatherTextTwo->time));
    }
}
