<?php


namespace App\Http\Controllers;

use App\Models\Tables\Tweets;
use Illuminate\Http\Request;

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
}