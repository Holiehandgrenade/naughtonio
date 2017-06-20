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
        $this->expectsJobs(SendPhoneVerificationText::class);

        $user = factory(User::class)->create(['phone' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/phone')
                ->type('phone', '5555555555')
                ->click('input[type="submit"]');
            $browser->assertPathIs('/phone-verify');
        });
    }
}
