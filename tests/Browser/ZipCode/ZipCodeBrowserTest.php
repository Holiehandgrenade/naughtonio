<?php

namespace Tests\Browser\ZipCode;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ZipCodeBrowserTest extends DuskTestCase
{
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
}
