<?php

namespace Tests\Feature;

use App\Models\Follow;
use App\Models\User;
use DateInterval;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FollowListTest extends TestCaseNeedsLogin
{
    use RefreshDatabase;

    const NUM_OF_FOLLOWS = 5;
    protected $other_users = [];

    public function setUp(): void
    {
        parent::setup();
        for ($i=0; $i < self::NUM_OF_FOLLOWS ; $i++) {
            $this->other_users[] = User::factory()->create();
        }
    }

    public function testGetFollowList()
    {
        $follows = [];
        $dateTime = new DateTime();
        for ($i=0; $i < self::NUM_OF_FOLLOWS ; $i++) {
            $interval = $i + 1;
            $follows[] = Follow::factory()->create([
                'user_id' => $this->user->id,
                'follow_user_id' => $this->other_users[$i]->id,
                'created_at' => $dateTime->add(new DateInterval("PT{$interval}S"))
            ]);
        }
        $response = $this->get("/follow-list/{$this->user->id}");
        $response->assertStatus(200);
        $res_follows = $response->viewData('follows');
        foreach ($res_follows as $index => $follow) {
            $this->assertEquals($follows[$index]['id'], $follow->id);
        }
    }
}
