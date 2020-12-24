<?php

namespace App\Models\Timeline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimelineMaker extends Model
{
    public string $user_id;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function make(Request $request)
    {
        $query = $this->get_base_query();
        if($request->query(Timeline::REQUEST_KEY_TYPE) === Timeline::TIMELINE_TYPE_FOLLOW)
        {
            return TimelineFollowed::make($this->user_id, $query);
        }
        else if($request->query(Timeline::REQUEST_KEY_TYPE) === Timeline::TIMELINE_TYPE_FAVORITE)
        {
            return TimelineFavorites::make($this->user_id, $query);
        }
        else if($request->query(Timeline::REQUEST_KEY_TYPE) === Timeline::TIMELINE_TYPE_USER)
        {
            $specified_user_id = $request->query(Timeline::REQUEST_KEY_USER_ID);
            return TimelineUser::make($query, $specified_user_id);
        }
        return TimelineAll::make($query);
    }

    private function get_base_query()
    {
        $follow_sub = DB::table('follows')
            ->select('*')
            ->where('user_id', $this->user_id);
        $favorite_sub = DB::table('favorites')
            ->select('*')
            ->where('user_id', $this->user_id);

        $query = DB::table('tweets')
            ->select(DB::raw('tweets.*, users.name, follows.id as follow_id, favorites.id as favorite_id'))
            ->join('users', 'tweets.user_id', 'users.id')
            ->leftJoinSub($follow_sub, 'follows', function ($join) {
                $join->on('tweets.user_id', '=', 'follows.follow_user_id');
            })
            ->leftJoinSub($favorite_sub, 'favorites', function ($join) {
                $join->on('tweets.id', '=', 'favorites.favorite_tweet_id');
            });
        return $query;
    }
}
