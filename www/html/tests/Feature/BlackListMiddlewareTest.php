<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlackListMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function testAccessDenyForIp(): void
    {
        $this->serverVariables = ['REMOTE_ADDR' => '192.168.0.0'];

        $this->postJson('/api/users', [])
            ->assertStatus(403);
    }
}
