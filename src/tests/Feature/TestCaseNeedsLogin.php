<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

abstract class TestCaseNeedsLogin extends TestCase
{
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
}
