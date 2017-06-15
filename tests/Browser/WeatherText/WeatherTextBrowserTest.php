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
            $browser->loginAs($user)
                    ->visit('/weather-text')
                    ->assertSee('Phone:');
        });
    }

    /** @test */
    public function if_user_has_phone_they_should_see_a_time_timezone_active_input()
    {
        $user = factory(User::class)->create(['phone' => '5555555555']);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/weather-text')
                ->assertSee('Time:')
                ->assertSee('Timezone:')
                ->assertSee('Active:');
        });
    }
    
    /** @test */
    public function a_user_can_enter_phone_information()
    {
        $user = factory(User::class)->create(['phone' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/weather-text')
                ->type('phone', '5555555555')
                ->assertSee('5555555555');
        });
    }
}
