<?php


namespace App\Http\Controllers;


use App\Models\Tables\Tweets;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    const REQUEST_KEY_TYPE = 'type';
    const TIMELINE_TYPE_FOLLOW = 'follow';
    const TIMELINE_TYPE_FAVORITE = 'favorite';
    public function tweet(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST')
        {
            $tweets = new Tweets();
            $tweets->insert($request);
        }
    }

    public function timeline(int $id, Request $request)
    {
        $follow_sub = DB::table('follows')
            ->select('*')
            ->where('user_id', $id);
        $favorite_sub = DB::table('favorites')
            ->select('*')
            ->where('user_id', $id);

        $query = DB::table('tweets')
            ->select(DB::raw('tweets.*, users.name, follows.id as follow_id, favorites.id as favorite_id'))
            ->join('users', 'tweets.user_id', 'users.id')
            ->leftJoinSub($follow_sub, 'follows', function ($join) {
                $join->on('tweets.user_id', '=', 'follows.follow_user_id');
            })
            ->leftJoinSub($favorite_sub, 'favorites', function ($join) {
                $join->on('tweets.id', '=', 'favorites.favorite_tweet_id');
            });

        if($request->query(self::REQUEST_KEY_TYPE) === self::TIMELINE_TYPE_FOLLOW)
        {
            $follows = DB::table('follows')
                ->select('follow_user_id')
                ->where('user_id', '=', $id)
                ->get();
            $array_follow_user_id = $follows->map(function($item)
            {
                return $item->follow_user_id;
            });
            $query = $query->whereIn('tweets.user_id', $array_follow_user_id);
        }
        else if($request->query(self::REQUEST_KEY_TYPE) === self::TIMELINE_TYPE_FAVORITE)
        {
            $favorite = DB::table('favorites')
                ->select('favorite_tweet_id')
                ->where('user_id', '=', $id)
                ->get();
            $array_favorite_tweets_id = $favorite->map(function($item)
            {
                return $item->favorite_tweet_id;
            });
            $query = $query->whereIn('tweets.id', $array_favorite_tweets_id);
        }

        $tweet = $query
            ->latest()
            ->get();
        return json_encode($tweet);
    }
}