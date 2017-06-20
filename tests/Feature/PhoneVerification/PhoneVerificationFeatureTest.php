<?php

namespace Tests\Feature\PhoneVerification;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhoneVerificationFeatureTest extends TestCase
{
    /** @test */
    public function phone_is_required()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $this->post('/phone', [])
            ->assertStatus(302);
        $this->assertDatabaseMissing('phone_verifications', ['phone' => '5555555555']);
    }

    /** @test */
    public function phone_must_be_10_characters()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $this->post('/phone', ['phone' => '123456789'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('phone_verifications', ['phone' => '123456789']);

        $this->post('/phone', ['phone' => '12345678922'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('phone_verifications', ['phone' => '12345678922']);
    }
}
