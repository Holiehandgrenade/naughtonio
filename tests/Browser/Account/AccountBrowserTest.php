<?php

namespace Tests\Browser\Account;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AccountBrowserTest extends DuskTestCase
{
    /** @test */
    public function user_can_visit_account_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/account')
                    ->assertSee('Username')
                    ->assertSee('Email')
                    ->assertSee('Current Password')
                    ->assertSee('New Password')
                    ->assertSee('Confirm New Password');
        });
    }
}
