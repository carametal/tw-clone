<?php

namespace App\Models\Timeline;

use Illuminate\Database\Query\Builder;

class TimelineUser extends Timeline
{
    protected function __construct(Builder $query)
    {
        parent::__construct($query);
    }

    public static function make(Builder $query, int $specified_user_id)
    {
        $query = $query->where('tweets.user_id', $specified_user_id);
        return new TimelineUser($query);
    }
}
