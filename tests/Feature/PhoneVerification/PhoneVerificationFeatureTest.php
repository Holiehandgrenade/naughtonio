<?php

namespace Tests\Feature\PhoneVerification;

use App\Jobs\SendPhoneVerificationText;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhoneVerificationFeatureTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

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
    
    /** @test */
    public function send_phone_verification_job_is_dispatched()
    {
        $this->expectsJobs(SendPhoneVerificationText::class);

        $user = factory(User::class)->create();
        $this->be($user);

        $this->post('/phone', ['phone' => '1234567890'])
            ->assertStatus(302);
    }

    /** @test */
    public function a_phone_verification_record_is_created_for_pending_numbers()
    {
        $this->withoutJobs();

        $user = factory(User::class)->create();
        $this->be($user);

        $this->post('/phone', ['phone' => '1234567890']);

        $this->assertDatabaseHas('phone_verifications', ['user_id' => $user->id])
            ->assertCount(1, \DB::table('phone_verifications')->get());
    }

    /** @test */
    public function verification_code_is_required()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $this->post('/phone-verify', [])
            ->assertStatus(302);
    }

    /** @test */
    public function if_code_matches_phone_is_added_to_user_record()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->be($user);

        \DB::table('phone_verifications')->insert([
            'user_id' => $user->id,
            'pending_phone' => '1234567890',
            'verify_code' => '555555',
            'created_at' => Carbon::now()
        ]);

        $this->post('/phone-verify', ['code' => 555555]);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'phone' => '1234567890'
        ]);
    }

    /** @test */
    public function if_code_doesnt_match_redirect_back()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->be($user);

        \DB::table('phone_verifications')->insert([
            'user_id' => $user->id,
            'pending_phone' => '1234567890',
            'verify_code' => '555555',
            'created_at' => Carbon::now()
        ]);

        $this->post('/phone-verify', ['code' => 999999])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'phone' => '1234567890'
        ]);
    }

    /** @test */
    public function if_code_is_expired_redirect_to_phone()
    {
        $user = factory(User::class)->create(['phone' => null]);
        $this->be($user);

        \DB::table('phone_verifications')->insert([
            'user_id' => $user->id,
            'pending_phone' => '1234567890',
            'verify_code' => '555555',
            'created_at' => Carbon::now()->subMinutes(10)
        ]);

        $this->post('/phone-verify', ['code' => 555555])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'phone' => '1234567890'
        ]);
    }
}
