<?php


namespace App\Http\Controllers;


use App\Models\Tables\Tweets;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
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

        $query = DB::table('tweets')
            ->select(DB::raw('tweets.*, users.name, follows.follow_user_id is not null as is_follows'))
            ->join('users', 'tweets.user_id', 'users.id')
            ->leftJoinSub($follow_sub, 'follows', function ($join) {
                $join->on('tweets.user_id', '=', 'follows.follow_user_id');
            });

        if($request->query('type') === 'follow')
        {
            $follows = DB::table('follows')
                ->select('follow_user_id')
                ->where('user_id', '=', $id)
                ->get();
            $array_follow_user_id = $follows->map(function($item)
            {
                return $item->follow_user_id;
            });
            $query = $query->whereIn('tweets.user_id', $array_follow_user_id)
                ->orWhere('tweets.user_id', '=', $id);
        }

         $tweet = $query
            ->latest()
            ->get();
        return json_encode($tweet);
    }
}