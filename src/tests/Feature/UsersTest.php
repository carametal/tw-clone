<?php

namespace Tests\Feature;

use App\Models\Tables\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    const NUM_OF_USERS_WITHOUT_LOGIN_USER = 3;

    protected $users = [];

    protected $name = 'newName';
    protected $email = 'newName@example.com';
    protected $bio = 'newBio';

    public function setUp(): void
    {
        parent::setUp();
        $password = 'testUser';
        $this->users[] = User::factory()->create([
            'password' => bcrypt($password)
        ]);
        $this->post(route('login'), [
            'email' => $this->users[0]->email,
            'password' => $password,
        ]);
        for ($i=0; $i < self::NUM_OF_USERS_WITHOUT_LOGIN_USER ; $i++) {
            $this->users[] = User::factory()->create();
        }
    }

    public function testGetUsers()
    {
        $response = $this->get('users');
        $response->assertStatus(200);
        $users = $response->viewData('users');
        foreach ($users as $index => $value) {
            assertEquals($this->users[$index]->id, $value->id);
        }
    }

    public function testGetUser()
    {
        $users = new Users();
        $users->update($this->name, $this->email, $this->bio);
        $this->assertEquals(Auth::user()->name, $this->name);
        $this->assertEquals(Auth::user()->email, $this->email);
        $this->assertEquals(Auth::user()->bio, $this->bio);
    }
}
