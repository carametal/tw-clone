<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Tables\Tweets;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TweetTest extends TestCaseNeedsLogin
{
    use RefreshDatabase;

    const REST_URL = "tweets";

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
            'userId' => Auth::user()->id
        ];
        $response = $this->post(self::REST_URL, $request);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tweets', [
            'tweet' => $tweet
        ]);
    }

    public function testRemoveTweet()
    {
        $tweet = Tweet::factory()->create([
            'user_id' => $this->user->id
        ]);
        $response = $this->delete(self::REST_URL . "/{$tweet->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tweets', [
            'id' => $tweet->id
        ]);
    }
}
