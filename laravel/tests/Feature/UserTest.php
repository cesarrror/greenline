<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function listAll()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }
}
