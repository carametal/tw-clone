<?php

namespace Tests\Feature;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
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
    }

    public function testLogin(): void
    {
        echo var_dump($this->user);
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($this->user);
    }

    public function testLogout(): void
    {
        $response = $this->actingAs($this->user);
        $response->post(route('logout'));
        $this->assertGuest();
    }
}
