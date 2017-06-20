<?php

namespace Tests\Browser\ZipCode;

use App\Jobs\AddLatLongFromZipToUser;
use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ZipCodeBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function when_visiting_a_page_that_requires_zip_redirect_to_zip()
    {
        $user = factory(User::class)->create(['phone' => '5555555555', 'zip' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/weather-text'); // has requires-zip middleware
            $browser->assertPathIs('/zip');
        });
    }

    /** @test */
    public function when_submitting_a_zip_job_is_queued()
    {
        $user = factory(User::class)->create(['phone' => '5555555555', 'zip' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/zip')
                ->type('zip', '55555')
                ->click('input[type="submit"]');
        });

        $this->assertQueued(AddLatLongFromZipToUser::class);
    }

    /** @test */
    public function after_success_go_to_intended_url()
    {
        $user = factory(User::class)->create(['phone' => '5555555555', 'zip' => null]);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/weather-text') // requires zip
                ->type('zip', '55555')
                ->click('input[type="submit"]');

            $browser->assertPathIs('/weather-text');
        });
    }
}
