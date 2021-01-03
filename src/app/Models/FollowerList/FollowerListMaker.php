<?php

namespace App\Models\FollowerList;

class FollowerListMaker
{
    public function get(int $user_id): FollowerList
    {
        return FollowerList::make($user_id);
    }
}
