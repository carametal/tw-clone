<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Tables\Tweets;
use App\Models\Tweet;
use App\Models\User;
use Tests\TestCase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

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
        $request = new Request();
        $request->tweet = $tweet;
        $tweets = new Tweets();
        $tweets->insert($request);
        $this->assertDatabaseHas('tweets', [
            'tweet' => $tweet
        ]);
    }
}
