<?php

namespace Tests\Browser\Account;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AccountBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_visit_account_page()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/account')
                    ->assertSee('Username')
                    ->assertSee('Email')
                    ->assertSee('Current Password')
                    ->assertSee('New Password')
                    ->assertSee('Confirm New Password');
        });
    }
}
