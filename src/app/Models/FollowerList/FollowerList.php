<?php

namespace App\Models\FollowerList;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FollowerList
{
    public Collection $followers;

    private function __construct(Collection $followers)
    {
        $this->followers = $followers;
    }

    public static function make(int $user_id): FollowerList
    {
        $followers = DB::table('follows')
            ->select(DB::raw('follows.*, follows.user_id as follower_user_id, users.name as follower_user_name, users.bio as follower_user_bio'))
            ->where('follow_user_id', $user_id)
            ->join('users', 'users.id', 'follows.user_id')
            ->get();
        return new FollowerList($followers);
    }
}
