<?php


namespace App\Models\Rests;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Favorites
{
    public function create(Request  $request) {
        try {
            $favorite = new Favorite();
            $favorite->user_id = $request->userId;
            $favorite->favorite_tweet_id = $request->tweetId;
            $favorite->save();
            return $favorite;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id) {
        try {
            DB::table('favorites')
                ->where('id', '=', $id)
                ->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }
}