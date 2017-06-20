<?php

namespace Tests\Feature\ZipCode;

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
        $user = factory(User::class)->create();
        $this->be($user);

        $this->post('/zip', [])
            ->assertStatus(302);
        $this->assertDatabaseMissing('users', ['zip' => 55555]);
    }
}
