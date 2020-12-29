<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Throwable;

class FavoritesController extends Controller
{
    const ERROR_ALREADY_FAVORITED = [
        'code' => 1,
        'message' => 'already favorited.'
    ];
    const ERROR_FAVORITE_IS_NOT_EXITS = [
        'code' => 2,
        'message' => 'favorite is not exists.'
    ];
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
            $favorite = Favorite::where('user_id', $request->userId)->where('favorite_tweet_id', $request->tweetId)->first();
            if($favorite !== null)
            {
                $json = self::ERROR_ALREADY_FAVORITED;
                $json['favorite'] = $favorite;
                return response()->json($json, 403);
            }
            $favorite = Favorite::factory()->create([
                'user_id' => $request->userId,
                'favorite_tweet_id' => $request->tweetId
            ]);
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
                return response()->json(self::ERROR_FAVORITE_IS_NOT_EXITS, 403);
            }
            return json_encode(['favorite' => $favorite->delete($favorite)]);
        } catch (Throwable $th) {
            throw $th;
        }
    }
}
