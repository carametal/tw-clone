<?php

namespace Tests\Feature;

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
}
