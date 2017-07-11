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

    /** @test */
    public function username_is_required()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('username', "")
                    ->click('input[type="submit"]');

            $browser->assertSee('The username field is required.');
        });
    }

    /** @test */
    public function email_is_required()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('email', "")
                ->click('input[type="submit"]');

            $browser->assertSee('The email field is required.');
        });
    }

    /** @test */
    public function username_must_be_unique()
    {
        factory(User::class)->create(['username' => 'unique']);
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('username', "unique")
                ->click('input[type="submit"]');

            $browser->assertSee('The username has already been taken.');
        });
    }

    /** @test */
    public function email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'unique@unique.com']);
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('email', "unique@unique.com")
                ->click('input[type="submit"]');

            $browser->assertSee('The email has already been taken.');
        });
    }

    /** @test */
    public function old_password_must_match()
    {
        $user = factory(User::class)->create(['password' => bcrypt('anything')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('current_password', "somethingelse")
                ->click('input[type="submit"]');

            $browser->assertSee('The current password is incorrect.');
        });
    }

    /** @test */
    public function new_password_must_be_confirmed()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('current_password', "password")
                ->type('password', "new_password")
                ->type('password_confirmation', "wrong_password")
                ->click('input[type="submit"]');

            $browser->assertSee('The password confirmation does not match.');
        });
    }

    /** @test */
    public function all_fields_can_be_updated_when_done_right()
    {
        $user = factory(User::class)->create([
            'username' => 'me',
            'email' => 'me@me.com',
            'password' => bcrypt('password')
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/account');

            $browser->type('username', 'you')
                ->type('email', 'you@you.com')
                ->type('current_password', "password")
                ->type('password', "new_password")
                ->type('password_confirmation', "new_password")
                ->click('input[type="submit"]');

            $browser->assertSee('Record Updated')
                ->assertInputValue('username','you')
                ->assertInputValue('email','you@you.com');
        });
    }
}
