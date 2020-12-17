<?php

namespace Tests\Feature;

use App\Http\Controllers\TweetController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TimelineAllTest extends TimelineTest
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setup();
    }

    public function testTimelineHasAllTweets()
    {
        $query = '?' . TweetController::REQUEST_KEY_TYPE . '=' . TweetController::TIMELINE_TYPE_ALL;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        foreach ($json as $i => $value) {
            $index = (self::NUM_OF_ALL_TWEETS - 1) - $i;
            $this->assertEquals((int)$this->tweet[$index]['id'], $value['id']);
        }
    }
}
