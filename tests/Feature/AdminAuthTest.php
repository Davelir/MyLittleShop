<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{

    public function testAccessAdminWithoutLogin()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }
}
