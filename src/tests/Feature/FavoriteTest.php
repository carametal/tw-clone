<?php

namespace Tests\Feature;

use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $favorite = Favorite::factory()->create([
            'user_id' => $this->user->id,
            'favorite_tweet_id' => $tweet->id
        ]);
        $response = $this->delete("favorites/{$favorite->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('favorites', [
            'id' => $tweet->id
        ]);
    }

    public function testDuplicateFavorite()
    {
        $tweet = Tweet::factory()->create();
        Favorite::factory()->create([
            'user_id' => $this->user->id,
            'favorite_tweet_id' => $tweet->id
        ]);
        $response = $this->post('favorites', [
            'userId' => $this->user->id,
            'tweetId' => $tweet->id
        ]);
        $response->assertStatus(403);
        $this->assertEquals($response->json()['errorCode'], 1);
    }

    public function testFavoriteNotExists()
    {
        $response = $this->delete('favorites/9999');
        $response->assertStatus(403);
        $this->assertEquals($response->json()['errorCode'], 1);
    }
}
