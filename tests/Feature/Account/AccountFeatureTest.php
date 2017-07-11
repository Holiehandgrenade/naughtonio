<?php

namespace Tests\Feature\Account;

use App\User;
use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountFeatureTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function username_is_required()
    {
        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['email' => 'me@you.com'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['email' => 'me@you.com']);
    }

    /** @test */
    public function username_must_be_unique()
    {
        factory(User::class)->create(['username' => 'unique', 'email' => 'unique@unique.com']);

        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'unique', 'email' => 'a@b.com'])
            ->assertStatus(302);
        $this->assertCount(1, \DB::table('users')->where('username', 'unique')->get());
        $this->assertDatabaseMissing('users', ['username' => 'unique', 'email' => 'a@b.com']);
    }

    /** @test */
    public function email_is_required()
    {
        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'different'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['username' => 'different']);
    }

    /** @test */
    public function email_must_be_unique()
    {
        factory(User::class)->create(['username' => 'unique', 'email' => 'unique@unique.com']);

        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'me', 'email' => 'unique@unique.com'])
            ->assertStatus(302);
        $this->assertCount(1, \DB::table('users')->where('email', 'unique@unique.com')->get());
        $this->assertDatabaseMissing('users', ['username' => 'me', 'email' => 'unique@unique.com']);
    }

    /** @test */
    public function user_can_update_email()
    {
        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'me', 'email' => 'else@else.com']);
        $this->assertDatabaseHas('users', ['username' => 'me', 'email' => 'else@else.com']);
    }

    /** @test */
    public function user_can_update_username()
    {
        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'else', 'email' => 'a@b.com']);
        $this->assertDatabaseHas('users', ['username' => 'else', 'email' => 'a@b.com']);
    }

    /** @test */
    public function user_can_update_password()
    {
        $user = factory(User::class)->create(['password' => bcrypt('pass'), 'username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'me', 'email' => 'a@b.com', 'password' => 'word']);
        $this->assertTrue(Hash::check('word', $user->password));
        $this->assertFalse(Hash::check('pass', $user->password));
    }
}
