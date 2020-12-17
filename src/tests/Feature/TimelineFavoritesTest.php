<?php

namespace Tests\Feature;

use App\Http\Controllers\TweetController;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TimelineFavoritesTest extends TimelineTest
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
        for ($i=0; $i < parent::NUM_OF_FAVORITE_TWEETS; $i++) {
            Favorite::factory()->create([
                'user_id' => $this->user->id,
                'favorite_tweet_id' => $this->tweet[$i]->id
            ]);
        }
    }

    public function testTimelineHasFavoriteTweets()
    {
        $query = '?' . TweetController::REQUEST_KEY_TYPE . '=' . TweetController::TIMELINE_TYPE_FAVORITE;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        foreach ($json as $i => $value) {
            $index = (self::NUM_OF_FAVORITE_TWEETS -1) - $i;
            $this->assertEquals((int)$this->tweet[$index]['id'], $value['id']);
        }
    }
}
