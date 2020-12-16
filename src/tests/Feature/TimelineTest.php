<?php

namespace Tests\Feature;

use App\Http\Controllers\TweetController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Tweet;
use App\Models\User;
use Tests\TestCase;

class TimelineTest extends TestCase
{
    use RefreshDatabase;
    protected $user;
    protected $password = 'passwordForTest';
    protected $tweets = [];
    const NUM_OF_TWEET = 3;

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
        for ($i=0; $i < self::NUM_OF_TWEET ; $i++) {
            // Timestampを変えて新しいツイートの
            //インデックスを若くする機能を正常に動作させる
            sleep(1);
            $this->tweet[$i] = Tweet::factory()->create([
                'user_id' => $this->user->id
            ]);
        }
    }

    public function testTimelineHasALLTweets()
    {
        $response = $this->get('timeline/' . $this->user->id . '?type=all');
        $response->assertStatus(200);
        $json = $response->json();
        for ($i=0; $i < self::NUM_OF_TWEET ; $i++) {
            $index = (self::NUM_OF_TWEET - 1) - $i;
            $this->assertEquals((int)$this->tweet[$index]['id'], $json[$i]['id']);
        }
    }
}
