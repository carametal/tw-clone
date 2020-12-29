<?php

namespace App\Models\FollowList;

use App\Models\Follow;
use Illuminate\Database\Eloquent\Collection;

class FollowList
{
    public Collection $follows;

    private function __construct(Collection $follows)
    {
        $this->follows = $follows;
    }

    public static function make(int $user_id): FollowList
    {
        $follows = Follow::where('user_id', $user_id)->get();
        return new FollowList($follows);
    }
}
