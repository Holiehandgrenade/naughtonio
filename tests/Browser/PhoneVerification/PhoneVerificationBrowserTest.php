<?php

namespace Tests\Browser\WeatherText;

use App\Jobs\AddLatLongFromZipToUser;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhoneVerificationBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function after_phone_submission_redirect_to_verify_page()
    {
        $this->withoutJobs();

        $user = factory(User::class)->create(['phone' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/phone')
                ->type('phone', '5555555555')
                ->click('input[type="submit"]');
            $browser->assertPageIs('/phone-verify');
        });
    }

//    /** @test */
//    public function a_user_can_enter_phone_information()
//    {
//        $user = factory(User::class)->create(['phone' => null]);
//
//        $this->browse(function ($browser) use ($user) {
//            $browser->loginAs($user)
//                ->visit('/weather-text')
//                ->type('phone', '5555555555');
//        });
//    }
//
//    /** @test */
//    public function a_user_can_submit_phone_information()
//    {
//        $this->withoutJobs();
//
//        $user = factory(User::class)->create(['phone' => null]);
//
//        $this->browse(function ($browser) use ($user) {
//            $browser->loginAs($user)
//                ->visit('/weather-text')
//                ->type('phone', '5555555555')
//                ->click('input[type="submit"]');
//        });
//    }

//    /** @test */
//    public function user_should_be_redirected_to_time_page_after_phone_submission()
//    {
//        $this->withoutJobs();
//
//        $user = factory(User::class)->create(['phone' => null, 'zip' => null]);
//
//        $this->browse(function ($browser) use ($user) {
//            $browser->loginAs($user)
//                ->visit('/weather-text')
//                ->type('phone', '5555555555')
//                ->type('zip', '55555')
//                ->click('button[type="submit"]');
//            $browser->assertSee('Phone')
//                ->assertSee('Time')
//                ->assertSee('Timezone')
//                ->assertSee('Active');
//        });
//    }

}
