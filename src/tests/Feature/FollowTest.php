<?php

namespace Tests\Feature;

use App\Http\Controllers\FollowsController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Follow;
use Tests\TestCase;

class FollowTest extends TestCase
{
    use RefreshDatabase;

    protected $user1;
    protected $password = 'passwordForTest';

    protected $user2;

    public function setUp(): void
    {
        parent::setup();
        $this->user1 = User::factory()->create([
            'password' => bcrypt($this->password)
        ]);
        $this->user2 = User::factory()->create();
        $this->post(route('login'), [
            'email' => $this->user1->email,
            'password' => $this->password,
        ]);
    }

    public function testFollow()
    {
        $response = $this->post('follows', [
            'userId' => $this->user1->id,
            'followUserId' => $this->user2->id
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('follows', [
            'user_id' => $this->user1->id,
            'follow_user_id' => $this->user2->id
        ]);
    }

    public function testRemove()
    {
        $follow = Follow::factory()->create();
        $resposne = $this->delete("follows/{$follow->id}");
        $resposne->assertStatus(200);
        $this->assertDatabaseMissing('follows', [
            'id' => $follow->id
        ]);
    }

    public function testDuplicateFollow()
    {
        $follow = Follow::factory()->create();
        $response = $this->post('follows', [
            'userId' => $follow->user_id,
            'followUserId' => $follow->follow_user_id
        ]);
        $response->assertStatus(403);
        $json =$response->json();
        $this->assertEquals($follow->id, $json['follow']['id']);
        $this->assertEquals($json['code'], FollowsController::ERROR_FOLLOWED['code']);
        $this->assertEquals($json['message'], FollowsController::ERROR_FOLLOWED['message']);
    }

    public function testFollowIsNotExists()
    {
        $response = $this->delete('follows/9999');
        $response->assertStatus(403);
        $json =$response->json();
        $this->assertEquals($json['code'], FollowsController::ERROR_FOLLOW_IS_NOT_EXITS['code']);
        $this->assertEquals($json['message'], FollowsController::ERROR_FOLLOW_IS_NOT_EXITS['message']);
    }
}
