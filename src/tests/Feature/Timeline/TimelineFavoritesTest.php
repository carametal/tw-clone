<?php

namespace Tests\Feature\Timeline;

use App\Models\Favorite;
use App\Models\Timeline\Timeline;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineFavoritesTest extends TimelineTest
{
    use RefreshDatabase;

    const NUM_OF_FAVORITE_TWEETS = 2;

    public function setUp(): void
    {
        parent::setup();
        for ($i=0; $i < self::NUM_OF_FAVORITE_TWEETS; $i++) {
            $index = $i + 1;
            Favorite::factory()->create([
                'user_id' => $this->user->id,
                'favorite_tweet_id' => $this->tweets[$index]->id
            ]);
        }
    }

    public function testTimelineHasFavoriteTweets()
    {
        $query = '?' . Timeline::REQUEST_KEY_TYPE . '=' . Timeline::TIMELINE_TYPE_FAVORITE;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        foreach ($json as $i => $value) {
            $index = self::NUM_OF_FAVORITE_TWEETS - $i;
            $this->assertEquals((int)$this->tweets[$index]['id'], $value['id']);
        }
    }
}
