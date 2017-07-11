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
}
