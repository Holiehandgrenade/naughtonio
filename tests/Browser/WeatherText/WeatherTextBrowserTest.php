<?php

namespace Tests\Browser\WeatherText;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WeatherTextBrowserTest extends DuskTestCase
{
    /** @test */
    public function if_user_has_no_phone_they_should_see_a_phone_input()
    {
        $user = factory(User::class)->create(['phone' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/weather-text')
                    ->assertSee('Phone:');
        });
    }
}
