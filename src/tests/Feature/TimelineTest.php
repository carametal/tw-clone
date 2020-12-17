<?php

namespace Tests\Feature;

use App\Http\Controllers\TweetController;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DateTime;
use App\Models\Tweet;
use App\Models\User;
use DateInterval;
use Tests\TestCase;

class TimelineTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $password = 'passwordForTest';
    protected $tweets = [];
    const NUM_OF_ALL_TWEETS = 3;
    const NUM_OF_FAVORITE_TWEETS = 2;

    public function setUp(): void
    {
        parent::setup();
        $this->user = User::factory()->create([
            'password' => bcrypt($this->password)
        ]);
        $user2 = User::factory()->create();
        $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);
        $dateTime = new DateTime();
        for ($i=0; $i < self::NUM_OF_ALL_TWEETS ; $i++) {
            $this->tweet[$i] = Tweet::factory()->create([
                'user_id' => $user2->id,
                'created_at' => $dateTime->add(new DateInterval("PT{$i}S"))
            ]);
        }
        for ($i=0; $i < self::NUM_OF_FAVORITE_TWEETS; $i++) {
            Favorite::factory()->create([
                'user_id' => $this->user->id,
                'favorite_tweet_id' => $this->tweet[$i]->id
            ]);
        }
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

    public function testTimelineHasFavoriteTweets()
    {
        $query = '?' . TweetController::REQUEST_KEY_TYPE . '=' . TweetController::TIMELINE_TYPE_FAVORITE;
        $response = $this->get('timeline/' . $this->user->id . $query);
        $response->assertStatus(200);
        $json = $response->json();
        $response->dump();
        foreach ($json as $i => $value) {
            $index = (self::NUM_OF_FAVORITE_TWEETS -1) - $i;
            $this->assertEquals((int)$this->tweet[$index]['id'], $value['id']);
        }
    }
}
