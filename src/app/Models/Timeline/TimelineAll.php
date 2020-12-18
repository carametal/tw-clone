<?php

namespace App\Models\Timeline;

use Illuminate\Database\Query\Builder;

class TimelineAll extends Timeline
{
    protected function __construct(Builder $query)
    {
        parent::__construct($query);
    }

    public static function make(Builder $query)
    {
        return new TimelineAll($query);
    }
}
