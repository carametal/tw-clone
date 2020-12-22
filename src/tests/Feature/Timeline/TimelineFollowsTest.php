<?php

namespace Tests\Feature\Timeline;

use App\Models\Follow;
use App\Models\Timeline\Timeline;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineFollowsTest extends TimelineTest
{
    use RefreshDatabase;

    const NUM_OF_FOLLOWED_TWEETS = 3;

    public function setUp(): void
    {
        parent::setUp();
        Follow::factory()->create([
            'user_id' => $this->user->id,
            'follow_user_id' => $this->user2->id
        ]);
    }

    public function testTimelineHasFollowedTweets()
    {
        $query = '?' . Timeline::REQUEST_KEY_TYPE . '=' . Timeline::TIMELINE_TYPE_FOLLOW;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        foreach ($json as $i => $value) {
            $index = self::NUM_OF_FOLLOWED_TWEETS - $i;
            $this->assertEquals((int)$this->tweets[$index]['id'], $value['id']);
        }
    }

}
