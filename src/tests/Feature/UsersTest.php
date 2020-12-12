<?php

namespace Tests\Feature;

use App\Models\Tables\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected $name = 'newName';
    protected $email = 'newName@example.com';
    protected $bio = 'newBio';

    public function setUp(): void
    {
        parent::setUp();
        $password = 'testUser';
        $user = User::factory()->create([
            'password' => bcrypt($password)
        ]);
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => $password,
        ]);
    }

    public function testGetUser()
    {
        $users = new Users();
        $users->update($this->name, $this->email, $this->bio);
        $this->assertEquals(Auth::user()->name, $this->name);
        $this->assertEquals(Auth::user()->email, $this->email);
        $this->assertEquals(Auth::user()->bio, $this->bio);
    }

    public function testTemp()
    {
        $response = $this->get(route('hello-world', ['name' => 'Carametal']));
        echo var_dump($response);
    }
}
