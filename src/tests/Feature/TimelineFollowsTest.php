<?php

namespace Tests\Feature;

use App\Http\Controllers\TweetController;
use App\Models\Follow;
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
        $query = '?' . TweetController::REQUEST_KEY_TYPE . '=' . TweetController::TIMELINE_TYPE_FOLLOW;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        foreach ($json as $i => $value) {
            $index = self::NUM_OF_FOLLOWED_TWEETS - $i;
            $this->assertEquals((int)$this->tweets[$index]['id'], $value['id']);
        }
    }

}
