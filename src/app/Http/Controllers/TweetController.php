<?php


namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TweetController extends Controller
{
    const ERROR_TWEET_TOO_LONG = [
        'code' => 1,
        'message' => 'Tweet must be 140 characters or less'
    ];

    public function store(Request $request)
    {
        try
        {
            if(strlen($request->tweet) > 140)
            {
                return response()->json(self::ERROR_TWEET_TOO_LONG, 400);
            }
            Tweet::create([
                'tweet' => $request->tweet,
                'user_id' => $request->userId
            ]);
        }
        catch (Throwable $th)
        {
            throw $th;
        }
    }

    public function destroy(int $id)
    {
        try
        {
            DB::transaction(function () use ($id) {
                Favorite::where('favorite_tweet_id', $id)->delete();
                Tweet::find($id)->delete();
            });
        }
        catch (Throwable $th)
        {
            throw $th;
        }
    }
}