<?php

namespace Tests\Feature;

use App\Http\Controllers\TweetController;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class TweetTest extends TestCaseNeedsLogin
{
    use RefreshDatabase;
    use WithFaker;

    const REST_URL = "tweets";

    const NUM_OF_FAVORITES = 3;

    protected $user;
    protected $password = 'passwordForTest';


    public function setUp(): void
    {
        parent::setup();
        $this->user = User::factory()->create([
            'password' => bcrypt($this->password)
        ]);
        $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);
    }

    public function testTweet()
    {
        $tweet = 'testTweetContent';
        $request = [
            'tweet' => $tweet,
            'userId' => $this->user->id
        ];
        $response = $this->post(self::REST_URL, $request);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tweets', [
            'tweet' => $tweet
        ]);
    }

    public function testTweet140CharactersOrMore()
    {
        $text = $this->faker()->realText(200);
        $response = $this->post(self::REST_URL, [
            'tweet' => $text,
            'userId' => $this->user->id
        ]);
        $response->assertStatus(400);
        $json = $response->json();
        $this->assertEquals(TweetController::ERROR_TWEET_TOO_LONG['code'], $json['code']);
        $this->assertEquals(TweetController::ERROR_TWEET_TOO_LONG['message'], $json['message']);
    }

    public function testRemoveTweet()
    {
        $tweet = Tweet::factory()->create([
            'user_id' => $this->user->id
        ]);

        $favorites = [];
        for ($i=0; $i < self::NUM_OF_FAVORITES ; $i++) {
            $favorites[] = Favorite::factory()->create([
                'favorite_tweet_id' => $tweet->id
            ]);
        }
        $response = $this->delete(self::REST_URL . "/{$tweet->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tweets', [
            'id' => $tweet->id
        ]);
        foreach ($favorites as $index => $favorite) {
            $this->assertDatabaseMissing('favorites', [
                'id' => $favorite->id
            ]);
        }
    }
}
