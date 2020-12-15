<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Tweet;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    protected string $password = 'passwordForTest';

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

    public function testFavorite()
    {
        $tweet = Tweet::factory()->create();
        $response = $this->post('favorites', [
            'userId' => $this->user->id,
            'tweetId' => $tweet->id
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('favorites', [
            'user_id' => $this->user->id,
            'favorite_tweet_id' => $tweet->id
        ]);
    }

    public function testFavoriteRemove()
    {
        $tweet = Tweet::factory()->create();
        $response = $this->delete("favorites/$tweet->id");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('favorites', [
            'id' => $tweet->id
        ]);
    }
}
