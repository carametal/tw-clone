<?php

namespace Tests\Feature\Timeline;

use App\Models\Timeline\Timeline;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineAllTest extends TimelineTest
{
    use RefreshDatabase;

    const NUM_OF_ALL_TWEETS = self::NUM_OF_USER_TWEETS + self::NUM_OF_TWEETS_OTHER_USER;

    public function setUp(): void
    {
        parent::setup();
    }

    public function testTimelineHasAllTweets()
    {
        $query = '?' . Timeline::REQUEST_KEY_TYPE . '=' . Timeline::TIMELINE_TYPE_ALL;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        foreach ($json as $i => $value) {
            $index = (self::NUM_OF_ALL_TWEETS - 1) - $i;
            $this->assertEquals((int)$this->tweets[$index]['id'], $value['id']);
        }
    }
}
