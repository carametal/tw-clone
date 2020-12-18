<?php

namespace App\Models\Timeline;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class TimelineFavorites extends Timeline
{
    protected function __construct(Builder $query)
    {
        parent::__construct($query);
    }

    public static function make(int $user_id, Builder $query)
    {
        $favorite = DB::table('favorites')
            ->select('favorite_tweet_id')
            ->where('user_id', '=', $user_id)
            ->get();
        $array_favorite_tweets_id = $favorite->map(function($item)
        {
            return $item->favorite_tweet_id;
        });
        $query = $query->whereIn('tweets.id', $array_favorite_tweets_id);
        return new TimelineFavorites($query);
    }

}
