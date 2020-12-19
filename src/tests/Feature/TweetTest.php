<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Models\Tables\Tweets;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TweetTest extends TestCaseNeedsLogin
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
        $request = [
            'tweet' => $tweet,
            'userId' => Auth::user()->id
        ];
        $response = $this->post('tweets', $request);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tweets', [
            'tweet' => $tweet
        ]);
    }
}
