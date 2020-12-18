<?php

namespace App\Models\Timeline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

abstract class Timeline extends Model
{
    const REQUEST_KEY_TYPE = 'type';
    const TIMELINE_TYPE_ALL = 'all';
    const TIMELINE_TYPE_FOLLOW = 'follow';
    const TIMELINE_TYPE_FAVORITE = 'favorite';

    private Collection $tweets;

    protected function __construct(Builder $query)
    {
        $this->tweets = $query
            ->latest()
            ->get();
    }

    public function get_tweets()
    {
        return $this->tweets;
    }
}
