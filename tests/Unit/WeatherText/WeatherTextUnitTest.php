<?php

namespace Tests\Unit\WeatherText;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherTextUnitTest extends TestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    /** @test */
    public function a_user_has_nullable_phone()
    {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users', $user['attributes']);
    }
}
