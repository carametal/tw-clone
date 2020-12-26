<?php

namespace Tests\Feature\Timeline;

use App\Models\Timeline\Timeline;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineUserTest extends TimelineTest
{
    use RefreshDatabase;

    const NUM_OF_FOLLOWED_TWEETS = 3;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testTimelineHasSpecifiedUserTweets()
    {
        $query = '?' . Timeline::REQUEST_KEY_TYPE . '=' . Timeline::TIMELINE_TYPE_USER . '&user_id=' . $this->user2->id;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        $tweets_of_user_2 = array_filter($this->tweets, function($t) {
            return $t->user_id === $this->user2->id;
        });
        foreach ($json as $i => $value) {
            $index = self::NUM_OF_TWEETS_OTHER_USER - $i;
            $this->assertEquals((int)$tweets_of_user_2[$index]['id'], $value['id']);
        }
    }

}
