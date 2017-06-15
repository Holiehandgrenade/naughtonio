<?php

namespace Tests\Feature\WeatherText;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherTextFeatureTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function if_user_has_no_phone_receive_phone_input_form()
    {
        $user = factory(User::class)->create(['phone' => null]);

    }
}
