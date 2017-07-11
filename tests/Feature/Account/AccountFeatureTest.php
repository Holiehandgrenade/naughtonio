<?php

namespace Tests\Feature\Account;

use App\User;
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
    public function user_can_update_username()
    {
        $user = factory(User::class)->create(['username' => 'me', 'email' => 'a@b.com']);
        $this->be($user);

        $this->patch('/account', ['username' => 'me', 'email' => 'else@else.com']);
//            ->assertStatus(200);
        $this->assertDatabaseHas('users', ['username' => 'me', 'email' => 'else@else.com']);
    }
}
