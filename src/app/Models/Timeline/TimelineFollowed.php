<?php

namespace App\Models\Timeline;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TimelineFollowed extends Timeline
{
    protected function __construct(Builder $query)
    {
        parent::__construct($query);
    }

    public static function make(int $user_id, Builder $query)
    {
        $follows = DB::table('follows')
            ->select('follow_user_id')
            ->where('user_id', '=', $user_id)
            ->get();
        $array_follow_user_id = $follows->map(function($item)
        {
            return $item->follow_user_id;
        });
        $query = $query->whereIn('tweets.user_id', $array_follow_user_id);
        return new TimelineFollowed($query);
    }
}
