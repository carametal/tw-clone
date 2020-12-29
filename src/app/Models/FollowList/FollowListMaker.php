<?php

namespace App\Models\FollowList;

class FollowListMaker
{
    public function get(int $user_id): FollowList
    {
        return FollowList::make($user_id);
    }
}
