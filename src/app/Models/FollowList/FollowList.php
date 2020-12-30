<?php

namespace App\Models\FollowList;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FollowList
{
    public Collection $follows;

    private function __construct(Collection $follows)
    {
        $this->follows = $follows;
    }

    public static function make(int $user_id): FollowList
    {
        $follows = DB::table('follows')
            ->select(DB::raw('follows.*, users.name as follow_user_name, users.bio as follow_user_bio'))
            ->where('user_id', $user_id)
            ->join('users', 'users.id', 'follows.follow_user_id')
            ->get();
        return new FollowList($follows);
    }
}
