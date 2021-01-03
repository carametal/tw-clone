<?php

namespace Tests\Feature;

use App\Models\Follow;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowListTest extends TestCaseNeedsLogin
{
    use RefreshDatabase;

    const NUM_OF_FOLLOWS = 5;

    public function setUp(): void
    {
        parent::setup();
    }

    public function testGetFollowList()
    {
        $follows = [];
        for ($i=0; $i < self::NUM_OF_FOLLOWS ; $i++) {
            $follows[] = Follow::factory()->create([
                'user_id' => $this->user->id
            ]);
        }
        $response = $this->get("/follow-list/{$this->user->id}");
        $response->assertStatus(200);
        $res_follows = $response->viewData('follows');
        foreach ($res_follows as $index => $follow) {
            $this->assertEquals($follows[$index]['id'], $follow['id']);
        }
    }
}
