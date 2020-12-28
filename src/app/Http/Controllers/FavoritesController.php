<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Throwable;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if(0 < Favorite::where('user_id', $request->userId)->where('favorite_tweet_id', $request->tweetId)->count())
            {
                return response()->json(['errorCode' => 1, 'message' => 'already favorited'], 403);
            }
            $favorite = Favorite::factory()->create([
                'user_id' => $request->userId,
                'favorite_tweet_id' => $request->tweetId
            ]);
            echo "success\n";
            return json_encode(['favorite' => $favorite]);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $favorite = Favorite::find($id);
            if($favorite == null)
            {
                return response()->json(['errorCode' => 1, 'message' => 'can not find favorite.'], 403);
            }
            return json_encode(['favorite' => $favorite->delete($favorite)]);
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
