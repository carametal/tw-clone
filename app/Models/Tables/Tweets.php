<?php


namespace App\Models\Tables;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Tweets
{
    public function insert(Request $request)
    {
        try {
            $tweet = new Tweet();
            $tweet->tweet = $request->tweet;
            $tweet->user_id = Auth::user()->id;
            $tweet->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

}