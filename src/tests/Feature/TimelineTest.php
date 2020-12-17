<?php

namespace Tests\Feature;

use DateTime;
use App\Models\Tweet;
use App\Models\User;
use DateInterval;

abstract class TimelineTest extends TestCaseNeedsLogin
{
    protected $user;
    protected $user2;
    protected $password = 'passwordForTest';
    protected $tweets = [];
    const NUM_OF_USER_TWEETS = 1;
    const NUM_OF_TWEETS_OTHER_USER = 3;

    public function setUp(): void
    {
        parent::setUp();
        $this->user2 = User::factory()->create();
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
