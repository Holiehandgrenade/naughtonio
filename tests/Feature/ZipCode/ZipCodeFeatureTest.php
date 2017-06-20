<?php

namespace Tests\Feature\ZipCode;

use App\Jobs\AddLatLongFromZipToUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ZipCodeFeatureTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function zip_is_required()
    {
        $user = factory(User::class)->create(['zip' => null]);
        $this->be($user);

        $this->post('/zip', [])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['zip' => 55555]);
    }

    /** @test */
    public function zip_must_be_5_characters()
    {
        $user = factory(User::class)->create(['zip' => null]);
        $this->be($user);

        $this->post('/zip', ['zip' => '666666'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['zip' => 666666]);

        $this->post('/zip', ['zip' => '4444'])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['zip' => 4444]);
    }

    /** @test */
    public function on_success_get_lat_and_lon_job_is_dispatched_and_user_is_updated()
    {
        $this->expectsJobs(AddLatLongFromZipToUser::class);

        $user = factory(User::class)->create(['zip' => null]);
        $this->be($user);

        $this->post('/zip', ['zip' => '55555']);
        $this->assertDatabaseHas('users', ['zip' => 55555]);
    }
}
