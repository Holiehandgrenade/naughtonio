<?php

namespace Tests\Unit\Twitter;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TwitterApiTest extends TestCase
{
    /** @test */
    public function testing_route()
    {
        $this->post('/api/twitter', ['asdfds']);
    }
}
