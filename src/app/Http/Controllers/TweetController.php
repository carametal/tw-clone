<?php


namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Throwable;

class TweetController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            Tweet::factory()->create([
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
            Tweet::find($id)->delete();
        }
        catch (Throwable $th)
        {
            throw $th;
        }
    }
}