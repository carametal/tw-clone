<?php


namespace App\Models\Tables;


use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\Unit\ExampleTest;

class Follows
{
    public function create(Request $request)
    {
        try {
            $follow = new Follow();
            $follow->user_id = Auth::user()->id;
            $follow->follow_user_id = (int)$request->followUserId;
            $follow->save();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete(Request $request)
    {
        try {
            DB::table('follows')
                ->whereColumn([
                    ['user_id', Auth::user()->id],
                    ['follow_user_id', $request->followUserId]
                ])
                ->delete();
        } catch (Exception $e){
            throw $e;
        }
    }
}