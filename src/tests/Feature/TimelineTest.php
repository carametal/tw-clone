<?php

namespace Tests\Feature;

use App\Models\Favorite;
use DateTime;
use App\Models\Tweet;
use App\Models\User;
use DateInterval;
use Tests\TestCase;

abstract class TimelineTest extends TestCase
{
    protected $user;
    protected $user2;
    protected $password = 'passwordForTest';
    protected $tweets = [];
    const NUM_OF_USER_TWEETS = 1;
    const NUM_OF_TWEETS_OTHER_USER = 3;

    public function setUp(): void
    {
        parent::setup();
        $this->user = User::factory()->create([
            'password' => bcrypt($this->password)
        ]);
        $this->user2 = User::factory()->create();
        $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);
        $dateTime = new DateTime();
        $this->tweets[] = Tweet::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => $dateTime
        ]);
        for ($i=0; $i < self::NUM_OF_TWEETS_OTHER_USER ; $i++) {
            $interval = $i + 1;
            $this->tweets[] = Tweet::factory()->create([
                'user_id' => $this->user2->id,
                'created_at' => $dateTime->add(new DateInterval("PT{$interval}S"))
            ]);
        }
    }
}
