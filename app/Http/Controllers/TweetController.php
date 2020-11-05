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

    public function timeline()
    {
        $tweet = DB::table('tweets')
            ->join('users', 'tweets.user_id', 'users.id')
            ->select('tweets.*', 'users.name')
            ->latest()
            ->get();
        return json_encode($tweet);
    }
}