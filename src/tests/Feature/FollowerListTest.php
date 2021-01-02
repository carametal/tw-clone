<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowerListTest extends TestCaseNeedsLogin
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
    }

    public function testGetFollowerList()
    {
        $response = $this->get("/follower-list/{$this->user->id}");
        $response->assertStatus(200);
    }
}
