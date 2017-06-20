<?php

namespace Tests\Browser;

use App\Jobs\SendPhoneVerificationText;
use App\User;
use Illuminate\Queue\Jobs\Job;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhoneVerificationBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function after_phone_submission_redirect_to_verify_page()
    {
        $user = factory(User::class)->create(['phone' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/phone')
                ->type('phone', '5555555555')
                ->click('input[type="submit"]');
            $browser->assertPathIs('/phone-verify')
                ->assertSee('A verification code has been sent to this number.');
        });

        $this->assertQueued([SendPhoneVerificationText::class]);
    }

    /** @test */
    public function if_code_matches_continue_to_intended_url_after_going_through_verify_page()
    {
        $user = factory(User::class)->create(['phone' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/weather-text') // has middleware requires-phone
                ->type('phone', '5555555555')
                ->click('input[type="submit"]');

            $code = \DB::table('phone_verifications')->whereUserId($user->id)->get()->last()->verify_code;

            $browser->type('code', $code)
                ->click('input[type="submit"]');

            $browser->assertPathIs('/weather-text');
        });
    }
}
